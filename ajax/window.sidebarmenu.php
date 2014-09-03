<?php
session_start();

define("SUBPATH", "../");

require_once("../autoload.inc.php");

$ff = new Freezefile(SUBPATH);

if($ff->isLoggedIn()) {
	include_once(SUBPATH . "layout/templates/windows/menu_loggedin.tpl.php");
} else {
	include_once(SUBPATH . "layout/templates/windows/menu_notloggedin.tpl.php");
}
?>