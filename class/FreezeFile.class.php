<?php

class FreezeFile {
	private $config;
	private $subpath;

	public $mysqli;
	public $sessionData;
	public $user;
	public $database;

	function __construct($subpath) {
		$this->subpath = $subpath;
		$this->initMysqlInstance();

		if(isset($_GET["action"])) {
			$this->performAction($_GET["action"]);
		}
	}

	private function loadConfiguration() {
		include($this->subpath . "cfg.inc.php");
		$this->config = $config;
	}

	private function initMysqlInstance() {
		$this->mysqli = new mysqli(
			$this->getconfigVar("mysql_server"), 
			$this->getconfigVar("mysql_user"), 
			$this->getconfigVar("mysql_password"), 
			$this->getconfigVar("mysql_database")
		);

		if ($this->mysqli->connect_error || mysqli_connect_error()) {
		    Error::fatal("Could not connect to database");
		}	
	}

	public function getConfigVar($var) {
		if(!isset($this->config) || $this->config == null) {
			$this->loadConfiguration();
		}

		if(!isset($this->config[$var])) {
			Error::fatal("Attempting to get undefined configuration variable: " . $var);
		}

		return $this->config[$var];
	}

	public function getMysqlInstance() {
		if(isset($this->mysqli) || $this->mysqli == null) {
			$this->initMysqlInstance();
		}

		return $this->mysqli;
	}

	public function getDbInstance() {
		if(isset($this->database) || $this->database == null) {
			$this->database = new Database($this->getMysqlInstance(), $this->getConfigVar("mysql_prefix"));
		}

		return $this->database;

	}

	public function isLoggedIn() {
		return isset($_SESSION[$this->config["phpsession_prefix"] . "isloggedin"])
			&& $_SESSION[$this->config["phpsession_prefix"] . "isloggedin"] == "true";
	}

	private function performAction($actionName) {
		if($actionName == "login") {
			$username = Formvar::get("login-username", "POST", true);
			$password = Formvar::get("login-password", "POST", true);

			$user = new User();
			if($user->tryLogin($username, $password, $this->getDbInstance())) {
				$this->logUserIn($username, $this->getDbInstance());
			} else {
				Error::warning("Wrong username or password. Try again.", true);
			}
		}
	}

	private function logUserIn($username, $db) {
		$_SESSION[$this->config["phpsession_prefix"] . "isloggedin"] = "true";
		$_SESSION[$this->config["phpsession_prefix"] . "username"] = $username;	

		require_once($this->subpath . "layout/templates/successfulLogin.tpl.php");
		exit;
	}
}

?>