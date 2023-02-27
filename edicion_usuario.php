<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--librerias para boton de mostrar clave-->	
<script src="js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
<title>Actualizar datos usuario</title>
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
		$pri_nom_empleado=$_SESSION["pri_nom_empleado"];
		$seg_nom_empleado=$_SESSION["seg_nom_empleado"];
		$pri_ape_empleado=$_SESSION["pri_ape_empleado"];
		$seg_ape_empleado=$_SESSION["seg_ape_empleado"];
		$dir_empleado=$_SESSION["dir_empleado"];
		$cel_empleado=$_SESSION["cel_empleado"];
		$cel_empleado_ant=$_SESSION["cel_empleado_ant"];
		$email_usuario=$_SESSION["email_usuario"];
		$email_usuario_ant=$_SESSION["email_usuario_ant"];
		
		$_SESSION["enviar_formulario"]=false;
	}
	else
	{
		$id_usuario=$_SESSION["id_usuario_logueado"];
		$id_empleado=$_SESSION["id_empleado_logueado"];
		include('conexion.php');
		
		$consulta = "select a.id_empleado, a.pri_nom_empleado, a.seg_nom_empleado, a.pri_ape_empleado, a.seg_ape_empleado, a.dir_empleado, a.cel_empleado, b.id_usuario, b.email_usuario from empleado a inner join usuario b on a.id_empleado=b.id_empleado where b.id_usuario='$id_usuario' and a.id_empleado='$id_empleado'";
		
		$resultado=mysqli_query($conexion,$consulta);
		if (mysqli_num_rows($resultado)>='1')
		{
			$linea=mysqli_fetch_array($resultado);	
			$pri_nom_empleado=$linea[1];
			$seg_nom_empleado=$linea[2];
			$pri_ape_empleado=$linea[3];
			$seg_ape_empleado=$linea[4];
			$dir_empleado=$linea[5];
			$cel_empleado=$linea[6];
			$cel_empleado_ant=$linea[6];
			$email_usuario=$linea[8];
			$email_usuario_ant=$linea[8];
		}
		else
		{
			$_SESSION["mensaje_error"]="Error al consultar el usuario para edición, intente nuevamente.";
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
		<div class="row mt-3">
		</div>		
		<h2 class="fw-bold text-center py-5">Actualizar datos usuario</h2>
		<?php include 'mostrar_mensajes.php'?>
		<form method="post" action="editar_usuario.php" autocomplete="off">
			<div class="row">
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
		<div class="col-md-6 mb-2">
					<label for="pri_nom_empleado" class="form-label">Primer Nombre</label>
					<input name="pri_nom_empleado" type="text" class="form-control" id="pri_nom_empleado" placeholder="Ingrese primer nombre" required value="<?php
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
					<input name="pri_ape_empleado" type="text" class="form-control" id="pri_ape_empleado" placeholder="Ingrese primer apellido" required readonly value="<?php
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
				<div class="col-md-6 mb-3">
					<label for="dir_empleado" class="form-label">Dirección</label>
					<input name="dir_empleado" id="dir_empleado" type="text" class="form-control" placeholder="Ingrese dirección" value="<?php
						global $dir_empleado;
						if (trim($dir_empleado)==true)
						{
							echo trim($dir_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-3">
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
					<label for="email_usuario" class="form-label">Correo electrónico</label>
					<input name="email_usuario" type="email" class="form-control" id="email_usuario" placeholder="Ingrese su correo electrónico" required value="<?php
						global $email_usuario;
						if (trim($email_usuario)==true)
						{
							echo trim($email_usuario);
						}?>">
					<input name="email_usuario_ant" type="hidden" class="form-control" id="email_usuario_ant" value="<?php
							global $email_usuario_ant;
							if (trim($email_usuario_ant)==true)
							{
								echo trim($email_usuario_ant);
							}?>">
				</div>
				<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
					<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Editar">Editar</button>
			  		<a class="btn btn-secondary" href="./dashboard.php" role="button">Cancelar</a>
				</div>
				<div class="row mt-2">
				</div>
			</div>
			<div class="modal fade" id="Editar" tabindex="-1" aria-labelledby="EditarLabel" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
				  <div class="modal-header">
				  </div>
				  <div class="modal-body">¿Realmente desea actualizar datos?</div>
				  <div class="modal-footer">
					  <button class="btn btn-success" type="submit" name="submit">Si</button> 
					 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				  </div>
				</div>
			  </div>
			</div>
		</form>
		<div class="row mt-2">
		</div>
		<?php
			include 'footer.php';
		?>
	</div>
</body>
</html>