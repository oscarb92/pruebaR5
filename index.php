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
    <script type="text/javascript">
      jQuery(document).ready(function($){
          //$(".marca-field")
          $.ajax({
                  url: "./lib/ajax.php?marca",
                  type: "POST",
                  contentType: false,
                  cache: false,
                  processData:false,
                  dataType: "json",
                  beforeSend : function(){
                    //$("#preview").fadeOut();
                    $(".marca-field").prop("disabled", true);
                    $(".content-results").addClass('loading');
                  },
                 success: function(data){
                    
                    let values = data.data;
                    console.log(values);
                    var marcas = [];
                    for (let row of values) {
                      marcas.push({"id": row, "text": row});
                    }
                    $(".marca-field").select2({
                      data: marcas
                    });
                    $(".marca-field").prop("disabled", false);
                  },
                  error: function(e) {
                    console.log(e)
                    //$("#err").html(e).fadeIn();
                    $(".marca-field").prop("disabled", false);
                  }          
          });

          $('form.search-form').on('submit', function(e){
            e.preventDefault();
            $(".content-results .flex-results").html("");
            $(".content-results").removeClass('loading');
              $.ajax({
                  url: "./lib/ajax.php?buscar",
                  type: "POST",
                  data:  new FormData(this),
                  contentType: false,
                  cache: false,
                  processData:false,
                  dataType: "json",
                  beforeSend : function(){
                    //$("#preview").fadeOut();
                    $(".content-results").addClass('loading');
                  },
                 success: function(data){
                    console.log(data);
                    if(data.completado){
                      var values = data.data;
                      var html= '';
                      for (let row of values) {
                          var image = (row.imagen).replaceAll("..",".");
                          image = image == "" ? "./assets/images/logo.png" : image;
                          html += '<div class="item-car-box"><div class="conte-box"><div class="img-box"><img src="'+image+'"></div><div class="content-txt-box">';
                          html += '<h3>'+row.marca+'</h3>';
                          html += '<div class="item-list-box"><span>Estado</span>: '+row.estado+'</div>';
                          html += '<div class="item-list-box"><span>Línea</span>: '+row.linea+'</div>';
                          html += '<div class="item-list-box"><span>Año</span>: '+row.year+'</div>';
                          html += '<div class="item-list-box price-box"><span>Precio</span>: '+row.precio+'</div>';
                          html += '</div></div></div>';
                      }
                      $(".content-results .flex-results").html(html);
                    }else{
                      
                    }
                    $(".content-results").addClass('loading');
                  },
                  error: function(e) {
                    console.log(e)
                    //$("#err").html(e).fadeIn();
                    $(".content-results").addClass('loading');
                  }          
              });

          });
      });
    </script>
    <?php include_once("footer.php"); ?>
  </body>
</html>