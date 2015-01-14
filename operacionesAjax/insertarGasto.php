<?php
	$id_direccion = $_POST['id_direccion'];
	$partida = $_POST['partida'];
	$fecha = $_POST['fecha'];
	$descripcion = $_POST['descripcion'];
	$cantidad_bs = $_POST['cantidad_bs'];
	$cantidad_usd = $_POST['cantidad_usd'];
	$cantidad_eur = $_POST['cantidad_eur'];

	$hostname = "CMPagos.db.10955216.hostedresource.com";
	$username = "CMPagos";
	$dbname = "CMPagos";
	$password = "Sagara#87";

	mysql_connect($hostname, $username, $password) OR DIE ("Imposible conectar a la BD");
	mysql_select_db($dbname);

	$query = "INSERT INTO Gastos SET id_direccion = '$id_direccion', partida = '$partida', fecha = '$fecha', descripcion = '$descripcion', cantidad_bs = '$cantidad_bs', cantidad_usd = '$cantidad_usd', cantidad_eur = '$cantidad_eur'";
	$result = mysql_query($query);
	if ($result == 1) {print $result;}
	else {print $query;}
?>
