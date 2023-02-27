<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="js/bootstrap.bundle.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>
<?php
	include 'favicon.php';
?>
<style>
	.box-shadow-hover:hover {
		box-shadow: 0 2px 5px 0 
		rgba(0, 0, 0, 0.5), 0 
		2px 10px 0 rgba(0, 0, 0, 1);
	}
	.pointer {
		cursor: pointer;
	}  
</style>
</head>
<?php 
	require('seguridad.php');
	
	/*if ($_SESSION["id_rol_usuario_logueado"]!='1')
	{
		header("Location: acceso_denegado.php");
		exit();	
	}*/
	
	$id_usuario_logueado=$_SESSION["id_usuario_logueado"];
	//echo $_SESSION["id_usuario_logueado"];
		
	include 'consultar_mensajes.php';
?>	
<body>
	<div class="<?php include 'marco_xl.php';?>">
		<?php
			include 'header.php';
			include 'menu_dashboard.php';
		?>
		<div class="row mt-2">
		</div>
		<?php include 'mostrar_mensajes.php';?>
		<div class="row mt-2">
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="card d-block box-shadow-hover pointercard mb-3 mt-4">
					<div class="card-body text-center">
						<h4 class="card-title text-center">Empleados</h4><br><br>
						 <a href="empleados.php" class="btn btn-primary">Ingresar</a>
			  		</div>	
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card d-block box-shadow-hover pointercard mb-3 mt-4">
					<div class="card-body text-center">
						<h4 class="card-title text-center">Nomina</h4><br><br>
						<a href="#" class="btn btn-primary">Ingresar</a>
			  		</div>	
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card d-block box-shadow-hover pointercard mb-3 mt-4">
					<div class="card-body text-center">
						<h4 class="card-title text-center">Seguridad Social</h4><br><br>
						<a href="#" class="btn btn-primary">Ingresar</a>
			  		</div>	
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card d-block box-shadow-hover pointercard mb-4 mt-2">
					<div class="card-body text-center">
						<h4 class="card-title text-center">Liquidación</h4><br><br>
						<a href="#" class="btn btn-primary">Ingresar</a>
			  		</div>	
				</div>
			</div>
		</div>
		<div class="row mt-2">
		</div>
		<?php
			include 'footer.php';
		?>
	</div>
</body>
</html>