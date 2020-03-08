<?php

namespace kamruljpi\Role\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use kamruljpi\Role\Http\Controllers\DynamicRoutes;
use Illuminate\Support\Facades\Route;
use kamruljpi\Role\Http\Model\Role;


class RoleAuthenticate
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $userRoleId = $this->auth->user()->user_role_id;
        $currentRouteName = $request->route()->getName();
        $roleName = Role::getRoleNameById($userRoleId);
        if($roleName == 'superadmin'){
            return $next($request);
        }else{
            if(empty($currentRouteName)){
                $currentPath= Route::getFacadeRoot()->current()->uri();
                $currentRouteName = DynamicRoutes::getRouteNameByUri($currentPath);
            }
            if(empty($currentRouteName)){
                return redirect('permission_denied');
            }
            if(DynamicRoutes::checkAccess($userRoleId, $currentRouteName)){
                return $next($request);
            }else{
                return redirect('permission_denied');
            }
        }
    }
}
