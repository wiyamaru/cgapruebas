<?php 
	include('conexion.php');
	$consulta = "select id_grupo_sanguineo, ds_grupo_sanguineo from grupo_sanguineo where op_estado_grupo_sanguineo='1' order by ds_grupo_sanguineo";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_grupo_sanguineo;
			if (trim($id_grupo_sanguineo)==true)
			{
				if ($row[0]==$id_grupo_sanguineo)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option><?php
	}
	mysqli_close($conexion);
?>