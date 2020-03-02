<?php

namespace kamruljpi\Role\Http\Controllers;

// use App\Http\Controllers\Controller as BaseController;
use kamruljpi\Role\Http\Model\Role;
use Illuminate\Http\Request;
use kamruljpi\admintemplate\controllers\ProjectBaseController;

class RoleController extends ProjectBaseController
{
	public function __construct() {
		$this->modelName = 'kamruljpi\Role\Http\Model\Role';
		$this->extraBtns = array(
			array(
				'routeName' => 'role_permission',
				'title' => 'Role Permission',
				'class' => 'role_permission_cls',
			)
		);
		// $this->btnLists = array(
		// 	array(
		// 		'routeName' => 'role_permission',
		// 		'title' => 'Role Permission',
		// 		'class' => 'role_permission_cls',
		// 	)
		// );

		// $this->perRowbtnLists = array(
		// 	array(
		// 		'routeName' => 'role_permission',
		// 		'title' => 'Role Permission',
		// 		// 'params' => ['id_role'],
		// 		// 'class' => 'btn-danger',
		// 	)
		// );
		// $this->tableLists = array(
		//     'id_role' => array(
		//         'title' => 'ID',
		//         'align' => 'center',
		//         'class' => 'fixed-width-xs',
		//     ),
		//     'name' => array(
		//         'title' => 'URL',
		//     ),
		//     'is_active' => array(
		//         'title' => 'Status',
		//         'align' => 'center',
		//         'class' => 'fixed-width-xs',
		//     ),
		// );
	}
	// public function index() {
	// 	return view("role::role.index", [
	// 		'details' => Role::all(),
	// 	]);
	// }
	public function create() {
		return view("role::role.create");
	}
	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|unique:'.Role::class,
		]);
		$role = new Role();
		$role->fill($request->all());
		$role->save();
		return redirect()->route('role_index')->withSuccess("Successfuly created new Role.");
	}
	public function edit($id) {
		return view("role::role.edit", [
			'data' => Role::findById($id),
		]);
	}
	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required|unique:'.Role::class.',name,'.$id.','.(new Role())->getKeyName(),
		]);
		$role = Role::findById($id);
		$role->fill($request->all());
		$role->update();
		return redirect()->route('role_index')->withSuccess("Successfuly updated new Role.");
	}
	public function show($id) {}
	// public function distroy($id) {
	// 	$role = Role::findById($id);
	// 	$role->delete();
	// 	return redirect()->route('role_index')->withSuccess("Successfuly Deleted Role.");
	// }
}