<?php

class Formvar {
	static public function get($varname, $method, $required) {
		if($method != "POST" && $metod != "GET") {
			Error::fatal("Unknown method to get variable: " . $method . "<br />Expected GET or POST");
		} 

		if(($method == "POST" && !isset($_POST[$varname])) || ($method == "GET" && !isset($_GET[$varname]))) {
			if($required) {
				Error::fatal("Undefined required " . $method . "-variable: " . $varname);
			} else {
				return undefined;
			}
		} else {
			if($method == "POST") {
				return $_POST[$varname];
			} else {
				return $_GET[$varname];
			}
		}
	}
}

?>