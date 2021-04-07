<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Roles;
use Illuminate\Http\Request;

class AdminMiddleware
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
      // dd(backpack_url('login'));
      if (backpack_user()['roles_id'] != Roles::firstWhere('role', 'admin')['id']) {
        return redirect(backpack_url('login'));
      }
      return $next($request);
    }
}
