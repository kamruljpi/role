<?php

namespace kamruljpi\Role\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use kamruljpi\Role\Http\Model\Menu;
use kamruljpi\Role\Http\Model\Role;
use Illuminate\Http\Request;
use kamruljpi\Role\Http\Model\UserRoleMenu;
use Validator;
use kamruljpi\Role\Http\Controllers\DynamicRoutes;

class RolePermissionController extends BaseController
{
	public function index() {
		return view('role::role.permission', [
			'roles' => Role::all(),
			'routes' => Menu::getRoutes(),
		]);
	}

	public function getpermission(Request $request){
		$role_id = $request->get("role_id");
		$selectedMenu = [];
		if(isset($role_id) && !empty($role_id)){
			$allMenu = UserRoleMenu::where('role_id', $role_id)->get();
	        if(isset($allMenu) && !empty($allMenu)){
	        	foreach ($allMenu as $menu) {
	        		$selectedMenu[] = $menu->route_name;
	        	}
	        }
		}
		return json_encode($selectedMenu);
	}
	public function issetCheck($value){
		return isset($value) ? $value : '';
	}

	public function deleteMatchedRole(
        $role_id
    ){
        $delete = UserRoleMenu::where([
                    ['role_id', $role_id]
                ])
                ->delete();
    }

	public function setRoutePermission(Request $request) {
		
		$validator = Validator::make($request->all(), 
		    [
		        'role_id' => 'required',
		    ]);

		if ($validator->fails()) {
		    return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
		}
		$role_id = $this->issetCheck($request->role_id);

		$this->deleteMatchedRole($role_id);

		if(isset($request->menu_list) && !empty($request->menu_list)){

		    for ($i = 0; $i < count($request->menu_list); $i++) {

		        $setPermission            = new UserRoleMenu();
		        $setPermission->role_id   = $request->role_id;
		        $setPermission->route_name   = $request->menu_list[$i];
		        $setPermission->is_active = 1;
		        $setPermission->save();
		    }
		}
		DynamicRoutes::roleWiseValidRoutes($request->role_id, true);
		return redirect()->route('role_permission')->withSuccess("Successfuly Assigned Role Permission.");
	}
}
