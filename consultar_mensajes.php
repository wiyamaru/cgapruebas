<?php
	if (isset($_SESSION["mensaje_error"]))
	{	
		$mensaje_error=$_SESSION["mensaje_error"];
		$_SESSION["mensaje_error"]="";
	}
	else
	{		
		$mensaje_error="";
	}

	if (isset($_SESSION["mensaje_exitoso"]))
	{	
		$mensaje_exitoso=$_SESSION["mensaje_exitoso"];
		$_SESSION["mensaje_exitoso"]="";
	}
	else
	{		
		$mensaje_exitoso="";
	}
?>