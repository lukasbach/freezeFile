<?php
/*
 * Loads a class with the name
 * Some_Fancy_Name
 * from one of the following paths:
 * some/fancy/name.class.php
 * or
 * some/fancy/class/name.class.php
 */

function __autoload($className) {
	$classNamePieces = explode("_", strtolower($className));
	$pathToClass = implode("/", array_merge([SUBPATH], $classNamePieces));

	$pathToClassInSubDir = array_merge([SUBPATH], $classNamePieces);
	array_splice($pathToClassInSubDir, count($pathToClassInSubDir) - 1, 0, 'class');
	$pathToClassInSubDir = implode("/", $pathToClassInSubDir);

	if(file_exists($pathToClass . ".class.php")) {
		require_once($pathToClass . ".class.php");
	} elseif(file_exists($pathToClassInSubDir . ".class.php")) {
		require_once($pathToClassInSubDir . ".class.php");}
}

?>