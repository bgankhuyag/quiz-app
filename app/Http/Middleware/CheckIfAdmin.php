<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\Roles;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin extends Middleware
{
    /**
     * Checked that the logged in user is an administrator.
     *
     * --------------
     * VERY IMPORTANT
     * --------------
     * If you have both regular users and admins inside the same table, change
     * the contents of this method to check that the logged in user
     * is an admin, and not a regular user.
     *
     * Additionally, in Laravel 7+, you should change app/Providers/RouteServiceProvider::HOME
     * which defines the route where a logged in user (but not admin) gets redirected
     * when trying to access an admin route. By default it's '/home' but Backpack
     * does not have a '/home' route, use something you've built for your users
     * (again - users, not admins).
     *
     * @param [type] $user [description]
     *
     * @return bool [description]
     */
    private function checkIfUserIsAdmin($user)
    {
      // dd($user->roles_id == Roles::firstWhere('role', 'admin')['id']);
      // dd(Auth::guard('web')->user());
        return ($user->roles_id == Roles::firstWhere('role', 'admin')['id']);
        return true;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (!Auth::guard('web')->check()) {
        return redirect()->route('login');
      }
      if (! $this->checkIfUserIsAdmin(Auth::guard('web')->user())) {
        return redirect()->guest(route('logout'))->with(['errors' => 'user unauthorized']);
      }
      return $next($request);
    }
}
