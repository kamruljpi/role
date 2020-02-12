<?php 

namespace kamruljpi\Role\Http\Controllers;

use kamruljpi\Role\Http\Model\Menu as DynamicMenu;
use Storage;
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
                    if(isset($valueaction) && !empty($valueaction) && !is_array($valueaction) && !in_array($valueactionk, $excludes)){
                        $all_routes[$i][$valueactionk] = $valueaction;
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
    
    public function folderModifyTime($dir = null)
    {
        if($dir == null){
            $dir = base_path().DIRECTORY_SEPARATOR.'routes';
        }
        $foldermtime = 0;

        $flags = \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::CURRENT_AS_FILEINFO;
        $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, $flags));

        while ($it->valid()) {
            if (($filemtime = $it->current()->getMTime()) > $foldermtime) {
                $foldermtime = $filemtime;
            }
            $it->next();
        }
        return $foldermtime;
    }
    public function createTimeFile($fileName = 'routesfolder.txt', $content = null)
    {
        if($content == null){
            $content = time();
        }
        Storage::put($fileName, $content);
    }
    
    public function isModifyFolder($dir = null, $timefile = 'routesfolder.txt')
    {
        if($dir == null){
            $dir = base_path().DIRECTORY_SEPARATOR.'routes';
        }
        $storage_path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'routesfolder.txt';
        $recentModifytime = $this->folderModifyTime($dir);
        if(!file_exists($storage_path)){
            Storage::put($timefile, $recentModifytime);
            return true;
        }
        $lastModifytime = (int)Storage::get($timefile);
        if($lastModifytime == 0){
            $lastModifytime = $recentModifytime;
        }
        if($recentModifytime > $lastModifytime){
            return true;
        }else if ($recentModifytime == $lastModifytime){
            return false;
        }else if ($recentModifytime < $lastModifytime){
            return false;
        }else{
            return false;
        }
    }
    
    public function updateFolderTime($dir = null, $fileName = 'routesfolder.txt')
    {
        if($dir == null){
            $dir = base_path().DIRECTORY_SEPARATOR.'routes';
        }
        $recentModifytime = $this->folderModifyTime($dir);
        $this->createTimeFile($fileName,$recentModifytime);
    }
    public function getAllRoutes()
    {
        $parents = array();
        $all_routes = $this->getRoutes();
        if(isset($all_routes) && !empty($all_routes)) {
            foreach ($all_routes as $key => $route) {
                if(!isset($route['parent'])) {
                    $parents[$route['as']] = $route;
                    unset($all_routes[$key]);
                }
            }
            if(isset($all_routes) && !empty($all_routes)) {
                foreach ($all_routes as $key => $route) {
                    if(isset($route['parent']) && isset($parents[$route['parent']])) {
                        $parents[$route['as']] = $route;
                        unset($all_routes[$key]);
                    }
                }
                if(isset($all_routes) && !empty($all_routes)) {
                    foreach ($all_routes as $key => $route) {
                        if(isset($route['parent']) && isset($parents[$route['parent']])) {
                            $parents[$route['as']] = $route;
                            unset($all_routes[$key]);
                        }
                    }
                    if(isset($all_routes) && !empty($all_routes)) {
                        foreach ($all_routes as $key => $route) {
                            if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                $parents[$route['as']] = $route;
                                unset($all_routes[$key]);
                            }
                        }
                        if(isset($all_routes) && !empty($all_routes)) {
                            foreach ($all_routes as $key => $route) {
                                if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                    $parents[$route['as']] = $route;
                                    unset($all_routes[$key]);
                                }
                            }
                            if(isset($all_routes) && !empty($all_routes)) {
                                foreach ($all_routes as $key => $route) {
                                    if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                        $parents[$route['as']] = $route;
                                        unset($all_routes[$key]);
                                    }
                                }
                                if(isset($all_routes) && !empty($all_routes)) {
                                    foreach ($all_routes as $key => $route) {
                                        if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                            $parents[$route['as']] = $route;
                                            unset($all_routes[$key]);
                                        }
                                    }
                                    if(isset($all_routes) && !empty($all_routes)) {
                                        foreach ($all_routes as $key => $route) {
                                            if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                                $parents[$route['as']] = $route;
                                                unset($all_routes[$key]);
                                            }
                                        }
                                        if(isset($all_routes) && !empty($all_routes)) {
                                            foreach ($all_routes as $key => $route) {
                                                if(isset($route['parent']) && isset($parents[$route['parent']])) {
                                                    $parents[$route['as']] = $route;
                                                    unset($all_routes[$key]);
                                                }
                                            }
                                            if(isset($all_routes) && !empty($all_routes)) {
                                                foreach ($all_routes as $key => $route) {
                                                    if(isset($route['parent']) && isset($parents[$route['parent']])) {
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
                    $DynamicMenu->route_name = $getRoute['as'];
                    if(isset($getRoute['icon'])){
                        $DynamicMenu->icon = $getRoute['icon'];
                    }else{
                        $DynamicMenu->icon = '';
                    }
                    if(isset($getRoute['name'])){
                        $DynamicMenu->name = $getRoute['name'];
                    }else{
                        $DynamicMenu->name = '';
                    }
                    if(isset($getRoute['description'])){
                        $DynamicMenu->description = $getRoute['description'];
                    }else{
                        $DynamicMenu->description = '';
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
                        $DynamicMenu->wrap_group = '';
                    }
                    if(isset($getRoute['wrap_group_level'])){
                        $DynamicMenu->wrap_group_level = $getRoute['wrap_group_level'];
                    }else{
                        $DynamicMenu->wrap_group_level = '';
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
            $this->updateFolderTime();
        }
        return true;
    }
    public function refreshMenu()
    {
        if($this->isModifyFolder())
        {
            $this->updateRoutes();
        }
        return true;
    }
}