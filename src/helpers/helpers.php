<?php

if(!function_exists("str_similar_percent")) {
 	function str_similar_percent(string $first , string $second, &$percent = 100) {

		$sim = similar_text($first, $second, $percent);

		return "$percent%";
	}
}

if(class_exists('kamruljpi\Role\Http\Model\UserRoleMenu') && method_exists('kamruljpi\Role\Http\Model\UserRoleMenu', 'generateMenu') && !function_exists('generateMenu')){

	function generateMenu() {

		$menus = kamruljpi\Role\Http\Model\UserRoleMenu::generateMenu();

		return $menus;

	}
}
