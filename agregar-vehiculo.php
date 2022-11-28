<?php include_once("lib/functions.php"); 
$createTable = new createTable();
$createTable->create_db();
?>
<html>
  <head>
    <title>Agregar Vehículo</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <script src="./js/script.js"></script>
  </head>
  <body>
    <div class="m-container">
        <?php include_once("header.php"); ?>
        <div class="m-head">
          <h1>Agregar vehículo</h1>
        </div>

    </div>
  </body>
</html>