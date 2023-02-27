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
	
<title>Empleados Principal</title>
	<?php
		include 'favicon.php';
	
		if(session_id() == '') 
		{
			session_start();
		}
	
		require('seguridad.php');
	
		/*if ($_SESSION["id_rol_usuario_logueado"]!="1")
		{
			header("Location: acceso_denegado.php");
			exit();	
		} */

		include 'consultar_mensajes.php';
	?>
<script>
	$(document).ready(function() {
    var table = $('#empleados').DataTable( {
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
		?>
		<div class="row mt-3">
		</div>
		
		<h2 class="fw-bold text-center py-3">Consulta empleados</h2>
		<?php include 'mostrar_mensajes.php'; ?>
		<table id="empleados" class="table table-striped" style="width:100%">
			<thead>
				<tr>
					<th>No. Documento</th>
					<th>Nombre</th>
					<th>Dirección</th>
					<th>Celular</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include('conexion.php');
					$consulta = "select id_empleado, num_doc_empleado, pri_nom_empleado, seg_nom_empleado, pri_ape_empleado, seg_ape_empleado, dir_empleado, cel_empleado from empleado order by id_empleado";
					$resultado = mysqli_query($conexion,$consulta);

					$i=0;
					while ($row = mysqli_fetch_row($resultado))
					{	
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo trim($row[2]); echo " "; echo trim($row[3]); echo " "; echo trim($row[4]); echo " "; echo trim($row[5]);?></td>
							<td><?php echo $row[6]; ?></td>
							<td><?php echo $row[7]; ?></td>
							<td>
								<div class="d-grid gap-2 d-flex justify-content-md-start">
									<form method="post" action="edicion_empleado.php" autocomplete="off">
											<input name="id_empleado" id="id_empleado" type="hidden" class="form-control" value="<?php echo $row[0];?>">
											<button class="btn btn-primary" type="submit" name="submit" title="<?php echo "Editar empleado ".$row[1];?>"><i class="bi bi-pencil-square"></i></button>
									</form>
									<form method="post" action="contratos.php" autocomplete="off">
											<input name="id_empleado" id="id_empleado" type="hidden" class="form-control" value="<?php echo $row[0];?>">
											<button class="btn btn-primary" type="submit" name="submit" title="<?php echo "Contratos empleado ".$row[1];?>"><i class="bi bi-journal-check"></i></button>
									</form>
									<form method="post" action="cursos.php" autocomplete="off">
											<input name="id_empleado" id="id_empleado" type="hidden" class="form-control" value="<?php echo $row[0];?>">
											<button class="btn btn-primary" type="submit" name="submit" title="<?php echo "Cursos empleado ".$row[1];?>"><i class="bi bi-person-rolodex"></i></button>
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