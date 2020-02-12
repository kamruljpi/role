<?php

namespace kamruljpi\Role\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $primaryKey = 'id_role';

	protected $fillable = ['name','is_active'];

	public static function list($paginate = null) {
		if(is_null($paginate)) {
			return static::orderBy('updated_at', 'desc')->get();
		}
		return static::orderBy('updated_at', 'desc')->paginate($paginate);
	}
	
	public static function findById($id) {
		return static::find($id);
	}
}