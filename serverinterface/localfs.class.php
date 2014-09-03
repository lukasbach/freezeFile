<?php

class Serverinterface_LocalFs {
	public $name = "Local Filesystem";

	//public $rootdir = Path::emptyPath();	
	public $rootdir;


	function __construct($dir) {
		//$this->rootdir.set($dir);
		$this->rootdir = Path::withPath($dir);
		//echo "PPATH " . $this->rootdir.get();
	}

	function getDirContent($subdir) {
		$path = Path::withPaths([$this->rootdir, $subdir]);
		$sdir = scandir($path->get());

	    $filesList = array();
	    $foldersList = array();
	    
	    // iterate over directory contents and populate arrays
	    foreach($sdir AS $item) {

	        if($item == "." OR $item == "..")
	            continue;

	        $fullpath = Path::withPaths([$path, $item]);
	        
	        $thisItem = array(
	            "name" => $item,
	            "isdir" => is_dir($fullpath->get()),
	            "filesize" => !is_dir($fullpath->get()) ? filesize($fullpath->get()) : false
	        );
	        
	        if(is_dir($fullpath->get()))
	            $foldersList[] = $thisItem;
	        else
	            $filesList[] = $thisItem;
	    }

	    return json_encode(array_merge($foldersList, $filesList));
	}

	function getFileContent($filepath) {

	}

	function createDir($dir) {

	}
	
}

?>