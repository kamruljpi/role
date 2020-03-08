<?php

namespace kamruljpi\Role\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;
	protected $primaryKey = 'id_role';

	protected $fillable = ['name','is_active'];

	// public static function list($paginate = null) {
	// 	if(is_null($paginate)) {
	// 		return static::orderBy('updated_at', 'desc')->get();
	// 	}
	// 	return static::orderBy('updated_at', 'desc')->paginate($paginate);
	// }
	
	public static function getRoleNameById($role_id = null) 
	{
		if($role_id == null){
			return false;
		}
		if(isset(static::find($role_id)->name)){
			return strtolower(static::find($role_id)->name);
		}else{
			return false;
		}
	}
}