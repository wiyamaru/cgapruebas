<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--librerias css de iconos-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="js/bootstrap.bundle.min.js"></script>
	
<title>Registrar Empleado</title>
<?php
	include 'favicon.php';
	require('seguridad.php');
	
	/*
	if ($_SESSION["id_rol"]!="1")
	{
		header("Location: acceso_denegado.php");
		exit();	
	}
	*/
	
	if(session_id() == '') 
	{
		session_start();
	}
	
	include 'consultar_mensajes.php';
	
	if($_SESSION["enviar_formulario"]==true)
	{
		$id_tipo_documento=$_SESSION["id_tipo_documento"];
		$num_doc_empleado=$_SESSION["num_doc_empleado"];
		$num_doc_empleado_ant=$_SESSION["num_doc_empleado_ant"];
		$fec_exp_doc_empleado=$_SESSION["fec_exp_doc_empleado"];
		$id_departamento=$_SESSION["id_departamento"];
		$id_ciudad=$_SESSION["id_ciudad"];
		$fec_nac_empleado=$_SESSION["fec_nac_empleado"];	
		$pri_nom_empleado=$_SESSION["pri_nom_empleado"];
		$seg_nom_empleado=$_SESSION["seg_nom_empleado"];
		$pri_ape_empleado=$_SESSION["pri_ape_empleado"];
		$seg_ape_empleado=$_SESSION["seg_ape_empleado"];
		$id_grupo_sanguineo=$_SESSION["id_grupo_sanguineo"];
		$dir_empleado=$_SESSION["dir_empleado"];
		$cel_empleado=$_SESSION["cel_empleado"];
		$cel_empleado_ant=$_SESSION["cel_empleado_ant"];
		
		$_SESSION["enviar_formulario"]=false;
	}
?>	
</head>
<body>
	<div class="<?php include 'marco_xl.php';?>">
		<?php
			include 'header.php';
			include 'menu_empleados.php';
		?>
		<div class="row mt-3">
		</div>		
		<h2 class="fw-bold text-center py-5">Registro de Empleados</h2>
		<?php include 'mostrar_mensajes.php'; ?>
		<form method="post" action="registrar_empleado.php" autocomplete="off" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 mb-2">
					<label for="id_tipo_documento" class="form-label">Tipo de documento</label>
					<select name="id_tipo_documento" id="id_tipo_documento" class="form-select form-select-md" aria-label=".form-select-md id_tipo_documento" required autofocus>
						<option value="" style="display:none;">Seleccione tipo de documento</option>
					  	<?php include 'lista_tipo_documento.php'; ?>
					</select>
				</div>
				<div class="col-md-6 mb-2">
					<label for="num_doc_empleado" class="form-label">Documento de identidad</label>
					<input name="num_doc_empleado" type="number" class="form-control" id="num_doc_empleado" placeholder="Ingrese número de documento de identidad" required value="<?php
                                global $num_doc_empleado;
                                if (trim($num_doc_empleado)==true)
                                {
                                    echo trim($num_doc_empleado);
                                }?>">
				</div>		
				<div class="col-md-6 mb-2">
					<label for="fec_exp_doc_empleado" class="form-label">Fecha de expedición documento</label>
					<input name="fec_exp_doc_empleado" type="date" class="form-control" id="fec_exp_doc_empleado" placeholder="Ingrese la fecha de expedición del documento" required value="<?php
                                global $fec_exp_doc_empleado;
                                if (trim($fec_exp_doc_empleado)==true)
                                {
                                    echo trim($fec_exp_doc_empleado);
                                }?>">
				</div>
				<div class="col-md-6 mb-2" >
					<label for="arch_doc_empleado" class="form-label">Archivo documento de identidad</label>
  					<input class="form-control" type="file" id="archivo_cargue" name="archivo_cargue" accept=".jpg,.png,.jpeg,.gif,.pdf" enctype="multipart/form-data" required>	
				</div>	
				<div class="col-md-6 mb-2">
					<label for="id_departamento" class="form-label">Departamento de expedición documento</label>
					<select name="id_departamento" id="id_departamento" class="form-select form-select-md" aria-label=".form-select-md id_departamento" required>
						<option value="" style="display:none;">Seleccione departamento de expedición documento</option>
					  	<?php include 'lista_departamento.php'; ?>
					</select>
				</div>
				<div class="col-md-6 mb-2">
					<label for="id_ciudad" class="form-label">Ciudad de expedición documento</label>
					<select name="id_ciudad" id="id_ciudad" class="form-select form-select-md" aria-label=".form-select-md id_ciudad" required>
						<option value="" style="display:none;">Seleccione ciudad de expedición documento</option>
					  	<?php include 'lista_ciudad.php'; ?>
					</select>
				</div>
				<div class="col-md-6 mb-2">
					<label for="fec_nac_empleado" class="form-label">Fecha de Nacimiento</label>
					<input name="fec_nac_empleado" type="date" class="form-control" id="fec_nac_empleado" placeholder="Ingrese fecha de nacimiento" required value="<?php
						global $fec_nac_empleado;
						if (trim($fec_nac_empleado)==true)
						{
							echo trim($fec_nac_empleado);
						}?>">
				</div>
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
					<input name="seg_nom_empleado" type="text" class="form-control" id="seg_nom_empleado" placeholder="Ingrese segundo nombre" value="<?php
						global $seg_nom_empleado;
						if (trim($seg_nom_empleado)==true)
						{
							echo trim($seg_nom_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="pri_ape_empleado" class="form-label">Primer Apellido</label>
					<input name="pri_ape_empleado" type="text" class="form-control" id="pri_ape_empleado" placeholder="Ingrese primer apellido" required value="<?php
						global $pri_ape_empleado;
						if (trim($pri_ape_empleado)==true)
						{
							echo trim($pri_ape_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="seg_ape_empleado" class="form-label">Segundo Apellido</label>
					<input name="seg_ape_empleado" type="text" class="form-control" id="seg_ape_empleado" placeholder="Ingrese segundo apellido" value="<?php
						global $seg_ape_empleado;
						if (trim($seg_ape_empleado)==true)
						{
							echo trim($seg_ape_empleado);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="id_grupo_sanguineo" class="form-label">Grupo Sanguíneo</label>
					<select name="id_grupo_sanguineo" id="id_grupo_sanguineo" class="form-select form-select-md" aria-label=".form-select-md id_grupo_sanguineo" required>
						<option value="" style="display:none;">Seleccione grupo sanguíneo</option>
					  	<?php include 'lista_grupo_sanguineo.php'; ?>
					</select>
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
				
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			  		<button class="btn btn-primary" type="submit" name="submit">Guardar</button>
			  		<a class="btn btn-secondary" href="./empleados.php" role="button">Cancelar</a>
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
<!--Libreria y script para listas combinadas -->
<script src = "js/jquery-3.1.1.js"></script>
<script type = "text/javascript">
	$(document).ready(function()
	{
		$('#id_departamento').on('change', function()
		{
			if($('#id_departamento').val() == "")
			{
				$('#id_ciudad').empty();
				$('<option value="" style="display:none;">Seleccione ciudad de expedición documento</option>').appendTo('#id_ciudad');
				$('#id_ciudad').attr('disabled', 'disabled');
			}
			else
			{
				$('#id_ciudad').removeAttr('disabled', 'disabled');
				$('#id_ciudad').load('lista_ciudad.php?id_departamento=' + $('#id_departamento').val());
			}
		});
	});
</script>	
</html>