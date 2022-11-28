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
	if(!empty($_POST['estado']) && !empty($_POST['marca']) && !empty($_POST['linea']) && !empty($_POST['year']) && !empty($_POST['precio'])){
		$estado = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
		$marca = filter_var($_POST['marca'], FILTER_SANITIZE_STRING);
		$linea = filter_var($_POST['linea'], FILTER_SANITIZE_STRING);
		$year = filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT);
		$price = filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
		$price = str_replace('$', '', $price);
		$price = floatval(str_replace(',', '', $price));
		$error_image = false;
		if(isset($_FILES['imagen'])){
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
		
	}

	echo json_encode($result);
}