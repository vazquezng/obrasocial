<?php

define('ROOT', __DIR__ . '/../');
//Simple autoload namespaces
function __autoload($class) {
	error_log($class);
	$path = str_replace('\\', '/', $class);
	error_log(ROOT . $path . '.php');
	require ROOT . $path . '.php';
}

?>
