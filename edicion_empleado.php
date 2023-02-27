<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/bootstrap.bundle.min.js"></script>
		<!--librerias css de iconos-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<title>Edición Empleado</title>
<?php
	include 'favicon.php';
?>
</head>
<?php
	require('seguridad.php');
	
	/*
	if ($_SESSION["id_rol"]!="1")
	{
		header("Location: acceso_denegado.php");
		exit();	
	} */
	
	if(session_id() == '') 
	{
		session_start();
	}
	
	include 'consultar_mensajes.php';
	
	if($_SESSION["enviar_formulario"]==true)
	{
		$id_empleado=$_SESSION["id_empleado"];
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
	else
	{
		$id_empleado=$_POST["id_empleado"];
		include('conexion.php');
		$consulta = "select a.id_empleado, a.id_tipo_documento, a.num_doc_empleado, a.fec_exp_doc_empleado, a.id_ciudad, a.fec_nac_empleado, a.pri_nom_empleado, a.seg_nom_empleado, a.pri_ape_empleado, a.seg_ape_empleado, a.id_grupo_sanguineo, a.dir_empleado, a.cel_empleado, c.id_departamento,a.ruta_cargue_archivo from empleado a inner join ciudad b on a.id_ciudad=b.id_ciudad inner join departamento c on b.id_departamento=c.id_departamento where a.id_empleado='$id_empleado'";
		$resultado=mysqli_query($conexion,$consulta);
		if (mysqli_num_rows($resultado)>='1')
		{
			$linea=mysqli_fetch_array($resultado);
			$id_empleado=$linea[0];
			$id_tipo_documento=$linea[1];
			$num_doc_empleado=$linea[2];
			$num_doc_empleado_ant=$linea[2];
			$fec_exp_doc_empleado=$linea[3];
			$id_ciudad=$linea[4];
			$fec_nac_empleado=$linea[5];	
			$pri_nom_empleado=$linea[6];
			$seg_nom_empleado=$linea[7];
			$pri_ape_empleado=$linea[8];
			$seg_ape_empleado=$linea[9];
			$id_grupo_sanguineo=$linea[10];
			$dir_empleado=$linea[11];
			$cel_empleado=$linea[12];
			$cel_empleado_ant=$linea[12];
			$id_departamento=$linea[13];
			$ruta_cargue_archivo=$linea[14];
		}
		else
		{
			$_SESSION["mensaje_error"]="Error al consultar el empleado para edición, intente nuevamente.";
			$_SESSION["enviar_formulario"]=false;
			header("Location: ./empleados.php");
			exit();
		}
		mysqli_close($conexion);
	}
?>
	
<body>
	<div class="<?php include 'marco_xl.php';?>">
		<?php
			include 'header.php';
			include 'menu_empleados.php';
		?>
		<div class="row mt-3">
		</div>		
		<h2 class="fw-bold text-center py-5">Edición Empleados</h2>
		<?php include 'mostrar_mensajes.php';?>
		<form method="post" action="editar_empleado.php" autocomplete="off">
		<div class="row">
			<input name="id_empleado" type="hidden" class="form-control" id="id_empleado" value="<?php
						global $id_empleado;
						if (trim($id_empleado)==true)
						{
							echo trim($id_empleado);
						}?>">
			<input name="num_doc_empleado_ant" type="hidden" class="form-control" id="num_doc_empleado_ant" value="<?php
						global $num_doc_empleado_ant;
						if (trim($num_doc_empleado_ant)==true)
						{
							echo trim($num_doc_empleado_ant);
						}?>">
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
			<div class="col-md-6 mb-2">
				<label for="arch_doc_empleado" class="form-label">Archivo documento de identidad</label>
				<div class="d-grid gap-2 d-flex justify-content-md-start" >
					<input class="form-control" type="file" id="arch_doc_empleado" accept=".jpg,.png,.jpeg,.gif,.pdf">
					<?php 
						if($ruta_cargue_archivo=='')
						{
							?><a class="btn btn-secondary" href="<?php echo $ruta_cargue_archivo;?>" role="button" title="Documento no disponible." target="_blank" onClick="return false"><i class="bi bi-eye"></i></a><?php
						}
						else
						{
							?><a class="btn btn-primary" href="<?php echo $ruta_cargue_archivo;?>" role="button" title="<?php echo "Ver documento ".$pri_nom_empleado;?>" target="_blank"><i class="bi bi-eye"></i></a><?php
						}
					?>
				</div>
			</div>
			<div class="col-md-6 mb-2">
				<label for="id_departamento" class="form-label">Departamento de expedición documento</label>
				<select name="id_departamento" id="id_departamento" class="form-select form-select-md" aria-label=".form-select-md id_departamento" required>
					<option value="" style="display:none;">Seleccione departamento de expedición documento</option>
					<?php include 'lista_departamento.php';?>
				</select>
			</div>
			<div class="col-md-6 mb-2">
				<label for="id_ciudad" class="form-label">Ciudad de expedición documento</label>
				<select name="id_ciudad" id="id_ciudad" class="form-select form-select-md" aria-label=".form-select-md id_ciudad" required>
					<option value="" style="display:none;">Seleccione ciudad de expedición documento</option>
					<?php include 'lista_ciudad.php';?>
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
				<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Editar">Editar</button>
				<a class="btn btn-secondary" href="./empleados.php" role="button">Cancelar</a>
			</div>
			<div class="row mt-2">
			</div>
		</div>
		<div class="modal fade" id="Editar" tabindex="-1" aria-labelledby="EditarLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
			  		<div class="modal-header">
			  		</div>
			  		<div class="modal-body">
						¿Realmente desea editar el empleado?
			  		</div>
			  		<div class="modal-footer">
						<button class="btn btn-success" type="submit" name="submit">Si</button> 
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			  		</div>
				</div>
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