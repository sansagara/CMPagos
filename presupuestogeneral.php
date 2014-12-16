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
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/datepicker3.css" >
  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/locales/bootstrap-datepicker.es.js" charset="UTF-8"></script>
  <style>
    .jumbotron {background-color: transparent;}
    .bs-callout {
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
    }
    .bs-callout h4 {
        margin-top: 0;
        margin-bottom: 5px;
    }
  </style>
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

    <h2>Direccion de Finanzas</h2>
    <hr>

    <div class="bs-callout bs-callout-default">
      <h4>Nomina</h4>
      Bolivares (Bs)
      <div class="progress">
        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
          <span class="sr-only">40% Restante</span>
        </div>
      </div>

      Dolares ($)
      <div class="progress">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
          <span class="sr-only">20% Restante</span>
        </div>
      </div>

      Euros (€)
      <div class="progress">
        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
          <span class="sr-only">60% Restante</span>
        </div>
      </div>
    </div>


      <div class="bs-callout bs-callout-default">
      <h4>Eventos</h4>
      Bolivares (Bs)
      <div class="progress">
        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
          <span class="sr-only">78% Restante</span>
        </div>
      </div>

      Dolares ($)
      <div class="progress">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%">
          <span class="sr-only">43% Restante</span>
        </div>
      </div>

      Euros (€)
      <div class="progress">
        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 99%">
          <span class="sr-only">99% Restante</span>
        </div>
      </div>
    </div>

    </div> <!-- /. Jumbotron -->

	<hr>
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
          url: "operacionesAjax/insertarPresupuesto.php",
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
