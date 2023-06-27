<?php

if (!function_exists('dd')) {
	function dd(...$args)
	{
		if (function_exists('dump')) {
			var_dump(...$args);
		} else {
			var_dump(...$args);
		}
		die;
	}
}
