<?php

class Serverinterface_LocalFs {
	public $name = "Local Filesystem";

	private $rootdir;

	function __construct($dir) {
		$this->rootdir = $dir;
	}

	function getDirContent($subdir) {
		$path = implode("/", [$this->rootdir, $subdir]);
		$sdir = scandir($path);

	    $filesList = array();
	    $foldersList = array();
	    
	    // iterate over directory contents and populate arrays
	    foreach($sdir AS $item) {
echo implode("/", [$path, $item]) . "<br>aa ".$this->rootdir."<br>";
echo is_dir(implode("/", [$path, $item])) ? "trrr" : "fssss";

	        if($item == "." OR $item == "..")
	            continue;
	        
	        $thisItem = array(
	            "name" => $item,
	            "isdir" => is_dir(implode("/", [$path, $item])),
	            "filesize" => !is_dir(implode("/", [$path, $item])) ? filesize(implode("/", [$path, $item])) : false
	        );
	        
	        if(is_dir($path ."/". $item))
	            $foldersList[] = $thisItem;
	        else
	            $filesList[] = $thisItem;
	    }

	    return json_encode(array_merge($folderlistFolders, $folderlistFiles));
	}

	function getFileContent($filepath) {

	}

	function createDir($dir) {

	}
	
}

?>