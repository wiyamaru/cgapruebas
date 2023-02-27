<?php
	include('conexion.php');
	$consulta = "select id_cargo, ds_cargo from cargo where op_estado_cargo='1' order by id_cargo";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_cargo;
			if (trim($id_cargo)==true)
			{
				if ($row[0]==$id_cargo)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option><?php
	}
	mysqli_close($conexion);
?>