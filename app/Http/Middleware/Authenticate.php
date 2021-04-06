<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //   if (! $request->expectsJson()) {
    //     return route('getQuiz');
    //   }
    // }

    public function handle($request, Closure $next) {
      if (!Auth::guard('api')->check()) {
        return response()->json(['error' => 'Please login first', 'success' => false], 401);
      }
      return $next($request);
    }
}
