<?php include_once("lib/functions.php"); 
$createTable = new vehiculosR5();
$createTable->create_db();
?>
<html>
  <head>
    <title>Agregar Vehículo</title>
    <link rel="stylesheet" type="text/css" href="./css/yearpicker.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css?tets=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="./js/simple-mask-money.js"></script>
    <script src="./js/yearpicker.js"></script>
    <script src="./js/script.js"></script>
  </head>
  <body>
    <div class="m-container">
        <?php include_once("header.php"); ?>
        <div class="m-head">
          <h1>Buscar vehículos</h1>
        </div>

        <div class="content-m">
            <form class="search-form" action="./lib/ajax.php?buscar" method="post">
              <div class="flex-form-search">
                <div class="m-field-search">
                    <input type="text" name="buscar" placeholder="Buscar" class="m-field">
                </div>
                <div class="m-field-search">
                    <select name="marca" class="m-field marca-field">
                      <option value="">Seleccione una marca</option>
                    </select>
                </div>
                <div class="m-field-search">
                    <select name="estado" class="m-field">
                      <option value="">Estado</option>
                      <option value="nuevo">Nuevo</option>
                      <option value="usado">Usado</option>
                    </select>
                </div>
                <div class="m-field-search">
                    <input type="number" name="year" placeholder="Año" class="m-field yearpickerM">
                </div>
                 <div class="m-field-search">
                    <input type="submit" name="submit" class="btn" value="Buscar">
                </div>
              </div>
            </form>

            <div class="content-results">
                <div class="flex-results"></div>
            </div>
        </div>

    </div>
    <?php include_once("footer.php"); ?>
  </body>
</html>