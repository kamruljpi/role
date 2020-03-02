<?php

namespace kamruljpi\Role\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = "id_menu";

    protected $fillable = ['is_display', 'parent_id','is_active','order_id','name','uri','route_name','description','wrap_group','wrap_group_level','icon'];

    public function scopeActive($query) {
    	$query->where('is_active',1);
    }
    public static function list($paginate = null) {
    	if(is_null($paginate)) {
    		return static::active()->orderBy('updated_at', 'desc')->get();
    	}
    	return static::active()->orderBy('updated_at', 'desc')->paginate($paginate);
    }

    public static function getRoutes() {
    	$routes = [];
    	foreach (static::all() as $key => $value) {
    		if($value->wrap_group) {
    			if(!isset($routes[$value->wrap_group])) {
    				$routes[$value->wrap_group] = ['routes' => [$value->toArray()]];
    				$routes[$value->wrap_group]['wrap_group_level'] = $value->wrap_group_level;
    				$routes[$value->wrap_group]['wrap_group'] = $value->wrap_group;

    			}elseif(isset($routes[$value->wrap_group])) {
    				$routes[$value->wrap_group]['routes'][] = $value->toArray();
    			}

    		}
    	}
    	return $routes;
    }
}