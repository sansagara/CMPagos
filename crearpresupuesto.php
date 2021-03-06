<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}
$user_mail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Sistema de Pagos - Castillomax Oil & Gas</title>
  <link rel="icon" type="images/png" href="../images/favicon.png">
  <link rel="apple-touch-icon" href="../images/apple-touch-icon.png"> 
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head> 
<body>

<div class="container">

      <?php 
        $active="crearpresupuesto";
        include "navbar.php";
      ?>

      <div id="mensaje"></div>

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        <!-- Jumbotron -->
        <div class="jumbotron">
          <form id="InsertaPresupuesto" class="form-horizontal" onsubmit="return false">
          <fieldset>

          <!-- Form Name -->
          <legend>Insertar Presupuesto</legend>

          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="direccion">Direccion</label>
            <div class="col-md-8">
             
              <?php
                error_reporting(E_ALL);
                $hostname = "CMPagos.db.10955216.hostedresource.com";
                $username = "CMPagos";
                $dbname = "CMPagos";
                $password = "Sagara#87";
                mysql_connect($hostname, $username, $password) OR DIE ("Imposible conectar a la BD");
                mysql_select_db($dbname);

                $query = "SELECT D.* FROM Personal P LEFT JOIN Direcciones D ON P.id_direccion = D.id_direccion WHERE P.email = '$user_mail' LIMIT 1";
                $result = mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                  $id_direccion = $row["id_direccion"];
                  $direccion_ejec = utf8_encode($row["direccion_ejec"]);
                  print "<label style='padding-top: 7px;'>$direccion_ejec</label>";
                  print" <input type='text' style='display: none;' value='$id_direccion' id='dir_id' name='dir_id'>";
                }
              ?>

            </div>
          </div>

          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="partida">Partida</label>
            <div class="col-md-4">
              <select id="partida" name="partida" class="form-control">
              <?php
                $query = "SELECT * FROM Partidas WHERE habilitado = 1";
                $result = mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                  $partida = $row["partida"];
                  print" <option value='$partida'>$partida</option>";
                }
              ?>

              </select>
            </div>
          </div>

          <!-- Prepended text-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="cantidad_bs">Cantidades</label>
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon">Bs</span>
                <input id="cantidad_bs" name="cantidad_bs" class="form-control" placeholder="0.00" type="text">
              </div>
              
            </div>
          </div>

          <!-- Prepended text-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="cantidad_usd"></label>
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon"> $ </span>
                <input id="cantidad_usd" name="cantidad_usd" class="form-control" placeholder="0.00" type="text">
              </div>
              
            </div>
          </div>

          <!-- Prepended text-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="cantidad_eur"></label>
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon"> € </span>
                <input id="cantidad_eur" name="cantidad_eur" class="form-control" placeholder="0.00" type="text">
              </div>
              
            </div>
          </div>

            <!-- Button (Double) -->
            <div class="form-group">
            <label class="col-md-4 control-label" for="guardar"></label> 
              <div class="col-md-8">
                <button id="Guardar" name="guardar" class="btn btn-info">Guardar</button>
                <button id="Cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
              </div>
            </div>

          </fieldset>
          </form>
        </div> <!-- /. Jumbotron -->
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="">
         
              <?php
                $query = "SELECT * FROM Presupuesto WHERE id_direccion = $id_direccion";
                $result = mysql_query($query);
                $cont_bs = $cont_usd = $cont_eur = 0;
                while($row = mysql_fetch_array($result)) {
                  $partida_lista = $row["partida"];
                  $cantidad_bs = $row["cantidad_bs"];
                  $cantidad_usd = $row["cantidad_usd"];
                  $cantidad_eur = $row["cantidad_eur"];
                  $cont_bs += $cantidad_bs;
                  $cont_usd += $cantidad_usd;
                  $cont_eur += $cantidad_eur;

                  print" <div class='list-group'>";
                  print" <a href='#' class='list-group-item'>";
                  print"   <h4 class='list-group-item-heading'>$partida_lista</h4>";
                  print"   <p class='list-group-item-text'>Bs $cantidad_bs</p>";
                  print"   <p class='list-group-item-text'> $  $cantidad_usd</p>";
                  print"   <p class='list-group-item-text'> €  $cantidad_eur</p>";
                  print" </a>";
                  print" </div>";
                }

              print" <div class='list-group'>";
              print" <a href='#' class='list-group-item active'>";
              print"   <h4 class='list-group-item-heading'>Total</h4>";
              print"   <p class='list-group-item-text'>Bs $cont_bs</p>";
              print"   <p class='list-group-item-text'> $  $cont_usd</p>";
              print"   <p class='list-group-item-text'> €  $cont_eur</p>";
              print" </a>";
              print" </div>";
              ?>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>© Castillomax 2014</p>
      </footer>

    </div><!-- /. Container -->

  <script type="text/javascript">

    function EnviarDatos() {
      var IdDireccion = $('#dir_id').val();
      var Partida = $('#partida').val();
      var CantidadBs = $('#cantidad_bs').val();
      var CantidadUsd = $('#cantidad_usd').val();
      var CantidadEur = $('#cantidad_eur').val();

      $.ajax({
          type: "POST",
          url: "operacionesAjax/insertarPresupuesto.php",
          data: {id_direccion:IdDireccion, partida:Partida, cantidad_bs:CantidadBs, cantidad_usd:CantidadUsd, cantidad_eur:CantidadEur},
          success : function(data) {
            console.log(data);
            if (data == 1) {$('#mensaje').html('<div class="alert alert-success">Pago Insertado</div>'); location.reload().delay(3000);}
            else {$('#mensaje').html('<div class="alert alert-danger">Hubo un problema!</div>');}
        }
      })
    }

    $("#Guardar").click(function() {
      EnviarDatos();
      $('#InsertaPresupuesto').trigger("reset");
    });

    $("#Cancelar").click(function() {
      $('#InsertaPresupuesto').trigger("reset");
    });
  </script>

</body>
</html>   