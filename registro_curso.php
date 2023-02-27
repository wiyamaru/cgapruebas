<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/bootstrap.bundle.min.js"></script>
<title>Registro Curso</title>
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
		
		$fec_ejecucion=$_SESSION["fec_ejecucion"];
		$id_entidad_certifica=$_SESSION["id_entidad_certifica"];
		$cod_verifica=$_SESSION["cod_verifica"];
					
		$_SESSION["enviar_formulario"]=false;
	}
?>
</head>
<body>
	<div class="<?php include 'marco_xl.php'; ?>">
		<?php
			include 'header.php';
			include 'menu_empleados.php';
		
			$id_empleado=$_POST["id_empleado"];	
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
		<h2 class="fw-bold text-center py-5">Registro Nuevo Curso</h2>
		<?php include 'mostrar_mensajes.php'; ?>
		<h5 class="fw-bold text-star py-1"><?php echo $ds_abre_tipo_documento." ".$num_doc_empleado." - ".$nom_empleado; ?></h5>
		<form method="post" action="registrar_curso.php" autocomplete="off">
			<div class="row">
				<div class="col-md-6 mb-2">
					<input name="id_empleado" type="hidden" class="form-control" id="id_empleado" value="<?php
							global $id_empleado;
							if (trim($id_empleado)==true)
							{
								echo trim($id_empleado);
							}?>">
					<label for="fec_ejecucion" class="form-label">Fecha ejecución curso</label>
					<input name="fec_ejecucion" type="date" class="form-control" id="fec_ejecucion" placeholder="Ingrese la fecha de ejecución del curso" required value="<?php
                                global $fec_ejecucion;
                                if (trim($fec_ejecucion)==true)
                                {
                                    echo trim($fec_ejecucion);
                                }?>">
				</div>	
				<div class="col-md-6 mb-2">
					<label for="id_entidad" class="form-label">Entidad Certificadora</label>
					<select name="id_entidad" id="id_entidad" class="form-select form-select-md" aria-label=".form-select-md id_entidad" required>
						<option value="" style="display:none;">Seleccione Entidad</option>
					  	<?php include 'lista_entidad_certificadora.php'; ?>
					</select>
				</div>
				<div class="col-md-6 mb-2">
					<label for="cod_verifica" class="form-label">Código de Verificación</label>
					<input name="cod_verifica" type="text" class="form-control" id="cod_verifica" placeholder="Ingrese código de verificación" required value="<?php
						global $cod_verifica;
						if (trim($cod_verifica)==true)
						{
							echo trim($cod_verifica);
						}?>">
				</div>
				<div class="col-md-6 mb-3" >
					<label for="arch_curso" class="form-label">Archivo curso</label>
  					<input class="form-control" type="file" id="arch_curso" accept=".jpg,.png,.jpeg,.gif,.pdf" required>	
				</div>	
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			  		<button class="btn btn-primary" type="submit">Guardar</button>
			  		<a class="btn btn-secondary" href="./cursos.php" role="button">Cancelar</a>
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