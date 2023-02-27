<?php
	include('conexion.php');
	$consulta = "select id_afp, cod_afp, ds_afp from afp where op_estado_afp='1' order by cod_afp";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_afp;
			if (trim($id_afp)==true)
			{
				if ($row[0]==$id_afp)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[2];?></option><?php
	}
	mysqli_close($conexion);
?>