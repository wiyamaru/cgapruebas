<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/bootstrap.bundle.min.js"></script>
<title>Edición Curso</title>
<?php
	include 'favicon.php';
	require('seguridad.php');
	
	/*
	if ($_SESSION["rango_usuario"]!="1")
	{
		header("Location: acceso_denegado.php");
		exit();	
	}
	
	
	if(session_id() == '') 
	{
		session_start();
	}
	
	include 'consultar_mensajes.php';
	
	if($_SESSION["enviar_formulario"]==true)
	{
		$id_curso=$_SESSION["id_curso"];
		$id_empleado=$SESSION["id_empleado"];
		$fec_ejecucion=$_SESSION["fec_ejecucion"];
		$id_entidad_certifica=$_SESSION["id_entidad_certifica"];
		$cod_verifica=$_SESSION["cod_verifica"];
					
		$_SESSION["enviar_formulario"]=false;
	}
		else
	{
		$id_curso=$_POST["id_curso"];
		include('conexion.php');
		$consulta = "select a.id_curso, a.fec_eje_curso, a.id_entidad, a.cod_verifica_curso, from curso a inner join entidad_certificadora b on a.id_entidad=b.id_entidad where a.id_curso='$id_curso'";
		$resultado=mysqli_query($conexion,$consulta);
		if (mysqli_num_rows($resultado)>='1')
		{
			$linea=mysqli_fetch_array($resultado);
			$id_curso=$linea[0];
			$fec_ejecucion=$linea[1];
			$id_entidad_certifica=$linea[2];
			$cod_verifica=$linea[3];
			
			
		}
		else
		{
			$_SESSION["mensaje_error"]="Error al consultar el curso para edición, intente nuevamente.";
			$_SESSION["enviar_formulario"]=false;
			header("Location: ./empleados.php");
			exit();
		}
		mysqli_close($conexion);
	}*/
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
		<h2 class="fw-bold text-center py-5">Edición Cursos</h2>
		<?php include 'mostrar_mensajes.php';?>
		<form method="post" action="editar_curso.php" autocomplete="off">
		<div class="row">
			<input name="id_curso" type="hidden" class="form-control" id="id_curso" value="<?php
							global $id_curso;
							if (trim($id_curso)==true)
							{
								echo trim($id_curso);
							}?>"
			>
			<input name="id_empleado" type="hidden" class="form-control" id="id_empleado" value="<?php
						global $id_empleado;
						if (trim($id_empleado)==true)
						{
							echo trim($id_empleado);
						}?>"
			>			
			<div class="col-md-6 mb-2">
				<label for="fec_ejecucion" class="form-label">Fecha ejecución curso</label>
					<input name="fec_ejecucion" type="date" class="form-control" id="fec_ejecucion" placeholder="Ingrese la fecha de ejecución del curso" required value="<?php
                                global $fec_ejecucion;
                                if (trim($fec_ejecucion)==true)
                                {
                                    echo trim($fec_ejecucion);
                                }?>"
					>
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
				<div class="col-md-6 mb-3">
					<label for="arch_curso" class="form-label">Archivo curso</label>
					<div class="d-grid gap-2 d-flex justify-content-md-start" >
						<input class="form-control" type="file" id="arch_curso" accept=".jpg,.png,.jpeg,.gif,.pdf">
						<a class="btn btn-primary" href="" role="button" title="<?php echo "Ver PDF curso ";?>"><i class="bi bi-eye"></i></a>
					</div>
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
						¿Realmente desea editar el curso?
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
</html>