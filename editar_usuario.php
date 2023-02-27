<?php
	require('seguridad.php');
	
	if(session_id() == '') 
	{
		session_start();
	}

	if (isset($_POST['submit']))
	{		
		validar_cel_empleado();
	}
	else
	{	
		$_SESSION["mensaje_error"]="Error al acceder al recurso.";
		$_SESSION["enviar_formulario"]=false;
		header("Location: dashboard.php");
		exit();		
	}

	function validar_cel_empleado()
	{
		$cel_empleado=$_POST["cel_empleado"];
		if (trim($cel_empleado)=='')
		{
			validar_email_usuario();
		}
		else
		{	
			$cel_empleado_ant=$_POST["cel_empleado_ant"];
			if (trim($cel_empleado)==trim($cel_empleado_ant))
			{
				validar_email_usuario();
			}
			else
			{
				include('conexion.php');
				$consulta = "select cel_empleado from empleado where cel_empleado='$cel_empleado'";
				$resultado = mysqli_query($conexion, $consulta);
				if (mysqli_num_rows($resultado)=='1')	
				{
					$linea=mysqli_fetch_array($resultado);
					$_SESSION["mensaje_error"]="El celular ingresado " .$cel_empleado. " ya se encuentra registrado.";
					$_SESSION["enviar_formulario"]=true;
					enviar_formulario();
					header("Location: ./edicion_usuario.php");
					exit();
				}
				else
				{
					validar_email_usuario();
				}
				mysqli_close($conexion);
			}
		}
	}

	function validar_email_usuario()
	{	
		$email_usuario=$_POST["email_usuario"];
		$email_usuario_ant=$_POST["email_usuario_ant"];
		if (trim($email_usuario)==trim($email_usuario_ant))
		{
			editar_usuario();
		}
		else
		{
			include('conexion.php');
			$consulta = "select email_usuario from usuario where email_usuario='$email_usuario'";
			$resultado = mysqli_query($conexion, $consulta);
			if (mysqli_num_rows($resultado)=='1')	
			{
				$linea=mysqli_fetch_array($resultado);
				$_SESSION["mensaje_error"]="El correo electrónico ingresado " .$email_usuario. " ya se encuentra registrado.";
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./edicion_usuario.php");
				exit();
			}
			else
			{
				editar_usuario();
			}
			mysqli_close($conexion);
		}
	}
	
	function editar_usuario()
	{
		formulario_query();
		
		global $pri_nom_empleado,$seg_nom_empleado,$pri_ape_empleado,$seg_ape_empleado,$dir_empleado,$cel_empleado,$email_usuario,$fec_actual,$id_empleado;
					
		include('conexion.php');
		$query="update empleado a inner join usuario b on a.id_empleado=b.id_empleado set a.pri_nom_empleado='$pri_nom_empleado',a.seg_nom_empleado='$seg_nom_empleado',a.pri_ape_empleado='$pri_ape_empleado',a.seg_ape_empleado='$seg_ape_empleado',a.dir_empleado='$dir_empleado',a.cel_empleado='$cel_empleado',a.fec_act_empleado='$fec_actual',b.email_usuario='$email_usuario',b.fec_act_usuario='$fec_actual' where a.id_empleado='$id_empleado'";
		
		//echo $query;

		$resultado = mysqli_query($conexion,$query);
		if ($resultado==0)
		{
			$_SESSION["mensaje_error"]="Error en la actualización de los datos del usuario, intente nuevamente.";
			$_SESSION["enviar_formulario"]=true;
			enviar_formulario();
			header("Location: ./edicion_usuario.php");
			exit();
		}
		else
		{	
			$_SESSION["mensaje_exitoso"]="Usuario actualizado correctamente.";
			$_SESSION["enviar_formulario"]=false;
			header("Location: ./edicion_usuario.php");
			exit();	
		}
		mysqli_close($conexion);
	}
	
	function formulario_query()
	{
		global $id_usuario;
		$id_usuario=$_POST["id_usuario"];
		global $id_empleado;
		$id_empleado=$_POST["id_empleado"];
		global $pri_nom_empleado;
		$pri_nom_empleado=$_POST["pri_nom_empleado"];
		global $seg_nom_empleado;
		$seg_nom_empleado=$_POST["seg_nom_empleado"];
		global $pri_ape_empleado;
		$pri_ape_empleado=$_POST["pri_ape_empleado"];
		global $seg_ape_empleado;
		$seg_ape_empleado=$_POST["seg_ape_empleado"];
		global $dir_empleado;
		$dir_empleado=$_POST["dir_empleado"];
		global $cel_empleado;
		$cel_empleado=$_POST["cel_empleado"];
		global $email_usuario;
		$email_usuario=$_POST["email_usuario"];
		global $fec_actual;
		include 'fecha_actual.php';
	}

	function enviar_formulario()
	{
		$_SESSION["id_usuario"]=$_POST["id_usuario"];
		$_SESSION["id_empleado"]=$_POST["id_empleado"];
		$_SESSION["pri_nom_empleado"]=$_POST["pri_nom_empleado"];
		$_SESSION["seg_nom_empleado"]=$_POST["seg_nom_empleado"];
		$_SESSION["pri_ape_empleado"]=$_POST["pri_ape_empleado"];
		$_SESSION["seg_ape_empleado"]=$_POST["seg_ape_empleado"];
		$_SESSION["dir_empleado"]=$_POST["dir_empleado"];
		$_SESSION["cel_empleado"]=$_POST["cel_empleado"];
		$_SESSION["cel_empleado_ant"]=$_POST["cel_empleado_ant"];
		$_SESSION["email_usuario"]=$_POST["email_usuario"];
		$_SESSION["email_usuario_ant"]=$_POST["email_usuario_ant"];
	}
?>