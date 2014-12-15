<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
}
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
        $active="crearpresupuesto";
        include "navbar.php";
      ?>

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
        <!-- Jumbotron -->
        <div class="jumbotron">
          <form class="form-horizontal">
          <fieldset>

          <!-- Form Name -->
          <legend>Insertar Presupuesto</legend>

          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="direccion">Direccion</label>
            <div class="col-md-4">
              <select id="direccion" name="direccion" class="form-control" readonly>
                <option value="proyectos">Proyectos</option>
                <option value="finanzas">Finanzas</option>
                <option value="operaciones">Operaciones</option>
              </select>
            </div>
          </div>

          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="motivo">Motivo</label>
            <div class="col-md-4">
              <select id="motivo" name="motivo" class="form-control">
                <option value="nomina">Nomina</option>
                <option value="eventos">Eventos</option>
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
          <div class="list-group">
          <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Nomina</h4>
            <p class="list-group-item-text">Bs 670.000</p>
            <p class="list-group-item-text">$  25.000</p>
            <p class="list-group-item-text">€  6.000</p>
          </a>
          </div>
          <div class="list-group">
          <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Eventos</h4>
            <p class="list-group-item-text">Bs 800.000</p>
            <p class="list-group-item-text">$  50.000</p>
            <p class="list-group-item-text">€  15.000</p>
          </a>
          </div>
          <div class="list-group">
          <a href="#" class="list-group-item active">
            <h4 class="list-group-item-heading">Total</h4>
            <p class="list-group-item-text">Bs 1.1000.000</p>
            <p class="list-group-item-text">$  150.000</p>
            <p class="list-group-item-text">€  115.000</p>
          </a>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

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

      var Tipo = $('#tipo').val();
      var Prioridad = $('#prioridad').val();
      var Beneficiario = $('#beneficiario').val();
      var Descripcion = $('#descripcion').val();
      var Monto = $('#monto').val();
      var Fecha = $('#fecha').val();

      $.ajax({
          type: "POST",
          url: "insertarA.php",
          data: { tipo:Tipo, prioridad:Prioridad, beneficiario:Beneficiario, descripcion:Descripcion, monto:Monto, fecha:Fecha },
          success : function(data) {
            console.log(data);
            $('#mensaje').html('<div class="alert alert-success">Pago Insertado</div>');
        }
      })
    }

    $("#Guardar").click(function() {
        EnviarDatos();
        $('#InsertaPago').trigger("reset");
    });

    $("#Cancelar").click(function() {
      $('#InsertaPago').trigger("reset");
    });
  </script>

</body>
</html>   