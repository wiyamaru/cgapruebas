<?php
	//print_r($_POST);

	require('seguridad.php');

	/*
	if ($_SESSION["id_rol"]!="1")
	{
		header("Location: acceso_denegado.php");
		exit();	
	}
	*/

	if(session_id() == '') 
	{
		session_start();
	}
	
	if (isset($_POST['submit']))
	{
		$num_doc_empleado=$_POST["num_doc_empleado"];
		
		include('conexion.php');

		$consulta = "select num_doc_empleado from empleado where num_doc_empleado='$num_doc_empleado'";
		$resultado = mysqli_query($conexion, $consulta);

		if (mysqli_num_rows($resultado)=='1')	
		{
			$linea=mysqli_fetch_array($resultado);

			$_SESSION["mensaje_error"]="El documento " .$num_doc_empleado. " ya se encuentra registrado.";
			$_SESSION["enviar_formulario"]=true;
			enviar_formulario();
			header("Location: ./registro_empleado.php");
			exit();
		}
		else
		{
			$fec_exp_doc_empleado=$_POST["fec_exp_doc_empleado"];
			$fec_nac_empleado=$_POST["fec_nac_empleado"];
			$fec_actual=date("Y-m-d");

			if ($fec_exp_doc_empleado >= $fec_actual)
			{
				$_SESSION["mensaje_error"]="La fecha de expedición del documento de identidad no puede ser superior a la fecha actual.";
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./registro_empleado.php");
				exit();
			}
			else
			{
				if ($fec_nac_empleado >= $fec_actual)
				{
					$_SESSION["mensaje_error"]="La fecha de nacimiento del empleado no puede ser superior a la fecha actual.";
					$_SESSION["enviar_formulario"]=true;
					enviar_formulario();
					header("Location: ./registro_empleado.php");
					exit();
				}
				else
				{
					if ($fec_exp_doc_empleado <= $fec_nac_empleado)
					{
						$_SESSION["mensaje_error"]="La fecha de expedición del documento de identidad no puede ser inferior a la fecha de nacimiento del empleado.";
						$_SESSION["enviar_formulario"]=true;
						enviar_formulario();
						header("Location: ./registro_empleado.php");
						exit();
					}
					else
					{
						$cel_empleado=$_POST["cel_empleado"];
						$cel_empleado_ant=$_POST["cel_empleado_ant"];

						if (trim($cel_empleado)==trim($cel_empleado_ant) or trim($cel_empleado)=='')
						{
							registrar_empleado();
						}
						else
						{
							$consulta_empleado="select cel_empleado from empleado where cel_empleado='$cel_empleado'";
							$resultado_empleado=mysqli_query($conexion,$consulta_empleado);

							if (mysqli_num_rows($resultado_empleado)>='1')
							{
								$_SESSION["mensaje_error"]="El celular " .$cel_empleado. " ya se encuentra registrado, intente nuevamente.";
								$_SESSION["enviar_formulario"]=true;
								enviar_formulario();
								header("Location: ./registro_empleado.php");
								exit();
							}
							else
							{
								registrar_empleado();
							}
						}						
					}
				}
			}
		}
	}	
	else
	{
		$_SESSION["mensaje_error"]="Error al acceder al recurso.";
		$_SESSION["enviar_formulario"]=false;
		header("Location: ./registro_empleado.php");
		exit();
	}

	function registrar_empleado()
	{
		global $mensaje_error_cargue_archivo,$resultado_cargue_archivo,$ruta_cargue_archivo_final,$num_doc_empleado;
		include 'subir_archivo.php';
		
		if($resultado_cargue_archivo!=true)
		{
			$_SESSION["mensaje_error"]=$mensaje_error_cargue_archivo;
			$_SESSION["enviar_formulario"]=true;
			enviar_formulario();
			header("Location: ./registro_empleado.php");
			exit();
		}
		else
		{
			global $id_tipo_documento,$num_doc_empleado,$fec_exp_doc_empleado,$id_ciudad,$fec_nac_empleado,$pri_nom_empleado,$seg_nom_empleado,$pri_ape_empleado,$seg_ape_empleado,$id_grupo_sanguineo,$dir_empleado,$cel_empleado,$fec_actual,$ruta_cargue_archivo_final;

			$id_tipo_documento=$_POST["id_tipo_documento"];
			$num_doc_empleado=trim($_POST["num_doc_empleado"]);
			$fec_exp_doc_empleado=$_POST["fec_exp_doc_empleado"];
			$id_ciudad=$_POST["id_ciudad"];
			$fec_nac_empleado=$_POST["fec_nac_empleado"];	
			$pri_nom_empleado=trim(ucfirst(strtolower($_POST["pri_nom_empleado"])));
			$seg_nom_empleado=trim(ucfirst(strtolower($_POST["seg_nom_empleado"])));
			$pri_ape_empleado=trim(ucfirst(strtolower($_POST["pri_ape_empleado"])));
			$seg_ape_empleado=trim(ucfirst(strtolower($_POST["seg_ape_empleado"])));
			$id_grupo_sanguineo=$_POST["id_grupo_sanguineo"];
			$dir_empleado=strtoupper($_POST["dir_empleado"]);
			$cel_empleado=trim($_POST["cel_empleado"]);

			include('conexion.php');
			include 'fecha_actual.php';

			$query = "insert into empleado (id_tipo_documento,num_doc_empleado,fec_exp_doc_empleado,id_ciudad,fec_nac_empleado,pri_nom_empleado,seg_nom_empleado,pri_ape_empleado,seg_ape_empleado,id_grupo_sanguineo,dir_empleado,cel_empleado,fec_cre_empleado,ruta_cargue_archivo) values ('$id_tipo_documento','$num_doc_empleado','$fec_exp_doc_empleado','$id_ciudad','$fec_nac_empleado','$pri_nom_empleado','$seg_nom_empleado','$pri_ape_empleado','$seg_ape_empleado','$id_grupo_sanguineo','$dir_empleado','$cel_empleado','$fec_actual','$ruta_cargue_archivo_final')";

			/*echo $query;*/
			$result=mysqli_query($conexion,$query);

			if($result==1)
			{
				$_SESSION["mensaje_exitoso"]="El empleado de documento " .$num_doc_empleado. " se ha registrado correctamente.";
				$_SESSION["enviar_formulario"]=false;
				header("Location: ./registro_empleado.php");
				exit();
			}
			else
			{	
				$_SESSION["mensaje_error"]="El empleado de documento " .$num_doc_empleado. " no se ha registrado, intente nuevamente.";
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./registro_empleado.php");
				exit();
			}
		}
	}

	function enviar_formulario()
	{
		$_SESSION["id_tipo_documento"]=$_POST["id_tipo_documento"];
		$_SESSION["num_doc_empleado"]=$_POST["num_doc_empleado"];
		$_SESSION["num_doc_empleado_ant"]=$_POST["num_doc_empleado_ant"];
		$_SESSION["fec_exp_doc_empleado"]=$_POST["fec_exp_doc_empleado"];
		$_SESSION["id_departamento"]=$_POST["id_departamento"];
		$_SESSION["id_ciudad"]=$_POST["id_ciudad"];
		$_SESSION["fec_nac_empleado"]=$_POST["fec_nac_empleado"];	
		$_SESSION["pri_nom_empleado"]=$_POST["pri_nom_empleado"];
		$_SESSION["seg_nom_empleado"]=$_POST["seg_nom_empleado"];
		$_SESSION["pri_ape_empleado"]=$_POST["pri_ape_empleado"];
		$_SESSION["seg_ape_empleado"]=$_POST["seg_ape_empleado"];
		$_SESSION["id_grupo_sanguineo"]=$_POST["id_grupo_sanguineo"];
		$_SESSION["dir_empleado"]=$_POST["dir_empleado"];
		$_SESSION["cel_empleado"]=$_POST["cel_empleado"];
		$_SESSION["cel_empleado_ant"]=$_POST["cel_empleado_ant"];
	}

	mysqli_close($conexion);
?>