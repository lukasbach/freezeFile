<?php

class Database {
	private $mysqli, $tablePrefix;

	function __construct($mysqli, $tablePrefix) {
		$this->mysqli = $mysqli;
		$this->tablePrefix = $tablePrefix;
	}

	public function query($q) {
		return $this->mysqli->query($q);
	}

	public function getPrefix() {
		return $this->tablePrefix;
	}

	// fetch object
}

?>