<?php

if(!function_exists("str_similar_percent")) {
 	function str_similar_percent(string $first , string $second, &$percent = 100) {

		$sim = similar_text($first, $second, $percent);

		return "$percent%";
	}
}