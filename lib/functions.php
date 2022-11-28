<?php
ini_set('display_errors', 1);
include_once("config.php");

class vehiculosR5 extends db_connection{

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
		    linea VARCHAR(30) NOT NULL,
		    year VARCHAR(30) NOT NULL,
		    precio VARCHAR(30) NOT NULL,
		    imagen VARCHAR(150) NOT NULL
		)";
		$mysqli->query( $createTB );
		$mysqli->close();
	}

	public function insert($table, $fields = false, $values = false) {

			$conn = new mysqli($this->_host, $this->_db_user, $this->_db_password, $this->_db_name);

			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			if($fields && $values):

				$sql = "INSERT INTO $table ($fields) VALUES ($values)";
				if ($conn->query($sql) === TRUE) {
					$result = 1;
				} else {
				  $result = "Error: " . $sql . "<br>" . $conn->error;
				}

				return $result;

			else:

				die('Invalid Columns');

			endif;

			$conn->close();

	}

	public function select($table, $where = false) {

			$conn = new mysqli($this->_host, $this->_db_user, $this->_db_password, $this->_db_name);

			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			if($where):

				$sql = "SELECT * FROM $table ".$where;
				$result = $conn->query($sql);
				//var_dump($sql);
				if($result->num_rows > 0) {
					$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
				}else{
					$row = false;
				}

				return $row;

			else:

				$sql = "SELECT * FROM $table";
				$result = $conn->query($sql);
				if($result->num_rows > 0) {
					$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
				}else{
					$row = false;
				}

				return $row;
				var_dump($row);

			endif;

			$conn->close();

	}

}