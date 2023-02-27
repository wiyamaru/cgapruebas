<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<!--librerias css de iconos-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">	
<title>Edición Contrato</title>
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
		$id_contrato=$_SESSION["id_contrato"];
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
		$id_contrato=$_POST["id_contrato"];
		include('conexion.php');
		$consulta = "select a.id_contrato, a.fec_ini_contrato, a.fec_afilia_ss, a.fec_fin_contrato, a.id_eps, a.id_afp, a.id_cargo, a.id_obra from contrato a inner join eps b on a.id_eps=b.id_eps inner join afp c on a.id_afp=c.id_afp inner join cargo d on a.id_cargo=d.id_cargo inner join obra e on a.id_obra=e.id_obra where a.id_contrato='$id_contrato'";
		$resultado=mysqli_query($conexion,$consulta);
		if (mysqli_num_rows($resultado)>='1')
		{
			$linea=mysqli_fetch_array($resultado);
			$id_contrato=$linea[0];
			$fec_ini_contrato=$linea[1];
			$fec_afilia_ss=$linea[2];
			$fec_fin_contrato=$linea[3];
			$id_eps=$linea[4];
			$id_afp=$linea[5];
			$id_cargo=$linea[6];
			$id_obra=$linea[7];	
			
		}
		else
		{
			$_SESSION["mensaje_error"]="Error al consultar el contrato para edición, intente nuevamente.";
			$_SESSION["enviar_formulario"]=false;
			header("Location: ./contratos.php");
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
		<h2 class="fw-bold text-center py-5">Edición Contratos</h2>
		<?php include 'mostrar_mensajes.php';?>
	<div class="text-end py-2">
		<form method="post" action="generar_contrato_pdf.php" autocomplete="off">
			<input name="id_contrato" id="id_contrato" type="hidden" class="form-control" value="<?php echo $id_contrato;?>">
			<button class="btn btn-outline-primary" type="submit" title="<?php echo "Generar PDF Contrato";?>"><i class="bi bi-filetype-pdf px-2"></i>Generar PDF</button>
		</form>
	</div>
	
		<form method="post" action="editar_contrato.php" autocomplete="off">
		<div class="row">
				<div class="col-md-6 mb-2">
					<input name="id_contrato" type="hidden" class="form-control" id="id_contrato" value="<?php
							global $id_contrato;
							if (trim($id_contrato)==true)
							{
								echo trim($id_contrato);
							}?>">
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
							$_SESSION["todos"]=true;
							include 'lista_obra.php'; 
						?>
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="arch_contrato" class="form-label">Subir contrato firmado</label>
					<input class="form-control" type="file" id="arch_contrato" accept=".pdf">		
				</div>	
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
					<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Editar">Editar</button>
					<a class="btn btn-secondary" href="./contratos.php" role="button">Cancelar</a>
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
				¿Realmente desea editar el contrato?
			  </div>
			  <div class="modal-footer">
				 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				 <button class="btn btn-success" type="submit">Si</button> 
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
</html>