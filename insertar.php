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

  <!-- Container -->
  <div class="container">

    <?php 
      $active="insertar";
      include "navbar.php";
    ?>

    <!-- Jumbotron -->
    <div class="jumbotron">
      <form id="InsertaPago" class="form-horizontal" onsubmit="return false">
        <fieldset>

        <!-- Form Name -->
        <legend>Insertar Nuevo Pago</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="tipo">Tipo</label>  
          <div class="col-md-6">
            <input id="tipo" name="tipo" type="text" placeholder="COMP" class="form-control input-md" required="">  
          </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="prioridad">Prioridad</label>
          <div class="col-md-6">
            <select id="prioridad" name="prioridad" class="form-control">
              <option value="1">1 (Muy Urgente)</option>
              <option value="2">2</option>
              <option value="">3</option>
              <option value="">4</option>
              <option value="">5 (Poco Urgente)</option>
            </select>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="beneficiario">Beneficiario</label>  
          <div class="col-md-6">
          <input id="beneficiario" name="beneficiario" type="text" placeholder="Corp Compu1000 RIF J-123456" class="form-control input-md" required="">
            
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="descripcion">Descripcion</label>  
          <div class="col-md-6">
          <input id="descripcion" name="descripcion" type="text" placeholder="Pago de Consumibles" class="form-control input-md" required="">
            
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="monto">Monto</label>  
          <div class="col-md-6">
          <input id="monto" name="monto" type="text" placeholder="1000" class="form-control input-md" required="">
            
          </div>
        </div>

        <!-- DatePicker -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="fecha">Fecha</label>  
          <div class="date col-md-6">
            <input id="fecha" name="fecha"  type="text" class="form-control input-md">
          
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

        <div id="mensaje"></div>
        </fieldset>
      </form>

    </div> <!-- /. Jumbotron -->

      <footer>
        <p>© Castillomax 2014</p>
      </footer>
      
  </div> <!-- /. Container -->

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