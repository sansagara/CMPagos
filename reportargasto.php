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
  <link rel="stylesheet" href="css/datepicker3.css" >
  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/locales/bootstrap-datepicker.es.js" charset="UTF-8"></script>
</head> 
<body>

<div class="container">

      <?php 
        $active="reportargasto";
        include "navbar.php";
      ?>

      <div id="mensaje"></div>

        <!-- Jumbotron -->
        <div class="jumbotron">
          <form id="InsertaGasto" class="form-horizontal" onsubmit="return false">
          <fieldset>

          <!-- Form Name -->
          <legend>Reportar Gasto</legend>

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
            <div class="col-md-6">
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

          <!-- DatePicker-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Fecha</label>  
            <div class="date col-md-6">
            <input id="fecha" name="fecha" type="text" class="form-control input-md">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="textinput">Descripcion</label>  
            <div class="col-md-6">
            <input id="descripcion" name="descripcion" type="text" class="form-control input-md">
            </div>
          </div>

          <!-- Prepended text-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="cantidad_bs">Cantidades</label>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-addon">Bs</span>
                <input id="cantidad_bs" name="cantidad_bs" class="form-control" placeholder="0.00" type="text">
              </div>
              
            </div>
          </div>

          <!-- Prepended text-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="cantidad_usd"></label>
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-addon"> $ </span>
                <input id="cantidad_usd" name="cantidad_usd" class="form-control" placeholder="0.00" type="text">
              </div>
              
            </div>
          </div>

          <!-- Prepended text-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="cantidad_eur"></label>
            <div class="col-md-6">
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

        <table class="table table-hover">
          <tr>
            <th>Partida</th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Bs</th>
            <th>$</th>
            <th>€</th>
          </tr>

          <?php
            $query = "SELECT * FROM Gastos WHERE id_direccion = $id_direccion";
            $result = mysql_query($query);
            while($row = mysql_fetch_array($result)) {
              $partida = $row["partida"];
              $fecha = $row["fecha"];
              $descripcion = $row["descripcion"];
              $cantidad_bs = $row["cantidad_bs"];
              $cantidad_usd = $row["cantidad_usd"];
              $cantidad_eur = $row["cantidad_eur"];

              print"<tr>";
              print" <td>$partida</td>";
              print" <td>$fecha</td>";
              print" <td>$descripcion</td>";
              print" <td>$cantidad_bs</td>";
              print" <td>$cantidad_usd</td>";
              print" <td>$cantidad_eur</td>";
              print"</tr>";
            }
          ?>
        </table>

      <hr>

      <footer>
        <p>© Castillomax 2014</p>
      </footer>

    </div><!-- /. Container -->

  <script type="text/javascript">
    $('#fecha').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        language: "es",
        autoclose: true,
        todayHighlight: true
    });
  </script>

  <script type="text/javascript">

    function EnviarDatos() {
      var IdDireccion = $('#dir_id').val();
      var Partida = $('#partida').val();
      var Fecha = $('#fecha').val();
      var Descripcion = $('#descripcion').val();
      var CantidadBs = $('#cantidad_bs').val();
      var CantidadUsd = $('#cantidad_usd').val();
      var CantidadEur = $('#cantidad_eur').val();

      $.ajax({
          type: "POST",
          url: "operacionesAjax/insertarGasto.php",
          data: {id_direccion:IdDireccion, partida:Partida, fecha:Fecha, descripcion:Descripcion, cantidad_bs:CantidadBs, cantidad_usd:CantidadUsd, cantidad_eur:CantidadEur},
          success : function(data) {
            console.log(data);
            if (data == 1) {$('#mensaje').html('<div class="alert alert-success">Gasto Insertado</div>'); location.reload().delay(3000);}
            else {$('#mensaje').html('<div class="alert alert-danger">Hubo un problema!</div>');}
        }
      })
    }

    $("#Guardar").click(function() {
      EnviarDatos();
      $('#InsertaGasto').trigger("reset");
    });

    $("#Cancelar").click(function() {
      $('#InsertaGasto').trigger("reset");
    });
  </script>

</body>
</html>   