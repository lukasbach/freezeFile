<?php

class User {
	private $userid, $username, $groupid, $permissions;

	function __construct() {
	}

	public static function widthId($id, $db) {
		$u = new self();
		$u->userid = $id;
		// ...

		return $u;
	}

	public function withNothing() {
		return self();
	}

	public function tryLogin($username, $password, $database) {
		$result = $database->query("SELECT * FROM " . $database->getPrefix() 
			. "users WHERE name = '$username' && password = '$password' LIMIT 1");

		if($result->num_rows > 0) {
			$this->setWithId($result->fetch_assoc()["id"], $database);
			return true;
		} else {
			return false;
		}
	}

	private function setWithId($id, $db) {
		$this->userid = $id;
		//...
	}

}

?>