<?php
	if(session_id() == '') 
	{
		session_start();
	}

	if (isset($_POST['submit']))
	{
		$id_empleado=$_POST["id_empleado"];
		$email_usuario_1=trim($_POST["email_usuario_1"]);
		$email_usuario_2=trim($_POST["email_usuario_2"]);
		$clave_usuario_1=trim($_POST["clave_usuario_1"]);
		$clave_usuario_2=trim($_POST["clave_usuario_2"]);
		$dir_empleado=$_POST["dir_empleado"];
		$cel_empleado=trim($_POST["cel_empleado"]);
		$cel_empleado_ant=trim($_POST["cel_empleado_ant"]);

		if ($email_usuario_1==$email_usuario_2)
		{
			if ($clave_usuario_1==$clave_usuario_2)
			{			
				include('conexion.php');

				$consulta="select email_usuario from usuario where email_usuario='$email_usuario_1'";
				$result0=mysqli_query($conexion,$consulta);

				if (mysqli_num_rows($result0)>='1')
				{
					$_SESSION["mensaje_error"]="El email " .$email_usuario_1. " ya se ha registrado, intente nuevamente.";
					$_SESSION["enviar_formulario"]=true;
					enviar_formulario();
					header("Location: ./registro_usuario.php");
					exit();
				}
				else
				{	
					if (trim($cel_empleado)==trim($cel_empleado_ant) or trim($cel_empleado)=='')
					{
						registrar_usuario();
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
							header("Location: ./registro_usuario.php");
							exit();
						}
						else
						{
							registrar_usuario();
						}
					}
				}
			}
			else
			{
				$_SESSION["mensaje_error"]="Las contraseñas ingresadas no coinciden, intente nuevamente.";
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./registro_usuario.php");
				exit();	
			}
		}
		else
		{
			$_SESSION["mensaje_error"]="Los correos electrónicos ingresados no coinciden, intente nuevamente.";
			$_SESSION["enviar_formulario"]=true;
			enviar_formulario();
			header("Location: ./registro_usuario.php");
			exit();
		}		
	}
	else
	{
		$_SESSION["mensaje_error"]="Error al acceder al recurso.";
		$_SESSION["enviar_formulario"]=false;
		$_SESSION["id_empleado"]="";
		header("Location: ./");
		exit();
	}
	
	function registrar_usuario()
	{
		global $clave_usuario_1,$email_usuario_1,$id_empleado,$fec_actual;
		$clave_usuario_final=sha1(md5($clave_usuario_1));
					
		include 'fecha_actual.php';
		include('conexion.php');
		
		$query1 = "insert into usuario (email_usuario,clave_usuario,id_empleado,id_rol,fec_cre_usuario) values ('$email_usuario_1','$clave_usuario_final','$id_empleado','2','$fec_actual')";

		$result1=mysqli_query($conexion,$query1);

		if($result1==1)
		{
			global $dir_empleado,$cel_empleado;
			$query2="update empleado set dir_empleado='$dir_empleado',cel_empleado='$cel_empleado',fec_act_empleado='$fec_actual' where id_empleado='$id_empleado'";

			$result2 = mysqli_query($conexion,$query2);

			if($result2==1)
			{
				$_SESSION["mensaje_exitoso"]="El usuario " .$email_usuario_1. " se ha registrado correctamente. Ya puede inciar sesión.";
				$_SESSION["enviar_formulario"]=false;
				$_SESSION["id_empleado"]="";
				header("Location: ./");
				exit();
			}
			else
			{
				$_SESSION["mensaje_exitoso"]="El usuario " .$email_usuario_1. " se ha registrado correctamente, pero no se actualizaron sus datos. Ya puede inciar sesión.";
				$_SESSION["enviar_formulario"]=false;
				$_SESSION["id_empleado"]="";
				header("Location: ./");
				exit();
			}
		}
		else
		{	
			$_SESSION["mensaje_error"]="El usuario " .$email_usuario_1. " no se ha registrado, intente nuevamente.";
			$_SESSION["enviar_formulario"]=true;
			enviar_formulario();
			header("Location: ./registro_usuario.php");
			exit();
		}
	}
		
	function enviar_formulario()
	{
		$_SESSION["id_empleado"]=$_POST["id_empleado"];
		$_SESSION["ds_tipo_documento"]=$_POST["ds_tipo_documento"];
		$_SESSION["num_doc_empleado"]=$_POST["num_doc_empleado"];	
		$_SESSION["pri_nom_empleado"]=$_POST["pri_nom_empleado"];
		$_SESSION["seg_nom_empleado"]=$_POST["seg_nom_empleado"];
		$_SESSION["pri_ape_empleado"]=$_POST["pri_ape_empleado"];
		$_SESSION["seg_ape_empleado"]=$_POST["seg_ape_empleado"];
		$_SESSION["dir_empleado"]=$_POST["dir_empleado"];
		$_SESSION["cel_empleado"]=$_POST["cel_empleado"];
		$_SESSION["cel_empleado_ant"]=$_POST["cel_empleado_ant"];
		$_SESSION["email_usuario_1"]=$_POST["email_usuario_1"];
		$_SESSION["email_usuario_2"]=$_POST["email_usuario_2"];
		$_SESSION["clave_usuario_1"]=$_POST["clave_usuario_1"];
		$_SESSION["clave_usuario_2"]=$_POST["clave_usuario_2"];		
	}

	mysqli_close($conexion);
?>