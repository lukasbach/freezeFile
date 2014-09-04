<?php
session_start();

define("SUBPATH", "../");

require_once("../autoload.inc.php");

$ff = new Freezefile(SUBPATH);

include_once(SUBPATH . "layout/templates/windows/settings_apps.tpl.php");
?>