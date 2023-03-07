<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login CGA</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>
	<!--libreria para captcha-->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
	<!--librerias para boton de mostrar clave-->	
	<script src="js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script type="text/javascript">
		function mostrar_clave()
		{
			var cambio = document.getElementById("clave_usuario");
			if(cambio.type == "password")
			{
				cambio.type = "text";
				$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
			}
			else
			{
				cambio.type = "password";
				$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
			}
		}
	</script>
	<?php
		include 'favicon.php';
	
		if(session_id() == '') 
		{
			session_start();
		}
	
		include 'consultar_mensajes.php';
	
		if (isset($_SESSION["enviar_formulario"]))
		{
			if($_SESSION["enviar_formulario"]==true)
			{
				$email_usuario=$_SESSION["email_usuario"];
				$clave_usuario=$_SESSION["clave_usuario"];
				$_SESSION["enviar_formulario"]=false;
			}
		}
		session_unset();
		session_destroy();
	?>
</head>
<style>
	@media only screen and (max-width: 500px) 
	{
		.g-recaptcha 
		{
			transform:scale(0.77);
			transform-origin:0 0;
			-webkit-transform:scale(0.77);
		}
	}
</style>	
<body>
		<div class="<?php include 'marco_sm.php'; ?>">
		<div class="col bg-white p-5 rounded">
			<div class="text-end">
				<img src="img/logo.png" width="100" alt="Construcciones Gómez">
			</div>

			<h2 class="fw-bold text-center py-5">Login</h2>
			<?php include 'mostrar_mensajes.php';?>
			<form id="login" name="login" method="post" action="validar.php" autocomplete="off">
				<div class="mb-4">
					<label for="email_usuario" class="form-label">Correo electrónico</label>
					<input type="email" class="form-control" id="email_usuario" name="email_usuario" required autofocus placeholder="Ingrese su correo electrónico" value="<?php
						global $email_usuario;
						if (trim($email_usuario)==true)
						{
							echo trim($email_usuario);
						}?>">
				</div>
				<div class="mb-4">
					<label for="clave_usuario" class="form-label">Contraseña</label>
					<div class="input-group">
						<input type="password" class="form-control" id="clave_usuario" name="clave_usuario" required placeholder="Ingrese su contraseña" value="<?php
							global $clave_usuario;
							if (trim($clave_usuario)==true)
							{
								echo trim($clave_usuario);
							}?>">
						<button id="show_password" class="btn btn-primary" type="button" onclick="mostrar_clave()"><i class="fa fa-eye-slash icon"></i></button>
					</div>
				</div>
				<!--<div class="mb-4 form-check">
					<input type="checkbox" class="form-check-input" name="connected">
					<label for="connected" class="form-check-label">Mantenerme conectado</label>
				</div>-->
				<div class="mb-4 g-recaptcha" data-sitekey ="6Lc0ulgiAAAAADflTR9hwXVk5IL50uye_-HF2Bch">
				</div>
				<div class="d-grid">
					<button type="submit" name="submit" class="btn btn-primary">Iniciar Sesión</button>
				</div>
				<div class="my-3">
					<span>¿No tienes cuenta? <a href="consulta_usuario.php">Regístrate</a></span><br>
					<span><a href="restablece_clave.php">Olvidaste tú contraseña</a></span>
				</div>
			</form>
		</div>
		<?php
			include 'footer.php';
		?>
	</div>	
</body>
</html>