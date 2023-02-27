<?php
	include('conexion.php');
	$consulta = "select id_entidad, ds_nombre_entidad from entidad_certificadora order by id_entidad";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_entidad;
			if (trim($id_entidad)==true)
			{
				if ($row[0]==$id_entidad)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option><?php
	}
	mysqli_close($conexion);
?>