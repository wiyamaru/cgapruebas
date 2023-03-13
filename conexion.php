<?php
	if(session_id() == '') 
	{
		session_start();
	}

	//$Host = 'mysql.hostinger.co';
	$Host = '127.0.0.1';
	
	$Username = 'u587619498_cgapruebas';
	$Password = 'Marce1022@';	
	$dbName = 'u587619498_cgapruebas';

	try{
		//Crear conexion mysql
		$conexion = new mysqli($Host, $Username, $Password, $dbName);
		//$acentos = $conexion->query("SET NAMES 'utf8'");
		
		//revisar conexion
	if($conexion->connect_error)
	{
		//$_SESSION["iniciar_sesion"]="2";
		//$_SESSION["mensaje_error"]="No fue posible realizar la conexión a la base de datos.";
		//$_SESSION["enviar_formulario"]=true;
		//header("Location: ./");
		//exit();
		throw new Exception("Error de conexión: " . $conexion->connect_error);
	}
		echo "Conexión exitosa";
		//return $conexion;
	}
	catch(Exception $e) {
  	echo $e->getMessage();
}		
	
?>