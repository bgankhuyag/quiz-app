<?php

namespace App\Http\Middleware;
use App\Models\Roles;
use Closure;

class CheckIfAdmin
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

        return ($user->roles_id == Roles::firstWhere('role', 'admin')['id']);
        return true;
    }

    /**
     * Answer to unauthorized access request.
     *
     * @param [type] $request [description]
     *
     * @return [type] [description]
     */
    private function respondToUnauthorizedRequest($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        } else {
            return redirect()->guest(backpack_url('login'));
        }
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
        if (backpack_auth()->guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }
        // dd(backpack_user()['roles_id'] != Roles::firstWhere('role', 'admin')['id']);
        if (! $this->checkIfUserIsAdmin(backpack_user())) {
          // dd('here');
          return response(trans('backpack::base.unauthorized'), 401);
          return redirect()->backpack_url('login');
          return $this->respondToUnauthorizedRequest($request);
        }
        // dd("here");
        if (backpack_user()['roles_id'] != Roles::firstWhere('role', 'admin')['id']) {
          // return redirect('/admin/login');
        }
        // dd(backpack_user()['roles_id'] != Roles::firstWhere('role', 'admin')['id']);
        return $next($request);
    }
}
