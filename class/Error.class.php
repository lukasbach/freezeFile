<?php

class Error {
	function __construct($errormsg, $exit) {
		echo $errormsg;
		exit;
	}

	static public function fatal($errormsg) {
		echo $errormsg;
		exit;
	}

	static public function warning($errormsg, $exit) {
		echo $errormsg;
		if($exit) {
			exit;
		}
	}
}

?>