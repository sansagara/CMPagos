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
    <title>
      Sistema de Pagos - Castillomax Oil & Gas
    </title>
    <link rel="icon" type="images/png" href="../images/favicon.png">
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
    
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/datepicker3.css" >
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js">
    </script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js">
    </script>
    <script src="js/bootstrap-datepicker.js">
    </script>
    <script src="js/locales/bootstrap-datepicker.es.js" charset="UTF-8">
    </script>
    <style>
      .jumbotron {
        background-color: transparent;
      }
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
$active="presupuestogeneral";
include "navbar.php";
?>
      
      <!-- Jumbotron -->
      <div class="jumbotron">
		<?php
	error_reporting(E_ALL);
	$hostname = "CMPagos.db.10955216.hostedresource.com";
	$username = "CMPagos";
	$dbname = "CMPagos";
	$password = "Sagara#87";
	mysql_connect($hostname, $username, $password) OR DIE ("Imposible conectar a la BD");
	mysql_select_db($dbname);
	$query = "SELECT * FROM Direcciones";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$id_direccion = $row["id_direccion"];
		$direccion = utf8_encode($row["direccion_ejec"]);
		print "
			
			<h2>
			$direccion
			<a class='btn btn-default pull-right' data-toggle='collapse' href='#collapse$id_direccion' aria-controls='collapseExample' style='align:right;'>
				Ver/Ocultar
			</a>
			</h2>
			<hr>
			<div class='collapse' id='collapse$id_direccion'>
			";
		$query2 = "SELECT * FROM Presupuesto WHERE id_direccion = '$id_direccion'";
		$result2 = mysql_query($query2);
		while($row2 = mysql_fetch_array($result2)) {
			$motivo = $row2["motivo"];
			$cantidad_bs = $row2["cantidad_bs"];
			$cantidad_usd = $row2["cantidad_usd"];
			$cantidad_eur = $row2["cantidad_eur"];
			print"
				<div class='bs-callout bs-callout-default' id='progress_group' data-parent='collapse$id_direccion'>
				<h4>
				$motivo
				</h4>
				
					Bolivares (Bs)
					<div class='progress' id='progress_parent' data-parent='collapse$id_direccion'>
					<div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width: 100%' id='progress_child' data-parent='collapse$id_direccion'>
					100% ($cantidad_bs / $cantidad_bs)
					<span class='sr-only'>
					40% Restante
					</span>
					</div id='progress_child'>
					</div id='progress_parent'>
				
					Dolares ($)
					<div class='progress' id='progress_parent' data-parent='collapse$id_direccion'>
					<div class='progress-bar progress-bar-info progress-bar-striped' role='progressbar' aria-valuenow='20' aria-valuemin='0' aria-valuemax='100' style='width: 100%' id='progress_child' data-parent='collapse$id_direccion'>
					100% ($cantidad_usd / $cantidad_usd)
					<span class='sr-only'>
					20% Restante
					</span>
					</div id='progress_child'>
					</div id='progress_parent'>
				
					Euros (€)
					<div class='progress' id='progress_parent' data-parent='collapse$id_direccion'>
					<div class='progress-bar progress-bar-warning progress-bar-striped' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 100%' id='progress_child' data-parent='collapse$id_direccion'>
					100% ($cantidad_eur / $cantidad_eur)
					<span class='sr-only'>
					60% Restante
					</span>
					</div id='progress_child'>
					</div id='progress_parent'>
				</div id='progress_group'>";
		}
	print "	</div id='collapse$id_direccion'>";
	}

	?>
        
      </div>
      
      <!-- /. Jumbotron -->
      
      <hr>
      <footer>
        <p>
          © Castillomax 2014
        </p>
      </footer>
      
    </div>
    
    <!-- /. Container -->
    
    <script type="text/javascript">
      $('#fecha').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        language: "es",
        autoclose: true,
        todayHighlight: true
      }
                            );
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
          data: {
            tipo:Tipo, prioridad:Prioridad, beneficiario:Beneficiario, descripcion:Descripcion, monto:Monto, fecha:Fecha }
          ,
          success : function(data) {
            console.log(data);
            $('#mensaje').html('<div class="alert alert-success">Pago Insertado</div>');
          }
        }
              )
      }
      
      $("#Guardar").click(function() {
        EnviarDatos();
        $('#InsertaPago').trigger("reset");
      }
                         );
      
      $("#Cancelar").click(function() {
        $('#InsertaPago').trigger("reset");
      }
                          );
    </script>
    
  </body>
</html>

