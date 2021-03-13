<?php

spl_autoload_register(function ($class) {
	$classname = str_replace("\\", '/', $class);
	$classname = str_replace('ThemeCore/', '', $classname);
	$file = __DIR__ . "/" . $classname . '.php';
	if(file_exists($file)){
	  include $file;
	  return true;
	}
});