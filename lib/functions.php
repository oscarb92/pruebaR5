<?php
ini_set('display_errors', 1);
include_once("config.php");

class createTable extends db_connection{

	public function conect_db(){
		echo $this->_db_name;
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

$apple = new vehiculosR5();
$banana = new vehiculosR5();
$apple->consulta_vehiculos('Apple');
$banana->consulta_vehiculos('Banana');

echo $apple->get_vehiculos();
echo "<br>";
echo $banana->get_vehiculos();