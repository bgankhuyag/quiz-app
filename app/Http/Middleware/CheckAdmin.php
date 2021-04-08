<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     // protected function redirectTo($request)
     // {
     //   if (! $request->expectsJson()) {
     //     return route('login');
     //   }
     // }

    //  public function handle(Request $request,Closure $next)
    // {
    //     $credentials = $request->only('email', 'password');
    //
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //
    //         return redirect()->intended('dashboard');
    //     }
    //     // dd("ere");
    //
    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }
    public function handle(Request $request, Closure $next)
    {
      // dd(Auth::user());
      if (Auth::user()['roles_id'] != Roles::firstWhere('role', 'admin')['id']) {
        return route('login');
      }
      return $next($request);
    }
}
