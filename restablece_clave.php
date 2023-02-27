<!doctype html>
<html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Restablecer Clave</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/bootstrap.bundle.min.js"></script>
	
	<!--libreria para captcha-->
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<?php
		include 'favicon.php';
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
			<h2 class="fw-bold text-center py-5">Restablecer Clave</h2>
			<?php include 'mostrar_mensajes.php'; ?>
			<p class="text-center">Introduce tu direccion de correo electrónico de autenticación:</p>
			<form id="restablecer_clave" name="login" method="post" action="restablecer_clave.php" autocomplete="off">
				<div class="mb-4">
					<label for="email" class="form-label">Correo electrónico</label>
					<input type="email" class="form-control" id="email" name="email" autofocus required>
				</div>
				<div class="mb-4 g-recaptcha" data-sitekey ="6Lc0ulgiAAAAADflTR9hwXVk5IL50uye_-HF2Bch">
				</div>
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			  		<button class="btn btn-primary" type="submit" >Enviar</button>
			  		<a class="btn btn-secondary" href="./" role="button">Cancelar</a>
				</div>
			</form>
		</div>
		<?php
			include 'footer.php';
		?>
	</div>	
</body>
</html>