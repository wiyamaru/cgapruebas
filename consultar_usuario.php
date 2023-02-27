<?php
	if(session_id() == '') 
	{
		session_start();
	}

	if (isset($_POST['submit']))
	{
		if(isset($_POST['g-recaptcha-response']))
		{
			$recaptcha=$_POST['g-recaptcha-response'];
			
			if (!$recaptcha)
			{
				$_SESSION["mensaje_error"]="Diligencie el captcha";	
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./consulta_usuario.php");				
				exit;
			}
			else	
			{
				$secret="6Lc0ulgiAAAAAB6XnMAPyJegq4spGiFWcg08YAE6";
				$url='https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$recaptcha;
				$response=file_get_contents($url);
				$responseKeys=json_decode($response,true);	
				
				if($responseKeys['success'])
				{
					$id_tipo_documento=$_POST["id_tipo_documento"];
					$num_doc_empleado=$_POST["num_doc_empleado"];
					$fec_exp_doc_empleado=$_POST["fec_exp_doc_empleado"];

					include('conexion.php');
					/*consultar datos en tabla empleado*/        
					$consulta = "select id_empleado,id_tipo_documento, num_doc_empleado,fec_exp_doc_empleado from empleado where num_doc_empleado='$num_doc_empleado' and fec_exp_doc_empleado='$fec_exp_doc_empleado' and id_tipo_documento='$id_tipo_documento'";
					$resultado = mysqli_query($conexion, $consulta);

					if (mysqli_num_rows($resultado)=='1')	
					{
						/*consultar usuario*/
						$linea=mysqli_fetch_array($resultado);
						$id_empleado=$linea[0];
						$consulta2 = "select id_empleado from usuario where id_empleado='$id_empleado'";
						$resultado2 = mysqli_query($conexion, $consulta2);

						if (mysqli_num_rows($resultado2)=='1')
						{
							$_SESSION["mensaje_exitoso"]="Ya cuenta con usuario registrado, por favor inicie sesion o utilice la opción de <a href='restablece_clave.php' class='alert-link'>Olvidaste tú contraseña.</a>";
							$_SESSION["enviar_formulario"]=false;
							header("Location: ./");
							exit();
						}
						else
						{
							$linea2=mysqli_fetch_array($resultado2);
							$_SESSION["id_empleado"]=$linea[0];
							$_SESSION["mensaje_exitoso"]="Su documento ".$num_doc_empleado." es elegible para crear usuario, por diligencie la información solicitada a continuación:";
							$_SESSION["enviar_formulario"]=false;
							header("Location: ./registro_usuario.php");
							exit();
						}
					}
					else 
					{
						$_SESSION["mensaje_error"]="Verifique la información ingresada o contacte al administrador.";
						$_SESSION["enviar_formulario"]=true;
						enviar_formulario();
						header("Location: ./consulta_usuario.php");
						exit();
					}
					mysqli_close($conexion);
				}
				else
				{
					$_SESSION["mensaje_error"]="Error en captcha";
					$_SESSION["enviar_formulario"]=true;
					enviar_formulario();
					header("Location: ./consulta_usuario.php");
					exit;	
				}
			}
		}
	}
	else
	{
		$_SESSION["mensaje_error"]="Error al acceder al recurso.";
		$_SESSION["enviar_formulario"]=false;
		header("Location: ./");
		exit();
	}
	
	function enviar_formulario()
	{
		$_SESSION["id_tipo_documento"]=$_POST["id_tipo_documento"];
		$_SESSION["num_doc_empleado"]=$_POST["num_doc_empleado"];
		$_SESSION["fec_exp_doc_empleado"]=$_POST["fec_exp_doc_empleado"];
	}
?>