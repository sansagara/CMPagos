<?php
	$id = implode(",",$_POST['id']);
	$oper = $_POST['oper'];
	$hostname = "CMPagos.db.10955216.hostedresource.com";
	$username = "CMPagos";
	$dbname = "CMPagos";
	$password = "Sagara#87";

	mysql_connect($hostname, $username, $password) OR DIE ("Imposible conectar a la BD");
	mysql_select_db($dbname);

	$query = "UPDATE Pagos SET Aprobado = $oper WHERE id IN ($id)";
	//print $query;
	$result = mysql_query($query);
?>
