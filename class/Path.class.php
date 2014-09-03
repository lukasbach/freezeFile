<?php

class Path {
	private $path;

	function __construct() {
		//$this->path = "";
	}

	public static function withPath($path) {
		$p = new self();
		$p->path = $path;
		return $p;
	}

	public static function withPaths($paths) {
		$p = new self();
		$p->joinpaths($paths);
		return $p;
	}

	public static function emptyPath() {
		$p = new self();
		return $p;
	}


	/*
	function __construct($path) {
		$this->path = $path;
	}

	function __construct(array $paths) {
		$this->path = "";
		joinpaths($paths);
	}

	*/

	public function joinpaths(array $paths) {
		array_unshift($paths, $this->path);

		foreach($paths AS $pathitem) {
			if(is_string($pathitem) AND $pathitem != "") {
				$this->path .= "/" . $pathitem;
			} elseif($pathitem instanceof Path) {
				$this->path .= "/" . $pathitem->get();
			}
		}

		$this->path = substr($this->path, 1);
	}

	public function clean() {
		$pathPieces = $this->path.explode("/");
		$this->path = "";
		joinpaths($pathPieces);
	}

	public function set($path) {
		$this->path = $path;
	}

	public function setWithArray(array $paths) {
		$this->path = "";
		joinpaths($paths);
	}

	public function get() {
		return $this->path;
	}
}

?>