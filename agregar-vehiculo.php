<?php include_once("lib/functions.php"); 
$createTable = new vehiculosR5();
$createTable->create_db();
?>
<html>
  <head>
    <title>Agregar Vehículo</title>
    <link rel="stylesheet" type="text/css" href="./css/yearpicker.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
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
          <h1>Agregar vehículo</h1>
        </div>

        <div class="content-form">
            <form class="form-add-car" action="./lib/ajax.php?upload" method="post" enctype="multipart/form-data">
                <div class="alert-form" style="display: none;"></div>
                <div class="element-field">
                  <select name="estado" class="m-field" required>
                    <option value="">Seleccione el estado</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="nuevo">Usado</option>
                  </select>
                </div>
                <div class="element-field">
                  <select name="marca" class="m-field marca-select2" required>
                    <option value="">Selecciona una marca</option>
                    <option value="Mazda">Mazda</option>
                    <option value="Toyota">Toyota</option>
                    <option value="Ford">Ford</option>
                    <option value="Hyunday">Hyundai</option>
                    <option value="Kia">Kia</option>
                  </select>
                </div>
                <div class="element-field">
                  <input type="text" name="linea" placeholder="Línea" class="m-field" required>
                </div>
                <div class="element-field">
                  <input type="number" name="year" placeholder="Año" class="m-field yearpickerM" required>
                </div>
                <div class="element-field">
                  <input type="text" name="precio" placeholder="Precio" class="m-field" id="price" required>
                </div>
                <div class="element-field">
                  <input type="file" name="imagen" class="m-field" accept="image/*">
                </div>
                <div class="footer-form">
                    <input type="submit" name="submit" class="btn" value="Agregar">
                </div>
            </form>
        </div>

    </div>
    <?php include_once("footer.php"); ?>
  </body>
</html>