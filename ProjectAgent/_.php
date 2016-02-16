<?php

define('DB_NAME', 'bms');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

class Database {

	protected $connection = null;
	
	public static function get_instance() {
		static $instance = null;

		if ($instance === null) {
			$instance = new self();
		}

		return $instance;
	}

	protected function __construct() {
		$this->connection = $this->connection
	}

	public function connect($database_name, $database_user, $database_password, $database_host = 'localhost') {
		$this->connection = mysql_connect($database_host, $database_user, $database_password);

		if ( ! $this->connection) {

		}

		$this->instance = mysql_select_db($database_name, $this->connection);

		if ($database_instance) {
			return $this->instance;
		}

		$this->connection = mysqli_connect($database_host, $database_user, $database_password, $database_name);

		if ( ! mysqli_connect_errno()) {
			return $this->connection;
		}

		return null;
	}
}

$database = new Database();

function database() {
	$database = new Database();
	return Database::get_instance(DB_NAME, DB_USER, DB_PASSWORD, DB_NAME);
}       