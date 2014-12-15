<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
} elseif ($_SESSION['admin'] == 0) {
  header("Location: insertar.php");
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
	<link href="css/footable.core.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="js/footable.js" type="text/javascript"></script>
</head> 
<body>

	<!-- Container -->
	<div class="container">

	    <?php 
	      $active="aprobar";
	      include "navbar.php";
	    ?>

	    <!-- Jumbotron -->
	    <div class="jumbotron">

			<!-- Tabla Ppal -->
			<legend>Aprobar o Rechazar Pagos</legend>
			<div class="demo-container">	
				<div class="tab-content">
					<div class="tab-pane active" id="demo">
						<table class="table demo table-bordered" data-filter="#filter" data-page-size="5" data-page-previous-text="prev" data-page-next-text="next">
							<thead>
								<tr>
									<th data-toggle="true">
										#
									</th>
									<th data-hide="phone,tablet">
										Tipo
									</th>
									<th data-hide="phone,tablet">
										Pri
									</th>
									<th>
										Beneficiario
									</th>
									<th data-hide="phone">
										Descripcion
									</th>
									<th data-hide="phone">
										Fecha
									</th>
									<th>
										Monto
									</th>
									<th data-hide="phone,tablet">
										Aprob
									</th>
								</tr>
							</thead>
							<tbody>

							  	<?php
									function find_range($n, $ranges) {
									    foreach($ranges as $key => $range)
									        if($n >= $range[0] && $n <= $range[1])
									            return $key;
									    return false;
									}
									$vals = array(
									    'default'   => array(0, 1000),
									    'info'  => array(1001, 10000),
									    'primary'   => array(10001, 30000),
									    'warning'  => array(30001, 100000),
									    'danger' => array(100001, 9000000)
									);
						            $hostname = "CMPagos.db.10955216.hostedresource.com";
						            $username = "CMPagos";
						            $dbname = "CMPagos";
						            $password = "Sagara#87";
						        
						            mysql_connect($hostname, $username, $password) OR DIE ("Imposible conectar a la BD");
						            mysql_select_db($dbname);

						            $query = "SELECT * FROM Pagos WHERE Aprobado = 0";
						            $result = mysql_query($query);

						            if ($result) {
						                while($row = mysql_fetch_array($result)) {
						                    $id = $row["id"];
						                    $tipo = $row["Tipo"];
						                    $prioridad = $row["Prioridad"];
						                    $descripcion = utf8_encode($row["Descripcion"]);
						                    $monto = $row["Monto"];
						                    $beneficiario = $row["Beneficiario"];
						                    $fecha = $row["fecha_pago"];
											$imp = find_range($monto, $vals);

						                    print "<tr class='hover'>
												<td> $id </td>
												<td> $tipo </td>
												<td> $prioridad </td>
												<td><a target='_blank' href='http://google.com/#q=$beneficiario'> $beneficiario </a></td>
												<td> $descripcion </td>
												<td> $fecha </td>
												<td data-value='78025368997'><span class='label label-$imp'>$monto</span></td>
												<td data-value='1'><label><input type='checkbox' name='$id' id='$id' /></label></td>
											</tr>";
						                }
						            }
					            ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> <!-- /. Tabla Ppal -->

			<!-- Botones -->
			<div align="center">
		        <button id="Aprobar" name="guardar" class="btn btn-success">Aprobar</button>
		        <button id="Rechazar" name="cancelar" class="btn btn-danger">Rechazar</button>
			</div> <!-- /. Botones -->

	    </div> <!-- /. Jumbotron -->	

      <footer>
        <p>© Castillomax 2014</p>
      </footer>
      
	</div> <!-- /. Container -->

	<script type="text/javascript">
	    $(function () {
			$('table').footable();
	    });
	</script>

	<script type="text/javascript">
		var selected = [];
		function ObtenerSeleccionados() {
			$('#demo input:checked').each(function() {
			    selected.push($(this).attr('name'));
			});
			console.log(selected);
		}
		function EnviarDatos(oper) {
			$.ajax({
		  		type: "POST",
		  		url: "aprobarA.php",
		  		data: { id:selected, oper:oper },
		  		success : function(data) {
					location.reload();
				}
			})

		}
		$("#Aprobar").click(function() {
			ObtenerSeleccionados();
	    	EnviarDatos(1);
	    	selected = [];
		});
	  	$("#Rechazar").click(function() {
			ObtenerSeleccionados();
	    	EnviarDatos(2);
	    	selected = [];
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('.demo tr').click(function(event) {
		        if (event.target.type !== 'checkbox') {
		            $(':checkbox', this).trigger('click');
		        }
		    });
		});
	</script>

</body>
</html>   