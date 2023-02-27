<?php
	include('conexion.php');
	$consulta = "select id_tipo_documento, ds_tipo_documento from tipo_documento where op_estado_tipo_documento='1' order by id_tipo_documento";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_tipo_documento;
			if (trim($id_tipo_documento)==true)
			{
				if ($row[0]==$id_tipo_documento)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option><?php
	}
	mysqli_close($conexion);
?>