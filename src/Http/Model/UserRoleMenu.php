<?php

namespace kamruljpi\Role\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class UserRoleMenu extends Model
{
    protected $table = "user_role_menus";

    protected $primaryKey = "id_user_role_menu";

    public static function generateMenu(){
        $menus_array = array();
        if(isset(Auth::user()->user_role_id)){
            $all_route_array = array();
            $userRoleId = (int)Auth::user()->user_role_id;
            $parentMenus = self::getMenuByRole($userRoleId);
            $i = 0;
            $im = 0;
            if(!empty($parentMenus)){
                foreach ($parentMenus as $key => $value) {
                    $all_route_array[$im]['route_name'] = $value->route_name;
                    if($value->is_display == 1){
                        $menus_array[$i]['name'] = $value->name;
                        $menus_array[$i]['icon'] = $value->icon;
                        $menus_array[$i]['route_name'] = $value->route_name;
                        $menus_array[$i]['order_id'] = $value->order_id;
                        $menus_array[$i]['menu_id'] = $value->id_menu;
                        $child_menu = self::getMenuByRole($userRoleId, $value->id_menu);
                        if (!empty($child_menu)) {
                            $j = 0;
                            $jm = 0;
                            foreach ($child_menu as $cm) {
                                if($cm->is_display == 1){
                                    $menus_array[$i]['subMenu'][$j]['name'] = $cm->name;
                                    $menus_array[$i]['subMenu'][$j]['icon'] = $cm->icon;
                                    $menus_array[$i]['subMenu'][$j]['route_name'] = $cm->route_name;
                                    $menus_array[$i]['subMenu'][$j]['order_id'] = $cm->order_id;
                                    $menus_array[$i]['subMenu'][$j]['menu_id'] = $cm->id_menu;
                                    $j++;
                                }
                                $all_route_array[$im]['subMenu'][$jm]['route_name'] = $cm->route_name;
                                $jm++;
                            }
                        }
                        $i++;
                    }
                    $im++;              
                }
            }
            return $menus_array;
        }
        return $menus_array;
    }
    public static function getMenuByRole($role_id = null, $parent_id = 0){

    	if($role_id == null || $role_id == 0){
    		return false;
    	}

        $user_menu_by_role = DB::table('user_role_menus as rm');

        $user_menu_by_role = $user_menu_by_role->join('menus as m','m.route_name','=','rm.route_name');

        $user_menu_by_role = $user_menu_by_role->select('m.*');

        $user_menu_by_role = $user_menu_by_role->where('m.name',"!=","");

        $user_menu_by_role = $user_menu_by_role->where('m.parent_id',(int)$parent_id);

    	// if(!is_int($role_id) && $role_id == 'superadmin'){

    	// }

    	if(is_int($role_id)){
            $user_menu_by_role = $user_menu_by_role->where('rm.role_id',$role_id);
    	}

        $user_menu_by_role = $user_menu_by_role->orderBy("m.id_menu","ASC");

        $user_menu_by_role = $user_menu_by_role->get();

        return $user_menu_by_role;
    }
}