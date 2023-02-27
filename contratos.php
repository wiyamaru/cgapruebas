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
	
<title>Contratos Empleado</title>
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
    	var table = $('#contratos').DataTable( {
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
		
		<h2 class="fw-bold text-center py-3">Contratos Empleado</h2>
		<?php include 'mostrar_mensajes.php'; ?>
		<h5 class="fw-bold text-star py-1"><?php echo $ds_abre_tipo_documento." ".$num_doc_empleado." - ".$nom_empleado; ?></h5>
		<div class="text-end py-2">
			<form method="post" action="registro_contrato.php" autocomplete="off">
				<input name="id_empleado" id="id_empleado" type="hidden" class="form-control" value="<?php echo $id_empleado;?>">
				<button class="btn btn-outline-primary" type="submit" title="<?php echo "Nuevo Contrato ".$num_doc_empleado;?>"><i class="bi bi-plus-square px-2"></i>Nuevo Contrato</button>
			</form>
		</div>
		<table id="contratos" class="table table-striped" style="width:100%">
			<thead>
				<tr>
					<th>Fecha Ingreso</th>
					<th>Fecha Retiro</th>
					<th>EPS</th>
					<th>AFP</th>
					<th>Obra</th>
					<th>Cargo</th>
					<th>Estado</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include('conexion.php');
					
					$consulta = "select a.id_contrato, a.fec_ini_contrato, a.fec_fin_contrato, b.ds_eps, c.ds_afp, d.ds_obra, e.ds_cargo from contrato a INNER JOIN eps b on a.id_eps=b.id_eps INNER JOIN afp c on a.id_afp=c.id_afp INNER JOIN obra d on a.id_obra=d.id_obra INNER JOIN cargo e on a.id_cargo=e.id_cargo INNER JOIN contrato_empleado f on a.id_contrato=f.id_contrato INNER JOIN empleado g on f.id_empleado=g.id_empleado where f.id_empleado = '$id_empleado'";
					$resultado = mysqli_query($conexion,$consulta);

					$i=0;
					while ($row = mysqli_fetch_row($resultado))
					{	
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							<td><?php
									if ($row[2]=="0000-00-00")
									{
										echo '';
									}
									else
									{
										echo $row[2];
									}
								?></td>
							<td><?php echo $row[3]; ?></td>
							<td><?php echo $row[4]; ?></td>
							<td><?php echo $row[5]; ?></td>
							<td><?php echo $row[6]; ?></td>
							<td><?php 
								if ($row[2]=="0000-00-00")
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
									<form method="post" action="edicion_contrato.php" autocomplete="off">
										<button class="btn btn-primary" type="submit" title="<?php echo "Editar contrato ".$row[5];?>"><i class="bi bi-pencil-square"></i></button>
										<input name="id_contrato" id="id_contrato" type="hidden" class="form-control" value="<?php echo $row[0];?>">
									</form>
									<form method="post" action="" autocomplete="off">
										<input name="id_contrato" id="id_contrato" type="hidden" class="form-control" value="<?php echo $row[0];?>">
										<button class="btn btn-primary" type="submit" name="submit" title="<?php echo "Ver contrato";?>"><i class="bi bi-filetype-pdf"></i></button>
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