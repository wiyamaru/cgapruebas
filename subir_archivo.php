<?php
	$file = $_FILES["archivo_cargue"]["name"]; //Nombre de nuestro archivo
	//echo '<script>alert("'.addslashes($file).'")</script>';

	$file_type = strtolower(pathinfo($file,PATHINFO_EXTENSION)); //Extensión de nuestro archivo

	$url_temp = $_FILES["archivo_cargue"]["tmp_name"]; //Ruta temporal a donde se carga el archivo 

	//dirname(__FILE__) nos otorga la ruta absoluta hasta el archivo en ejecución
	$url_insert = dirname(__FILE__) . "/archivos/documento_identidad"; //Carpeta donde subiremos nuestros archivos

	//Ruta donde se guardara el archivo, usamos str_replace para reemplazar los "\" por "/"
	$url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

	//Si la carpeta no existe, la creamos
	if (!file_exists($url_insert)) 
	{
		mkdir($url_insert, 0777, true);
	}
	
	global $mensaje_error_cargue_archivo,$resultado_cargue_archivo,$ruta_cargue_archivo_final,$num_doc_empleado;

	//Validamos el tamaño del archivo
	$file_size = $_FILES["archivo_cargue"]["size"];
	if ($file_size > 2000000) 
	{
		$mensaje_error_cargue_archivo="El peso máximo permitido del archivo es de 2Mb.";
	  	$resultado_cargue_archivo=false;
	}
	else
	{
		//Validamos la extensión del archivo
		if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif" && $file_type != "pdf" )
		{
			$mensaje_error_cargue_archivo="Solo se permiten archivos de tipo JPG, PNG, JPEG, GIF, PDF.";
			$resultado_cargue_archivo=false;
		}
		else
		{
			//movemos el archivo de la carpeta temporal a la carpeta objetivo y verificamos si fue exitoso
			if (move_uploaded_file($url_temp, $url_target))
			{	
				if($num_doc_empleado=='')
				{
					$num_doc_empleado='test';
				}
				
				$resultado_cargue_archivo=true;
				$ruta_cargue_archivo=$url_insert."/".$num_doc_empleado.".".$file_type;
				rename($url_target,$ruta_cargue_archivo);
				$ruta_cargue_archivo_final=str_replace("/home/u587619498/domains/construccionesgomez.com.co/public_html/cga",".",$ruta_cargue_archivo);
				echo '<script>alert("'.addslashes($ruta_cargue_archivo_final).'")</script>';
			}
			else
			{
				$mensaje_error_cargue_archivo="Error al cargar el archivo, intente nuevamente.";
				$resultado_cargue_archivo=false;
			}
		}
	}

	
?>