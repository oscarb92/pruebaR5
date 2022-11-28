<?php
ini_set('display_errors', 1);
include_once("config.php");

class createTable extends db_connection{

	public function create_db(){
		$mysqli = new mysqli($this->_host, $this->_db_user, $this->_db_password);
		// Check connection
		if($mysqli->connect_errno){
		    die("ERROR: Could not connect. " . $mysqli->connect_error);
		}

		$createDB = 'CREATE database IF NOT exists '.$this->_db_name;
   		$status_db = $mysqli->query( $createDB );

		$mysqli->select_db($this->_db_name);

		// Attempt create table query execution
		$createTB = "CREATE TABLE IF NOT EXISTS $this->_vehiculos_table(
		    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		    estado VARCHAR(30) NOT NULL,
		    marca VARCHAR(30) NOT NULL,
		    year VARCHAR(30) NOT NULL,
		    precio VARCHAR(30) NOT NULL,
		    imagen VARCHAR(150) NOT NULL
		)";
		$mysqli->query( $createTB );
		$mysqli->close();
	}

}

class vehiculosR5 {
  // Properties
  public $search;
  public $color;

  // Methods
  function consulta_vehiculos($search) {
    $this->search = $search;
  }
  function get_vehiculos() {
    return $this->search;
  }
}