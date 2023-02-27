<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.bundle.min.js"></script>
<!--librerias css de iconos-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<title>Acceso denegado</title>
	<?php
		include 'favicon.php';
		require('seguridad.php');
	?>
</head>
<body>
	<div class="<?php include 'marco_sm.php';?>">
		<div class="col bg-white p-5 rounded">
			<div class="text-end">
				<img src="img/logo.png" width="100" alt="Construcciones Gómez">
			</div>
			<h2 class="fw-bold text-center py-3">Aceso Denegado</h2>
			<p class="text-center py-3">No cuenta con permisos para acceder a esta página.</p> 
			<?php
				if($_SESSION["autenticado"]==true)
				{
					?>
						<div class="text-center py-3">
							<a class="btn btn-secondary" href="javascript: history.go(-1)">Regresar</a>
							<a class="btn btn-secondary" href="dashboard.php" role="button">Página Principal</a>
						</div>
					<?php
				}
				else
				{
					?>
						<div class="text-center py-3">
							<a class="btn btn-secondary" href="./" role="button">Página Principal</a>
						</div>
            		<?php
				}
			?>              
		</div>
		<?php
			include 'footer.php';
		?>
	</div>
</body>
</html>