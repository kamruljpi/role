<?php 

namespace kamruljpi\Role\Http\Controllers;

use kamruljpi\Role\Http\Model\Menu as DynamicMenu;
use kamruljpi\Role\Http\Model\UserRoleMenu;
use Storage;
use Session;
use Route;

class DynamicRoutes
{
    public function getRoutes()
    {
        $routeList = Route::getRoutes();
        $all_routes = array();
        $excludes = array('uses','namespace','prefix','middleware','before','controller');
        $i = 0;
        foreach ($routeList as $value)
        {
            $statement = false;
            if(isset($value->action)){
                foreach ($value->action as $valueactionk => $valueaction) {

                    if(isset($valueaction) && !empty($valueaction) && !is_array($valueaction) && !is_object($valueaction)){
                        $all_routes[$i][$valueactionk] = $valueaction;
                        $all_routes[$i]['uri'] = $value->uri;
                        $statement = true;

                    }
                }
            }
            if($statement){
                $i++;
            }
        }
        return $all_routes;
    }
    public function getAllRoutes()
    {
        $parents = array();
        $all_routes = $this->getRoutes();

        if(isset($all_routes) && !empty($all_routes)) {
            foreach ($all_routes as $key => $route) {
                if(!isset($route['parent'])) {
                    if(isset($route['as'])){
                        $parents[$route['as']] = $route;
                        unset($all_routes[$key]);
                    }
                }
            }
            if(isset($all_routes) && !empty($all_routes)) {
                foreach ($all_routes as $key => $route) {
                    if(isset($route['parent']) && isset($parents[$route['parent']])) {
                        if(isset($route['as'])){
                            $parents[$route['as']] = $route;
                            unset($all_routes[$key]);
                        }
                    }
                }
                if(isset($all_routes) && !empty($all_routes)) {
                    foreach ($all_routes as $key => $route) {
                        if(isset($route['parent']) && isset($parents[$route['parent']])) {
                            if(isset($route['as'])){
                                $parents[$route['as']] = $route;
                                unset($all_routes[$key]);
                            }
                        }
                    }
                    if(isset($all_routes) && !empty($all_routes)) {
                        foreach ($all_routes as $key => $route) {
                            if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                if(isset($route['as'])){
                                    $parents[$route['as']] = $route;
                                    unset($all_routes[$key]);
                                }
                            }
                        }
                        if(isset($all_routes) && !empty($all_routes)) {
                            foreach ($all_routes as $key => $route) {
                                if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                    if(isset($route['as'])){
                                        $parents[$route['as']] = $route;
                                        unset($all_routes[$key]);
                                    }
                                }
                            }
                            if(isset($all_routes) && !empty($all_routes)) {
                                foreach ($all_routes as $key => $route) {
                                    if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                        if(isset($route['as'])){
                                            $parents[$route['as']] = $route;
                                            unset($all_routes[$key]);
                                        }
                                    }
                                }
                                if(isset($all_routes) && !empty($all_routes)) {
                                    foreach ($all_routes as $key => $route) {
                                        if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                            if(isset($route['as'])){
                                                $parents[$route['as']] = $route;
                                                unset($all_routes[$key]);
                                            }
                                        }
                                    }
                                    if(isset($all_routes) && !empty($all_routes)) {
                                        foreach ($all_routes as $key => $route) {
                                            if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                                if(isset($route['as'])){
                                                    $parents[$route['as']] = $route;
                                                    unset($all_routes[$key]);
                                                }
                                            }
                                        }
                                        if(isset($all_routes) && !empty($all_routes)) {
                                            foreach ($all_routes as $key => $route) {
                                                if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                                    if(isset($route['as'])){
                                                        $parents[$route['as']] = $route;
                                                        unset($all_routes[$key]);
                                                    }
                                                }
                                            }
                                            if(isset($all_routes) && !empty($all_routes)) {
                                                foreach ($all_routes as $key => $route) {
                                                    if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                                        if(isset($route['as'])){
                                                            $parents[$route['as']] = $route;
                                                            unset($all_routes[$key]);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if(isset($all_routes) && !empty($all_routes)) {
            foreach ($all_routes as $key => $route) {
                if(isset($route['controller']) && !empty($route['controller'])){
                    $rlist = @explode("@", $route['controller']);
                    if(isset($rlist[1])){
                        $func = $rlist[1];
                        if(isset($rlist[0])){
                            $rslist = explode("\\", $rlist[0]);
                            $cntc = (count($rslist) - 1);
                            if(isset($rslist[$cntc])){
                                $last_controller = $rslist[$cntc];
                                $route_name = $last_controller."_".$func;
                                $route['as'] = $route_name;
                                $route['name'] = $route_name;
                                $route['description'] = "Function ".$func." of ".$last_controller." Controller";
                                $route['is_active'] = 1;
                                $route['is_display'] = 1;
                                $route['wrap_group'] = $last_controller;
                                $route['wrap_group_level'] = $last_controller;
                                if(!isset($route['parent'])) {
                                    if(isset($route['as'])){
                                        $parents[$route['as']] = $route;
                                        unset($all_routes[$key]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $parents;
    }
    public function updateRoutes()
    {
        DynamicMenu::truncate();
        $routeids = $routedata = [];
        $getAllRoutes = $this->getAllRoutes();
        if(isset($getAllRoutes) && !empty($getAllRoutes)){
            $i = 0;
            foreach ($getAllRoutes as $key => $getRoute) {
                if(isset($getRoute['as'])){
                    $DynamicMenu = new DynamicMenu();
                    // start generate emty route
                    if(isset($getRoute['controller']) && !empty($getRoute['controller'])){
                        $rlist = @explode("@", $getRoute['controller']);
                        if(isset($rlist[1])){
                            $func = $rlist[1];
                            if(isset($rlist[0])){
                                $rslist = explode("\\", $rlist[0]);
                                $cntc = (count($rslist) - 1);
                                if(isset($rslist[$cntc])){
                                    $last_controller = $rslist[$cntc];
                                    $groute_name = $last_controller."_".$func;
                                    $description = "Function ".$func." of ".$last_controller." Controller";
                                    $wrap_group = $last_controller;
                                    $wrap_group_level = $last_controller;
                                }
                            }
                        }
                    }
                    // end generate emty route
                    $DynamicMenu->route_name = $getRoute['as'];
                    if(isset($getRoute['icon'])){
                        $DynamicMenu->icon = $getRoute['icon'];
                    }else{
                        $DynamicMenu->icon = '';
                    }
                    if(isset($getRoute['uri'])){
                        $DynamicMenu->uri = $getRoute['uri'];
                    }else{
                        $DynamicMenu->uri = '';
                    }
                    if(isset($getRoute['name'])){
                        $DynamicMenu->name = $getRoute['name'];
                    }else{
                        if(isset($getRoute['as'])){
                            $DynamicMenu->name = $getRoute['as'];
                        }else{
                            $DynamicMenu->name = '';
                        }
                    }
                    if(isset($getRoute['description'])){
                        $DynamicMenu->description = $getRoute['description'];
                    }else{
                        if(isset($description)){
                            $DynamicMenu->description = $description;
                        }else{
                            $DynamicMenu->description = '';
                        }
                    }
                    if(isset($getRoute['is_active'])){
                        $DynamicMenu->is_active = $getRoute['is_active'];
                    }else{
                        $DynamicMenu->is_active = 1;
                    }

                    if(isset($getRoute['is_display'])){
                        $DynamicMenu->is_display = (int)$getRoute['is_display'];
                    }else{
                        $DynamicMenu->is_display = 0;
                    }
                    if(isset($getRoute['wrap_group'])){
                        $DynamicMenu->wrap_group = $getRoute['wrap_group'];
                    }else{
                        if(isset($wrap_group)){
                            $DynamicMenu->wrap_group =$wrap_group;
                        }else{
                            $DynamicMenu->wrap_group = '';
                        }
                    }
                    if(isset($getRoute['wrap_group_level'])){
                        $DynamicMenu->wrap_group_level = $getRoute['wrap_group_level'];
                    }else{
                        if(isset($wrap_group)){
                            $DynamicMenu->wrap_group_level =$wrap_group;
                        }else{
                            $DynamicMenu->wrap_group_level = '';
                        }
                    }
                    if(isset($getRoute['order_id'])){
                        $DynamicMenu->order_id = $getRoute['order_id'];
                    }else{
                        $DynamicMenu->order_id = 0;
                    }
                    if(isset($getRoute['parent'])){
                        if(isset($routeids[$getRoute['parent']])){
                            $DynamicMenu->parent_id = $routeids[$getRoute['parent']];
                        }else{
                            $DynamicMenu->parent_id = 0;
                        }
                    }else{
                        $DynamicMenu->parent_id = 0;
                    }
                    if($DynamicMenu->save()){
                        $routeids[$getRoute['as']] = $DynamicMenu->id_menu;
                    }
                $i++;
                }
            }
        }
        return true;
    }
    public static function getValidRouteByRoleId($userRoleId = null)
    {
        if($userRoleId == null){
            return false;
        }
        $allValidRoutes = [];
        if($userRoleId){
            $validRoutes = UserRoleMenu::where([ "role_id" => $userRoleId, "is_active" => 1])->select("route_name")->get();
            if(isset($validRoutes) && count($validRoutes) > 0){
                foreach ($validRoutes->toArray() as $validRoute) {
                    if(isset($validRoute['route_name'])){
                        $allValidRoutes[] = $validRoute['route_name'];
                    }
                }
            }
        }
        return $allValidRoutes;
    }
    public static function roleWiseValidRoutes($userRoleId = null, $force = false){
        if($userRoleId == null){
            return false;
        }
        $force = true;
        $getValidRouteByRole = Session::get('getValidRouteByRole');
        if(empty($getValidRouteByRole) || ($force == true)){
            Session::put('getValidRouteByRole', self::getValidRouteByRoleId($userRoleId));
        }
        return Session::get('getValidRouteByRole');
        
    }
    public static function checkAccess($userRoleId = null, $current_route = null)
    {
        if($userRoleId == null || $current_route == null || empty($current_route)  || empty($userRoleId)){
            return false;
        }
        $roleWiseValidRoutes = self::roleWiseValidRoutes($userRoleId);
        if($roleWiseValidRoutes){
            if(is_array($roleWiseValidRoutes)){
                if(in_array($current_route, $roleWiseValidRoutes)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function refreshMenu()
    {
        $this->updateRoutes();
        return true;
    }
}