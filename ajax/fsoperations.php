<?php

require_once("../class/Error.class.php");
require_once("../class/Path.class.php");
require_once("../serverinterface/localfs.class.php");

if(!isset($_GET["operation"])) {
	new Error("Required GET variable not given: operation", true);
}

$operation = $_GET["operation"];

$serverinterface = new Serverinterface_LocalFs(".");

switch($operation) {
	case "getDirContent":
		$dirPath = getVariable("dir");

		echo $serverinterface->getDirContent($dirPath);
		break;

}


function getVariable($varname, $required=true) {
	if(!isset($_GET[$varname])) {
		if($required)
			new Error("Required GET variable not given: " . $varname, true);
		else
			return "unkown";
	} else {
		return $_GET[$varname];
	}
}

?>