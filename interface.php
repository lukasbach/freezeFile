<?php
session_start();

define("PAGETITLE", "FreezeFile");
define("SUBPATH", "./");

require_once("autoload.inc.php");

$ff = new Freezefile(SUBPATH);

require_once("layout/templates/header.tpl.php");
require_once("layout/templates/headbar.tpl.php");
require_once("layout/templates/filelist.tpl.php");
require_once("layout/templates/containers.tpl.php");
require_once("layout/templates/footer.tpl.php");

?>