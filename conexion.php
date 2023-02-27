<?php
	$Host = 'mysql.hostinger.co';
	$Username = 'u587619498_cgapruebas';
	$Password = 'Marce1022@';
	$dbName = 'u587619498_cgapruebas';

	//Crear conexion mysql
	$conexion = new mysqli($Host, $Username, $Password, $dbName);
	$acentos = $conexion->query("SET NAMES 'utf8'");

	//revisar conexion
	if($conexion->connect_error)
	{
		//$_SESSION["iniciar_sesion"]="2";
		$_SESSION["mensaje_error"]="No fue posible realizar la conexión a la base de datos.";
		header("Location: ./");
		exit();
	}
	return $conexion;
?>