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
    public function handle(Request $request, Closure $next)
    {
      // dd(auth()->user());
      if (auth()->user()['roles_id'] != Roles::firstWhere('role', 'admin')['id']) {
        return response()->json(['error' => 'You do not have access to this', 'success' => false], 401);
      }
      return $next($request);
    }
}
