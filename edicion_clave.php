<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--librerias para boton de mostrar clave-->	
<script src="js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--Script para boton mostrar clave-->
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
	
	function mostrar_clave_3()
	{
		var cambio_3 = document.getElementById("clave_usuario_3");
		if(cambio_3.type == "password")
		{
			cambio_3.type = "text";
			$('.icon_3').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}
		else
		{
			cambio_3.type = "password";
			$('.icon_3').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	}
</script>	
<title>Cambiar Contraseña</title>		

<?php
	include 'favicon.php';
?>
</head>
<?php 
	require('seguridad.php');
				
	if(session_id() == '') 
	{
		session_start();
	}
	
	include 'consultar_mensajes.php';
	
	if($_SESSION["enviar_formulario"]==true)
	{
		$id_usuario=$_SESSION["id_usuario"];
		$id_empleado=$_SESSION["id_empleado"];
		$clave_usuario_1=$_SESSION["clave_usuario_1"];
		$clave_usuario_2=$_SESSION["clave_usuario_2"];
		$clave_usuario_3=$_SESSION["clave_usuario_3"];
		$_SESSION["enviar_formulario"]=false;
	}
	else
	{
		$id_usuario=$_SESSION["id_usuario_logueado"];
		$id_empleado=$_SESSION["id_empleado_logueado"];
		
		include('conexion.php');

		$consulta = "select a.id_empleado, b.id_usuario, b.clave_usuario from empleado a inner join usuario b on a.id_empleado=b.id_empleado where b.id_usuario='$id_usuario' and a.id_empleado='$id_empleado'";

		$resultado=mysqli_query($conexion,$consulta);
		if (mysqli_num_rows($resultado)!='1')
		{
			$_SESSION["mensaje_error"]="Error al consultar la información de usuario, intente nuevamente.";
			$_SESSION["enviar_formulario"]=false;
			header("Location: ./dashboard.php");
			exit();
		}
		mysqli_close($conexion);
	}
?>
<body>
	<div class="<?php include 'marco_xl.php';?>">
		<?php
			include 'header.php';
			include 'menu_dashboard.php';
		?>
		<h2 class="fw-bold text-center py-3">Cambiar Contraseña</h2>
		<div class="<?php include 'marco_xl.php';?>">
			<?php include 'mostrar_mensajes.php';?> 
			<form method="post" action="editar_clave.php" autocomplete="off">
				<div class="row">
					<div class="col-md-12 mb-3">
						<input name="id_usuario" type="hidden" class="form-control" id="id_usuario" value="<?php
							global $id_usuario;
							if (trim($id_usuario)==true)
							{
								echo trim($id_usuario);
							}?>">
						<input name="id_empleado" type="hidden" class="form-control" id="id_empleado" value="<?php
							global $id_empleado;
							if (trim($id_empleado)==true)
							{
								echo trim($id_empleado);
							}?>">
					</div>
					<div class="col-md-12 mb-3">
						<label for="clave_usuario_1" class="form-label">Contraseña Actual</label>
						<div class="input-group">
							<input name="clave_usuario_1" type="password" class="form-control" id="clave_usuario_1" placeholder="Ingrese su contraseña actual" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.]).{8,16}$" title="Al menos un carácter en mayúscula, uno en minúscula, un número y un símbolo. Mínimo 8 o máximo 16 carácteres." value="<?php
								global $clave_usuario_1;
								if (trim($clave_usuario_1)==true)
								{
									echo trim($clave_usuario_1);
								}?>">
							<button id="show_password_1" class="btn btn-primary" type="button" onclick="mostrar_clave_1()"><i class="fa fa-eye-slash icon_1"></i></button>
						</div>
					</div>
					<div class="col-md-12 mb-2">
						<label for="clave_usuario_2" class="form-label">Nueva Contraseña</label>
						<div class="input-group">
							<input name="clave_usuario_2" type="password" class="form-control" id="clave_usuario_2" placeholder="Ingrese su nueva contraseña" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.]).{8,16}$" title="Al menos un carácter en mayúscula, uno en minúscula, un número y un símbolo. Mínimo 8 o máximo 16 carácteres." value="<?php
								global $clave_usuario_2;
								if (trim($clave_usuario_2)==true)
								{
									echo trim($clave_usuario_2);
								}?>">
							<button id="show_password_2" class="btn btn-primary" type="button" onclick="mostrar_clave_2()"><i class="fa fa-eye-slash icon_2"></i></button>
						</div>
					</div>	
					<div class="col-md-12 mb-2">
						<label for="clave_usuario_3" class="form-label">Confirme nueva Contraseña</label>
						<div class="input-group">
							<input name="clave_usuario_3" type="password" class="form-control" id="clave_usuario_3" placeholder="Confirme su nueva contraseña" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.]).{8,16}$" title="Al menos un carácter en mayúscula, uno en minúscula, un número y un símbolo. Mínimo 8 o máximo 16 carácteres." value="<?php
								global $clave_usuario_3;
								if (trim($clave_usuario_3)==true)
								{
									echo trim($clave_usuario_3);
								}?>">
							<button id="show_password_3" class="btn btn-primary" type="button" onclick="mostrar_clave_3()"><i class="fa fa-eye-slash icon_3"></i></button>
						</div>
					</div>	
					<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-3">
						<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Editar">Editar</button>
						<a class="btn btn-secondary" href="./dashboard.php" role="button">Cancelar</a>
					</div>
				</div>
				<div class="modal fade" id="Editar" tabindex="-1" aria-labelledby="EditarLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header"></div>
							<div class="modal-body">¿Realmente desea cambiar contraseña?</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								<button class="btn btn-success" type="submit">Si</button> 
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="row mt-2"></div>
		</div>
		<?php
			include 'footer.php';
		?>
	</div>
</body>
</html>