<?php 	
	/* iniciar la sesión */
	if(session_id() == '') 
	{
    	session_start();
	}
    
	if ($_SESSION["autenticado"]==true) 
	{
		// Establecer tiempo de vida de la sesión en segundos
		$inactividad = 10000;
		// Comprobar si $_SESSION["timeout"] está establecida
		if (isset($_SESSION["timeout"]))
		{
			// Calcular el tiempo de vida de la sesión (TTL = Time To Live)
			$sessionTTL = time() - $_SESSION["timeout"];
			if ($sessionTTL > $inactividad)
			{
				$_SESSION["mensaje_error"]="Se ha cerrado sesión por inactividad.";
				$_SESSION["enviar_formulario"]=false;
				$_SESSION["autenticado"]=false;
				header("Location: cerrar_sesion.php"); 
				exit();
        	}
			else
			{
				// El siguiente key se crea cuando se inicia sesión
    			$_SESSION["timeout"] = time();
			}
    	}
		else
		{
			$_SESSION["mensaje_error"]="Error al obtener el time out.";
			$_SESSION["enviar_formulario"]=false;
			$_SESSION["autenticado"]=false;
			header("Location: cerrar_sesion.php"); 
			exit();
		}
	}
	else
	{		
		$_SESSION["mensaje_error"]="Para acceder al servicio debe estar logueado.";
		$_SESSION["enviar_formulario"]=false;
		$_SESSION["autenticado"]=false;
		header("Location: cerrar_sesion.php"); 
		exit();
	}
?>