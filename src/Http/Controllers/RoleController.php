<?php

namespace kamruljpi\Role\Http\Controllers;

use kamruljpi\Role\Http\Model\Role;
use Illuminate\Http\Request;
use kamruljpi\admintemplate\controllers\ProjectBaseController;

class RoleController extends ProjectBaseController
{
	public function __construct() {
		$this->modelName = 'kamruljpi\Role\Http\Model\Role';
		$this->formView = 'role::role.create';
		$this->extraBtns = array(
			array(
				'routeName' => 'role_permission',
				'title' => 'Role Permission',
				'class' => 'role_permission_cls',
			)
		);
	}
}