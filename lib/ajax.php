<?php include_once("functions.php");

$objR5 = new vehiculosR5();

if(isset($_GET['upload'])){

	$objR5->create_db();

	$result = array(
		"completado"	=> false,
		"error" 		=> 0,
		"image"			=> 0,
		"result"		=> 0
	);

	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
	$path = "";
	//echo "<pre>";var_dump($_POST);echo "<pre>";
	if(!empty($_POST['estado']) && !empty($_POST['marca']) && !empty($_POST['linea']) && !empty($_POST['year']) && !empty($_POST['precio']) && $_POST['precio'] != "$0.00"){
		$estado = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
		$marca = filter_var($_POST['marca'], FILTER_SANITIZE_STRING);
		$linea = filter_var($_POST['linea'], FILTER_SANITIZE_STRING);
		$year = filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT);
		$price = filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
		$price = str_replace('$', '', $price);
		$price = floatval(str_replace(',', '', $price));
		$error_image = false;
		if(isset($_FILES['imagen']['name']) && !empty($_FILES['imagen']['name'])){
			$path = '../uploads/';
			$img = $_FILES['imagen']['name'];
			$tmp = $_FILES['imagen']['tmp_name'];
			// get uploaded file's extension
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
			// can upload same image using rand function
			$final_image = rand(1000,1000000).$img;
			// check's valid format
			if(in_array($ext, $valid_extensions)) {
				$path = $path.strtolower($final_image); 
				if(move_uploaded_file($tmp,$path)) {
					
				}
			} else {
				$result["error"] = 1;
				$result["msg"] = "Error de formato de imagen";
				$error_image = true;
			}
		}
		if(!$error_image){
			$str_values = '"'.$estado.'","'.$marca.'","'.$linea.'","'.$year.'","'.$price.'","'.$path.'"';
			$insert = $objR5->insert( "vehiculos", "estado, marca, linea, year, precio, imagen", $str_values );
			$result["error"] = 0;
			$result["completado"] = true;
			$result["msg"] = "Los datos han sido guardados";
			$result["result"] = $insert;
		}
		
	}else{
		$result["error"] = 1;
		$result["msg"] = "Complete los campos requeridos";
	}

	echo json_encode($result);
}

if(isset($_GET['buscar'])){

	$result = array(
		"completado" => false,
		"data" => 0,
		"errors" => 0
	);
	$table = "vehiculos";
	$where = " WHERE ";
	$and = 0;

	if(!empty($_POST['buscar'])){
		$where .= ($and > 0)?" AND ":"";
		$str_buscar = $_POST['buscar'];
		$where .= "(estado LIKE '%".$str_buscar."%' OR marca LIKE '%".$str_buscar."%' OR year LIKE '%".$str_buscar."%' OR linea LIKE '%".$str_buscar."%')";
		$and++;
	}
	if(!empty($_POST['estado'])){
		$where .= ($and > 0)?" AND ":"";
		$where .= "estado = '".$_POST['estado']."'";
		$and++;
	}
	if(!empty($_POST['marca'])){
		$where .= ($and > 0)?" AND ":"";
		$where .= "marca = '".$_POST['marca']."'";
		$and++;
	}
	if(!empty($_POST['year'])){
		$where .= ($and > 0)?" AND ":"";
		$where .= "year = '".$_POST['year']."'";
		$and++;
	}
	if($and>0){
		$select = $objR5->select( $table, $where );
		$result["data"] = $select;
		$result["completado"] = true;
	}else{
		$select = $objR5->select( $table );
		$result["data"] = $select;
		$result["completado"] = true;
	}

	echo json_encode($result);
}

if(isset($_GET['marca'])){
	$table = "vehiculos";
	$select = $objR5->select( $table );
	$arr_data = array();
	if(isset($select[0]["id"])){
		foreach ($select as $row) {
			$arr_data[] = $row["marca"];
		}
	}
	$arr_data = array_values(array_unique($arr_data));
	
	echo json_encode(array("data"=>$arr_data));
}