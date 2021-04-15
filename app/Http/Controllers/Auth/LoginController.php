<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Roles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as defaultLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
      $credentials = $request->only('email', 'password');
      if (Auth::guard('web')->attempt($credentials)) {
        if (Auth::guard('web')->user()->roles_id != Roles::firstWhere('role', 'admin')['id']) {
          Auth::guard('web')->logout();
          $request->session()->invalidate();
          $request->session()->regenerateToken();
          return back()->withErrors([
              'message' => 'User does not have permission.',
          ]);
        }
          $request->session()->regenerate();
          return redirect()->route('dashboard');
      }
      return back()->withErrors([
          'email' => 'The provided credentials do not match our records.',
      ]);
    }
}
