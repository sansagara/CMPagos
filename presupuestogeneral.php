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

		$query2 = "SELECT DISTINCT P . * , (
    SELECT IFNULL( SUM( cantidad_bs ) , 0 ) 
    FROM Gastos
    WHERE id_direccion = P.id_direccion
    AND partida = P.partida
    )gasto_bs, (

    SELECT IFNULL( SUM( cantidad_usd ) , 0 ) 
    FROM Gastos
    WHERE id_direccion = P.id_direccion
    AND partida = P.partida
    )gasto_usd, (

    SELECT IFNULL( SUM( cantidad_eur ) , 0 ) 
    FROM Gastos
    WHERE id_direccion = P.id_direccion
    AND partida = P.partida
    )gasto_eur
    FROM Presupuesto P
    LEFT JOIN Gastos G ON ( P.id_direccion = G.id_direccion
    AND P.Partida = G.Partida ) 
    WHERE P.id_direccion = $id_direccion";
    //print $query2;
		$result2 = mysql_query($query2);
		while($row2 = mysql_fetch_array($result2)) {
			$partida = $row2["partida"];
			$cantidad_bs = $row2["cantidad_bs"];
			$cantidad_usd = $row2["cantidad_usd"];
			$cantidad_eur = $row2["cantidad_eur"];
      $gasto_bs = $row2["gasto_bs"];
      $gasto_usd = $row2["gasto_usd"];
      $gasto_eur = $row2["gasto_eur"];
      $percent_bs = round((($cantidad_bs - $gasto_bs) * 100) / $cantidad_bs, 2);
      $percent_usd = round((($cantidad_usd - $gasto_usd) * 100) / $cantidad_usd, 2);
      $percent_eur = round((($cantidad_eur - $gasto_eur) * 100) / $cantidad_eur, 2);
      if (!empty($partida)) {
			  print"
				<div class='bs-callout bs-callout-default' id='progress_group' data-parent='collapse$id_direccion'>
				<h4>
				$partida
				</h4>
				
					Bolivares (Bs)
					<div class='progress' id='progress_parent' data-parent='collapse$id_direccion'>
					<div class='progress-bar progress-bar-success progress-bar-striped' role='progressbar' aria-valuenow='$percent_bs' aria-valuemin='0' aria-valuemax='100' style='width: $percent_bs%' id='progress_child' data-parent='collapse$id_direccion'>
					<b>$percent_bs%</b> (<b>$gasto_bs</b> gastados  de  <b>$cantidad_bs</b> presupuestados)
					<span class='sr-only'>
					$percent_bs% Restante
					</span>
					</div id='progress_child'>
					</div id='progress_parent'>
				
					Dolares ($)
					<div class='progress' id='progress_parent' data-parent='collapse$id_direccion'>
					<div class='progress-bar progress-bar-info progress-bar-striped' role='progressbar' aria-valuenow='$percent_usd' aria-valuemin='0' aria-valuemax='100' style='width: $percent_usd%' id='progress_child' data-parent='collapse$id_direccion'>
					<b>$percent_usd%</b> (<b>$gasto_usd</b> gastados  de  <b>$cantidad_usd</b> presupuestados)
					<span class='sr-only'>
					$percent_usd% Restante
					</span>
					</div id='progress_child'>
					</div id='progress_parent'>
				
					Euros (€)
					<div class='progress' id='progress_parent' data-parent='collapse$id_direccion'>
					<div class='progress-bar progress-bar-warning progress-bar-striped' role='progressbar' aria-valuenow='$percent_eur' aria-valuemin='0' aria-valuemax='100' style='width: $percent_eur%' id='progress_child' data-parent='collapse$id_direccion'>
					<b>$percent_eur%</b> (<b>$gasto_eur</b> gastados  de  <b>$cantidad_eur</b> presupuestados)
					<span class='sr-only'>
					$percent_eur% Restante
					</span>
					</div id='progress_child'>
					</div id='progress_parent'>
				</div id='progress_group'>";
      }
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
  </body>
</html>

