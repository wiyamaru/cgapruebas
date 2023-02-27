<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.bundle.min.js"></script>
	
<!--libreria para captcha-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	
<title>Consulta de Usuario</title>
	<?php
		include 'favicon.php';
	
		if(session_id() == '') 
		{
			session_start();
		}

		include 'consultar_mensajes.php';

		if($_SESSION["enviar_formulario"]==true)
		{
			$id_tipo_documento=$_SESSION["id_tipo_documento"];
			$num_doc_empleado=$_SESSION["num_doc_empleado"];
			$fec_exp_doc_empleado=$_SESSION["fec_exp_doc_empleado"];
			$_SESSION["enviar_formulario"]=false;
		}
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
			<h2 class="fw-bold text-center py-5">Consulta de Usuario</h2>
			<?php include 'mostrar_mensajes.php'; ?>
			<p class="text-center">Introduce tus datos para consultar usuario:</p>
			<form id="consultar_usuario" name="consultar_usuario" method="post" action="consultar_usuario.php" autocomplete="off">
					<div class="mb-4">
						<label for="id_tipo_documento" class="form-label">Tipo de documento</label>
						<select name="id_tipo_documento" id="id_tipo_documento" class="form-select form-select-md" aria-label=".form-select-md id_tipo_documento" required autofocus>
							<option value="" style="display:none;">Seleccione tipo de documento</option>
							<?php include 'lista_tipo_documento.php'; ?>
						</select>
					</div>
					<div class="mb-4">
						<label for="num_doc_empleado" class="form-label">Documento de identidad</label>
						<input name="num_doc_empleado" type="number" class="form-control" id="num_doc_empleado" placeholder="Ingrese número de documento de identidad" required value="<?php
									global $num_doc_empleado;
									if (trim($num_doc_empleado)==true)
									{
										echo trim($num_doc_empleado);
									}?>">
					</div>
					<div class="mb-4">
						<label for="fec_exp_doc_empleado" class="form-label">Fecha de expedición documento</label>
						<input name="fec_exp_doc_empleado" type="date" class="form-control" id="fec_exp_doc_empleado" placeholder="Ingrese la fecha de expedición del documento" required value="<?php
									global $fec_exp_doc_empleado;
									if (trim($fec_exp_doc_empleado)==true)
									{
										echo trim($fec_exp_doc_empleado);
									}?>">
					</div>
					<div class="mb-4 g-recaptcha" data-sitekey ="6Lc0ulgiAAAAADflTR9hwXVk5IL50uye_-HF2Bch">
					</div>
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
						<button class="btn btn-primary" type="submit" name="submit">Consultar</button>
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