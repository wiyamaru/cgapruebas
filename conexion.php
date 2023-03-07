<?php
	$Host = 'mysql.hostinger.co';
	//$Host = '127.0.0.1';
	$Username = 'u587619498_cgapruebas';
	//$Username = '';
	$Password = 'Marce1022@';	
	//$Password = '';
	$dbName = 'u587619498_cgapruebas';

	//Crear conexion mysql
	$conexion = new mysqli($Host, $Username, $Password, $dbName);
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	//revisar conexion
	if($conexion->connect_error)
	{
		//$_SESSION["iniciar_sesion"]="2";
		$_SESSION["mensaje_error"]="No fue posible realizar la conexión a la base de datos.";
		$_SESSION["enviar_formulario"]=true;
		header("Location: ./");
		exit();
	}
	return $conexion;
?>