<?php
	$tipo = $_POST['tipo'];
	$prioridad = $_POST['prioridad'];
	$beneficiario = $_POST['beneficiario'];
	$descripcion = $_POST['descripcion'];
	$monto = $_POST['monto'];
	$fecha = $_POST['fecha'];

	$hostname = "CMPagos.db.10955216.hostedresource.com";
	$username = "CMPagos";
	$dbname = "CMPagos";
	$password = "Sagara#87";

	mysql_connect($hostname, $username, $password) OR DIE ("Imposible conectar a la BD");
	mysql_select_db($dbname);

	$query = "INSERT INTO Presupuesto SET tipo = '$tipo', prioridad = '$prioridad', beneficiario = '$beneficiario', descripcion = '$descripcion', monto = '$monto', fecha_pago = '$fecha'";
	$result = mysql_query($query);
	//print $query;
	print $result;
?>
