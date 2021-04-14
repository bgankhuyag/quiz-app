<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Models\Roles;
use Validator;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
      ]);
      // return($request->all());
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        // dd($data);
        return response()->json($data, 422);
      }
      if (! $token = auth()->attempt($validator->validated())) {
        return response()->json(['error' => 'Invalid email or password', 'success' => false], 401);
      }
      $data = ['data' => $this->createNewToken($token), 'success' => true];
      // dd($data);
      // return response()->json($data);
      return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|confirmed|min:6',
      ]);
      if($validator->fails()){
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 400);
      }
      $user = User::create(array_merge(
                  $validator->validated(),
                  ['password' => bcrypt($request->password), 'roles_id' => Roles::firstWhere('role', "guest")['id']],

              ));
      // $user->roles_id = Roles::firstWhere('role', "guest");
      return response()->json([
        'message' => 'User successfully registered',
        'user' => $user,
        'success' => true
      ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
        // dd("test");
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
      try {
        $user = auth()->user();
      } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        $this->refresh();
        $user = auth()->user();
      }
      return response()->json($user);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 10080,
            'user' => auth()->user()
        ]);
    }
}
