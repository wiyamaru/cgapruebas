<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.bundle.min.js"></script>
	
	<!--librerias css para la tabla-->
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css" rel="stylesheet">
	<!--librerias css de iconos-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

	<!--librerias .js para la tabla-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!--url .js para la tabla responsive-->
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
<title>Cursos Empleado</title>

<?php
		include 'favicon.php';
		require('seguridad.php');
	
		if(session_id() == '') 
		{
			session_start();
		}
		
		include 'consultar_mensajes.php';
	?>
<script>
	$(document).ready(function() {
    	var table = $('#cursos').DataTable( {
        responsive: true
    	} );
    	new $.fn.dataTable.FixedHeader( table );
	} );
</script>
</head>
<body>
<div class="<?php include 'marco_xl.php';?>">
		<?php
			include 'header.php';
			include 'menu_empleados.php';
			
			if (isset($_POST['submit']))
			{
				$id_empleado=$_POST["id_empleado"];
				$_SESSION["id_empleado"]=$_POST["id_empleado"];
			}
			else
			{
				if (isset($_SESSION["id_empleado"]))
				{
					$id_empleado=$_SESSION["id_empleado"];
				}
				else
				{
					$_SESSION["mensaje_error"]="Error al consultar los datos del empleado, intente nuevamente.";
					$_SESSION["enviar_formulario"]=false;
					header("Location: empleados.php");
					exit();	
				}
			}
		
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
	
		<h2 class="fw-bold text-center py-3">Cursos de Alturas Empleado</h2>
		<?php include 'mostrar_mensajes.php'; ?>
		<h5 class="fw-bold text-star py-1"><?php echo $ds_abre_tipo_documento." ".$num_doc_empleado." - ".$nom_empleado; ?></h5>
		<div class="text-end py-2">
			<form method="post" action="registro_curso.php" autocomplete="off">
				<input name="id_empleado" id="id_empleado" type="hidden" class="form-control" value="<?php echo $id_empleado;?>">
				<button class="btn btn-outline-primary" type="submit" title="<?php echo "Nuevo Curso ".$num_doc_empleado;?>"><i class="bi bi-plus-square px-2"></i>Nuevo Curso</button>
			</form>
		</div>
		<table id="cursos" class="table table-striped" style="width:100%">
			<thead>
				<tr>
					<th>Fecha ejecución</th>
					<th>Fecha vencimiento</th>
					<th>Entidad Certificadora</th>
					<th>Código de Verificación</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include('conexion.php');
					
					$consulta = "select a.id_curso, a.fec_eje_curso, a.cod_verifica_curso, d.ds_nombre_entidad from curso a INNER JOIN curso_empleado b on a.id_curso=b.id_curso INNER JOIN empleado c on b.id_empleado=c.id_empleado INNER JOIN entidad_certificadora d on a.id_entidad=d.id_entidad where b.id_empleado = '$id_empleado'";
					$resultado = mysqli_query($conexion,$consulta);

					$i=0;
					while ($row = mysqli_fetch_row($resultado))
					{	
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[1];?></td>
							<td><?php echo $row[3]; ?></td>
							<td><?php echo $row[2]; ?></td>		
							<td><?php 
								if ($row[2]==NULL)
								{
									echo "Activo";
								}
								else
								{
									echo "Finalizado";
								}
								?></td>
							<td>
								<div class="d-grid gap-2 d-flex justify-content-md-start">
									<form method="post" action="edicion_curso.php" autocomplete="off">
										<button class="btn btn-primary" type="submit" title="<?php echo "Editar curso ".$row[2];?>"><i class="bi bi-pencil-square"></i></button>
										<input name="id_curso" id="id_curso" type="hidden" class="form-control" value="<?php echo $row[0];?>">
									</form>
									<form method="post" action="cursos.php" autocomplete="off">
										<button class="btn btn-primary" type="submit" name="submit" title="<?php echo "Ver PDF curso ".$row[2];?>"><i class="bi bi-eye"></i></button>
										<input name="id_curso" id="id_curso" type="hidden" class="form-control" value="<?php echo $row[0];?>">
									</form>
								</div>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
    	</table>
		<?php
			include 'footer.php';
		?>
	</div>
</body>
</html>