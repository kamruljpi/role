<?php

Route::get('permission_denied', function(){
	return "You dont have permission to access this page. Please contact with system admin";
});

Route::get('setting_parent', array(
    'as' => 'setting_parent',
    'name' => 'Setting Parent',
    'icon' => '',
    'description' => 'Setting Parent',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'setting_parent',
    'wrap_group_level' => 'Settings'
));

Route::group(['prefix' => 'role','middleware' => ['RoleAuthenticate']], function () {
	Route::get('/', [
	    'as' => 'role_index',
	    'uses' => 'RoleController@index',
	    'parent' => 'setting_parent',
	    'name' => 'Role List',
	    'icon' => '',
	    'description' => 'Role List',
	    'is_display' => 1,
	    'is_active' => 1,
	    'order_id' => 1,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::get('/create', [
	    'as' => 'role_create',
	    'uses' => 'RoleController@create',
	    'parent' => 'setting_parent',
	    'name' => 'Role Create',
	    'icon' => '',
	    'description' => 'Role Create',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::post('/create', [
	    'as' => 'role_create_store',
	    'uses' => 'RoleController@store',
	    'parent' => 'setting_parent',
	    'name' => 'Role Store',
	    'icon' => '',
	    'description' => 'Role Store',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::get('/edit/{id}', [
	    'as' => 'role_edit',
	    'uses' => 'RoleController@edit',
	    'parent' => 'setting_parent',
	    'name' => 'Role Edit',
	    'icon' => '',
	    'description' => 'Role Edit',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::post('/edit/{id}', [
	    'as' => 'role_create_update',
	    'uses' => 'RoleController@update',
	    'parent' => 'setting_parent',
	    'name' => 'Role Update',
	    'icon' => '',
	    'description' => 'Role Update',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::get('/delete/{id}', [
	    'as' => 'role_delete',
	    'uses' => 'RoleController@delete',
	    'parent' => 'setting_parent',
	    'name' => 'Role Delete',
	    'icon' => '',
	    'description' => 'Role Delete',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::get('/status/{id}', [
	    'as' => 'role_status',
	    'uses' => 'RoleController@Status',
	    'parent' => 'setting_parent',
	    'name' => 'Role Status',
	    'icon' => '',
	    'description' => 'Role Status',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::get('/permission', [
	    'as' => 'role_permission',
	    'uses' => 'RolePermissionController@index',
	    'parent' => 'setting_parent',
	    'name' => 'Role Permission',
	    'icon' => '',
	    'description' => 'Role Permission',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::get('/getpermission', [
	    'as' => 'get_role_permission',
	    'uses' => 'RolePermissionController@getpermission',
	    'parent' => 'setting_parent',
	    'name' => 'Get Ajax Role Permission',
	    'icon' => '',
	    'description' => 'Get Ajax Role Permission',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
	Route::post('/permission', [
	    'as' => 'role_permission_store',
	    'uses' => 'RolePermissionController@setRoutePermission',
	    'parent' => 'setting_parent',
	    'name' => 'Role Permission store',
	    'icon' => '',
	    'description' => 'Role Permission store',
	    'is_active' => 1,
	    'order_id' => 0,
	    'wrap_group' => 'Role',
	    'wrap_group_level' => 'Roles',
	]);
});

