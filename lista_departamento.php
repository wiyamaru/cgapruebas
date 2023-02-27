<?php 
	include('conexion.php');
	$consulta = "select id_departamento,ds_departamento from departamento where op_estado_departamento='1' order by ds_departamento";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_departamento;
			if (trim($id_departamento)==true)
			{
				if ($row[0]==$id_departamento)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option><?php
	}
	mysqli_close($conexion);
?>