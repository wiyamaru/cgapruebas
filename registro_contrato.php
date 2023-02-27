<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/bootstrap.bundle.min.js"></script>
<title>Registro Contrato</title>
<?php
	include 'favicon.php';
	require('seguridad.php');
	
	/*
	if ($_SESSION["rango_usuario"]!="1")
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
		$id_empleado=$_SESSION["id_empleado"];
		$fec_ini_contrato=$_SESSION["fec_ini_contrato"];
		$fec_afilia_ss=$_SESSION["fec_afilia_ss"];
		$fec_fin_contrato=$_SESSION["fec_fin_contrato"];
		$id_eps=$_SESSION["id_eps"];
		$id_afp=$_SESSION["id_afp"];	
		$id_cargo=$_SESSION["id_cargo"];
		$id_obra=$_SESSION["id_obra"];
			
		$_SESSION["enviar_formulario"]=false;
	}
	else
	{
		$id_empleado=$_POST["id_empleado"];	
	}
?>
</head>
<body>
	<div class="<?php include 'marco_xl.php'; ?>">
		<?php
			include 'header.php';
			include 'menu_empleados.php';
		
			
			include('conexion.php');
			$consulta = "select a.id_empleado, a.num_doc_empleado, a.pri_nom_empleado, a.seg_nom_empleado, a.pri_ape_empleado, a.seg_ape_empleado, b.ds_abre_tipo_documento from empleado a inner join tipo_documento b on a.id_tipo_documento=b.id_tipo_documento where a.id_empleado='$id_empleado'";
			$resultado = mysqli_query($conexion,$consulta);
			if (mysqli_num_rows($resultado)=='1')
			{
				$linea=mysqli_fetch_array($resultado);
				$nom_empleado=trim($linea[2])." ".trim($linea[3])." ".trim($linea[4])." ".trim($linea[5]);
				$num_doc_empleado=$linea[1];
				$ds_abre_tipo_documento=$linea[6];
			}
			else
			{
				$_SESSION["mensaje_error"]="Error al consultar los datos del empleado, intente nuevamente.";
				$_SESSION["enviar_formulario"]=false;
				header("Location: empleados.php");
				exit();
			}
			mysqli_close($conexion);
		?>
		<div class="row mt-3">
		</div>
		<h2 class="fw-bold text-center py-5">Registro Nuevo Contrato</h2>
		<?php include 'mostrar_mensajes.php'; ?>
		<h5 class="fw-bold text-star py-1"><?php echo $ds_abre_tipo_documento." ".$num_doc_empleado." - ".$nom_empleado; ?></h5>
		<form method="post" action="registrar_contrato.php" autocomplete="off">
			<div class="row">
				<div class="col-md-6 mb-2">
					<input name="id_empleado" type="hidden" class="form-control" id="id_empleado" value="<?php
							global $id_empleado;
							if (trim($id_empleado)==true)
							{
								echo trim($id_empleado);
							}?>">
					<label for="fec_ini_contrato" class="form-label">Fecha inicio contrato</label>
					<input name="fec_ini_contrato" type="date" class="form-control" id="fec_ini_contrato" placeholder="Ingrese la fecha de inicio del contrato" required value="<?php
                                global $fec_ini_contrato;
                                if (trim($fec_ini_contrato)==true)
                                {
                                    echo trim($fec_ini_contrato);
                                }?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="fec_afilia_ss" class="form-label">Fecha afiliación</label>
					<input name="fec_afilia_ss" type="date" class="form-control" id="fec_afilia_ss" placeholder="Ingrese la fecha de afiliación al SS" required value="<?php
						global $fec_afilia_ss;
						if (trim($fec_afilia_ss)==true)
						{
							echo trim($fec_afilia_ss);
						}?>">
				</div>
				<div class="col-md-6 mb-2">
					<label for="fec_fin_contrato" class="form-label">Fecha Finalización contrato</label>
					<input name="fec_fin_contrato" type="date" class="form-control" id="fec_fin_contrato" placeholder="Ingrese la fecha de finalización del contrato" value="<?php
                                global $fec_fin_contrato;
                                if (trim($fec_fin_contrato)==true)
                                {
                                    echo trim($fec_fin_contrato);
                                }?>">
				</div>		
				<div class="col-md-6 mb-2">
					<label for="id_eps" class="form-label">EPS</label>
					<select name="id_eps" id="id_eps" class="form-select form-select-md" aria-label=".form-select-md id_eps" required>
						<option value="" style="display:none;">Seleccione EPS</option>
					  	<?php include 'lista_eps.php'; ?>
					</select>
				</div>
				<div class="col-md-6 mb-2">
					<label for="id_afp" class="form-label">AFP</label>
					<select name="id_afp" id="id_afp" class="form-select form-select-md" aria-label=".form-select-md id_afp" required>
						<option value="" style="display:none;">Seleccione AFP</option>
					  	<?php include 'lista_afp.php'; ?>
					</select>
				</div>
				<div class="col-md-6 mb-2">
					<label for="id_cargo" class="form-label">Cargo</label>
					<select name="id_cargo" id="id_cargo" class="form-select form-select-md" aria-label=".form-select-md id_cargo" required>
						<option value="" style="display:none;">Seleccione Cargo</option>
					  	<?php include 'lista_cargo.php'; ?>
					</select>
				</div>
				<div class="col-md-6 mb-2">
					<label for="id_obra" class="form-label">Obra</label>
					<select name="id_obra" id="id_obra" class="form-select form-select-md" aria-label=".form-select-md id_obra" required>
						<option value="" style="display:none;">Seleccione Obra</option>
					  	<?php 
							$_SESSION["todos"]=false;
							include 'lista_obra.php'; 
						?>
					</select>
				</div>
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			  		<button class="btn btn-primary" type="submit" name="submit">Guardar</button>
			  		<a class="btn btn-secondary" href="./contratos.php" role="button">Cancelar</a>
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