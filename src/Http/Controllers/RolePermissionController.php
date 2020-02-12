<?php

namespace kamruljpi\Role\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use kamruljpi\Role\Http\Model\Menu;
use kamruljpi\Role\Http\Model\Role;
use Illuminate\Http\Request;

class RolePermissionController extends BaseController
{
	public function index() {
		return view('role::role.permission', [
			'roles' => Role::list(),
			'routes' => Menu::getRoutes(),
		]);
	}

	public function setRoutePermission(Request $request) {
		$this->validate($request,[
		        'role_id' => 'required',
		    ]);
		return view('role::role.permission', [
			'roles' => Role::list(),
			'routes' => Menu::getRoutes(),
		]);
	}
}
