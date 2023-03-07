<?php
	if(session_id() == '') 
	{
		session_start();
	}
	
	if (isset($_POST['submit']))
	{
		$email_usuario=trim($_POST['email_usuario']);
		$clave_usuario=(trim($_POST['clave_usuario']));
		
		if(isset($_POST['g-recaptcha-response']))
		{
			$recaptcha=$_POST['g-recaptcha-response'];
			
			if (!$recaptcha)
			{
				$_SESSION["mensaje_error"]="Diligencie el captcha";	
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./");				
				exit();
			}
			else	
			{
				$secret="6Lc0ulgiAAAAAB6XnMAPyJegq4spGiFWcg08YAE6";
				$url='https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$recaptcha;
				$response=file_get_contents($url);
				$responseKeys=json_decode($response,true);	
				
				if($responseKeys['success'])
				{
					include('conexion.php');

					$consulta="select a.id_usuario,a.email_usuario,a.clave_usuario,a.id_empleado,b.pri_nom_empleado,b.seg_nom_empleado,b.pri_ape_empleado,b.seg_ape_empleado,a.id_rol,c.ds_rol from usuario a inner join empleado b on a.id_empleado=b.id_empleado inner join rol c on a.id_rol=c.id_rol where a.email_usuario='$email_usuario' and a.clave_usuario=sha1(md5('$clave_usuario'))";
					$result0=mysqli_query($conexion,$consulta);

					if (mysqli_num_rows($result0)=='1')
					{
						$linea=mysqli_fetch_array($result0);
						session_regenerate_id();
						$_SESSION["id_usuario_logueado"]=$linea[0];
						$_SESSION["id_empleado_logueado"]=$linea[3];
						$_SESSION["nom_empleado_logueado"]=trim($linea[4])." ".trim($linea[5])." ".trim($linea[6])." ".trim($linea[7]);
						$_SESSION["id_rol_usuario_logueado"]=$linea[8];
						$_SESSION["ds_rol_usuario_logueado"]=$linea[9];						
						
						$_SESSION["autenticado"]=true;
						$_SESSION["timeout"] = time();
						$_SESSION["mensaje_exitoso"]="Bienvenid@ ".$_SESSION["nom_empleado_logueado"].". Perfil ".$_SESSION["ds_rol_usuario_logueado"].".";
						$_SESSION["enviar_formulario"]=false;
						header("Location: dashboard.php");
						exit();
					}
					else
					{
						$_SESSION["mensaje_error"]="El correo electrónico o contraseña son incorrectos, intente nuevamente.";
						$_SESSION["enviar_formulario"]=true;
						enviar_formulario();
						header("Location: ./");
						exit();
					}
					mysqli_close($conexion);
				}
				else
				{
					$_SESSION["mensaje_error"]="Error en captcha";
					$_SESSION["enviar_formulario"]=true;
					enviar_formulario();
					header("Location: ./");
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
		$_SESSION["email_usuario"]=$_POST["email_usuario"];
		$_SESSION["clave_usuario"]=$_POST["clave_usuario"];		
	}
?>