<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<!--librerias para boton de mostrar clave-->	
<script src="js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		

<script type="text/javascript">
	function mostrar_clave_1()
	{
		var cambio_1 = document.getElementById("clave_usuario_1");
		if(cambio_1.type == "password")
		{
			cambio_1.type = "text";
			$('.icon_1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}
		else
		{
			cambio_1.type = "password";
			$('.icon_1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	}
	function mostrar_clave_2()
	{
		var cambio_2 = document.getElementById("clave_usuario_2");
		if(cambio_2.type == "password")
		{
			cambio_2.type = "text";
			$('.icon_2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}
		else
		{
			cambio_2.type = "password";
			$('.icon_2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	}
</script>	
<title>Registro usuario</title>
<?php
	include 'favicon.php';
	
	if(session_id() == '') 
	{
		session_start();
	}
	
	include 'consultar_mensajes.php';
	
	if($_SESSION["enviar_formulario"]==true)
	{
		$id_empleado=$_SESSION["id_empleado"];
		$ds_tipo_documento=$_SESSION["ds_tipo_documento"];
		$num_doc_empleado=$_SESSION["num_doc_empleado"];
		$pri_nom_empleado=$_SESSION["pri_nom_empleado"];
		$seg_nom_empleado=$_SESSION["seg_nom_empleado"];
		$pri_ape_empleado=$_SESSION["pri_ape_empleado"];
		$seg_ape_empleado=$_SESSION["seg_ape_empleado"];
		$dir_empleado=$_SESSION["dir_empleado"];
		$cel_empleado=$_SESSION["cel_empleado"];
		$cel_empleado_ant=$_SESSION["cel_empleado_ant"];
		$email_usuario_1=$_SESSION["email_usuario_1"];
		$email_usuario_2=$_SESSION["email_usuario_2"];
		$clave_usuario_1=$_SESSION["clave_usuario_1"];
		$clave_usuario_2=$_SESSION["clave_usuario_2"];
		
		$_SESSION["enviar_formulario"]=false;
	}
	else
	{
		if (isset($_SESSION["id_empleado"]))
		{
			$id_empleado=$_SESSION["id_empleado"];
			include('conexion.php');
			$consulta = "select a.id_empleado, b.ds_tipo_documento, a.num_doc_empleado, a.pri_nom_empleado, a.seg_nom_empleado, a.pri_ape_empleado, a.seg_ape_empleado, a.dir_empleado, a.cel_empleado from empleado a inner join tipo_documento b on a.id_tipo_documento=b.id_tipo_documento where a.id_empleado='$id_empleado'";
			$resultado=mysqli_query($conexion,$consulta);
			if (mysqli_num_rows($resultado)>='1')
			{
				$linea=mysqli_fetch_array($resultado);
				$id_empleado=$linea[0];
				$ds_tipo_documento=$linea[1];
				$num_doc_empleado=$linea[2];
				$pri_nom_empleado=$linea[3];
				$seg_nom_empleado=$linea[4];
				$pri_ape_empleado=$linea[5];
				$seg_ape_empleado=$linea[6];
				$dir_empleado=$linea[7];
				$cel_empleado=$linea[8];
				$cel_empleado_ant=$linea[8];
			}
			else
			{
				$_SESSION["mensaje_error"]="Error al consultar el empleado para registro de usuario, intente nuevamente.";
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./consulta_usuario.php");
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
		mysqli_close($conexion);
	}
?>
</head>
<body>
	<div class="<?php include 'marco_xl.php';?>">
		<?php include 'header.php'; ?>
		<div class="row mt-3">
		</div>
		<h2 class="fw-bold text-center py-5">Registro de usuario</h2>
		<?php include 'mostrar_mensajes.php'; ?>
		<form id="registro_usuario" name="registro_usuario" method="post" action="registrar_usuario.php" autocomplete="off">
			<div class="row">	
				<div class="col-md-6 mb-2">
					<!--campo oculto-->
					<input name="id_empleado" type="hidden" class="form-control" id="id_empleado" value="<?php
							global $id_empleado;
							if (trim($id_empleado)==true)
							{
								echo trim($id_empleado);
							}?>">
					<!--campos formulario-->
					<label for="ds_tipo_documento" class="form-label">Tipo de documento</label>
					<input name="ds_tipo_documento" type="text" class="form-control" id="ds_tipo_documento" placeholder="Ingrese tipo de documento de identidad" required readonly value="<?php
						global $ds_tipo_documento;
						if (trim($ds_tipo_documento)==true)
						{
							echo trim($ds_tipo_documento);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="num_doc_empleado" class="form-label">Documento de identidad</label>
					<input name="num_doc_empleado" type="number" class="form-control" id="num_doc_empleado" placeholder="Ingrese número de documento de identidad" required readonly value="<?php
                                global $num_doc_empleado;
                                if (trim($num_doc_empleado)==true)
                                {
                                    echo trim($num_doc_empleado);
                                }?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="pri_nom_empleado" class="form-label">Primer Nombre</label>
					<input name="pri_nom_empleado" type="text" class="form-control" id="pri_nom_empleado" placeholder="Ingrese primer nombre" required readonly value="<?php
						global $pri_nom_empleado;
						if (trim($pri_nom_empleado)==true)
						{
							echo trim($pri_nom_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="seg_nom_empleado" class="form-label">Segundo Nombre</label>
					<input name="seg_nom_empleado" type="text" class="form-control" id="seg_nom_empleado" placeholder="Ingrese segundo nombre" readonly value="<?php
						global $seg_nom_empleado;
						if (trim($seg_nom_empleado)==true)
						{
							echo trim($seg_nom_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="pri_ape_empleado" class="form-label">Primer Apellido</label>
					<input name="pri_ape_empleado" type="text" class="form-control" id="pri_ape_empleado" placeholder="Ingrese primer apellido" readonly required value="<?php
						global $pri_ape_empleado;
						if (trim($pri_ape_empleado)==true)
						{
							echo trim($pri_ape_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="seg_ape_empleado" class="form-label">Segundo Apellido</label>
					<input name="seg_ape_empleado" type="text" class="form-control" id="seg_ape_empleado" placeholder="Ingrese segundo apellido" readonly value="<?php
						global $seg_ape_empleado;
						if (trim($seg_ape_empleado)==true)
						{
							echo trim($seg_ape_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="dir_empleado" class="form-label">Dirección</label>
					<input name="dir_empleado" id="dir_empleado" type="text" class="form-control" placeholder="Ingrese dirección" value="<?php
						global $dir_empleado;
						if (trim($dir_empleado)==true)
						{
							echo trim($dir_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="cel_empleado" class="form-label">Celular</label>
					<input name="cel_empleado" type="number" class="form-control" id="cel_empleado" placeholder="Ingrese celular" value="<?php
						global $cel_empleado;
						if (trim($cel_empleado)==true)
						{
							echo trim($cel_empleado);
						}?>">
						<input name="cel_empleado_ant" type="hidden" class="form-control" id="cel_empleado_ant" value="<?php
							global $cel_empleado_ant;
							if (trim($cel_empleado_ant)==true)
							{
								echo trim($cel_empleado_ant);
							}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="email_usuario_1" class="form-label">Correo electrónico</label>
					<input name="email_usuario_1" type="email" class="form-control" id="email_usuario_1" placeholder="Ingrese su correo electrónico" required value="<?php
						global $email_usuario_1;
						if (trim($email_usuario_1)==true)
						{
							echo trim($email_usuario_1);
						}?>">
				</div>
			<div class="col-md-6 mb-3">
					<label for="email_usuario_2" class="form-label">Confirme su Correo electrónico</label>
					<input name="email_usuario_2" type="email" class="form-control" id="email_usuario_2" placeholder="Ingrese su correo electrónico" required value="<?php
						global $email_usuario_2;
						if (trim($email_usuario_2)==true)
						{
							echo trim($email_usuario_2);
						}?>">
				</div>
				<div class="col-md-6 mb-3">
					<label for="clave_usuario_1" class="form-label">Contraseña</label>
					<div class="input-group">
						<input name="clave_usuario_1" type="password" class="form-control" id="clave_usuario_1" placeholder="Ingrese su contraseña" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.]).{8,16}$" title="Al menos un carácter en mayúscula, uno en minúscula, un número y un símbolo. Mínimo 8 o máximo 16 carácteres." value="<?php
							global $clave_usuario_1;
							if (trim($clave_usuario_1)==true)
							{
								echo trim($clave_usuario_1);
							}?>">
						<button id="show_password_1" class="btn btn-primary" type="button" onclick="mostrar_clave_1()"><i class="fa fa-eye-slash icon_1"></i></button>
					</div>
				</div>
			<div class="col-md-6 mb-2">
				<label for="clave_usuario_2" class="form-label">Confirme su Contraseña</label>
				<div class="input-group">
					<input name="clave_usuario_2" type="password" class="form-control" id="clave_usuario_2" placeholder="Ingrese su contraseña" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.]).{8,16}$" title="Al menos un carácter en mayúscula, uno en minúscula, un número y un símbolo. Mínimo 8 o máximo 16 carácteres." value="<?php
						global $clave_usuario_2;
						if (trim($clave_usuario_2)==true)
						{
							echo trim($clave_usuario_2);
						}?>">
					<button id="show_password_2" class="btn btn-primary" type="button" onclick="mostrar_clave_2()"><i class="fa fa-eye-slash icon_2"></i></button>
				</div>
			</div>
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			  		<button class="btn btn-primary" type="submit" name="submit">Guardar</button>
			  		<a class="btn btn-secondary" href="./" role="button">Cancelar</a>
				</div>
				<div class="row mt-2">
				</div>
			</div>
		</form>
		<?php
			include 'footer.php';
		?>
	</div>		
</body>
</html>