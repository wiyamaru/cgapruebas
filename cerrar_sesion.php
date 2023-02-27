<?php
	if(session_id() == '') 
	{
		session_start();
	}
	
	if($_SESSION["autenticado"]==true)
	{
		$_SESSION["autenticado"]=false;
		$_SESSION["mensaje_exitoso"]="Sesión cerrada correctamente.";	
		header("Location: ./");
		exit;
	}
	else
	{
		$_SESSION["autenticado"]==false;
		header("Location: ./");
		exit;	
	}
?>