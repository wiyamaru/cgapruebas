<?php
	include('conexion.php');
	$consulta = "select id_eps, cod_eps, ds_eps from eps where op_estado_eps='1' order by cod_eps";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_eps;
			if (trim($id_eps)==true)
			{
				if ($row[0]==$id_eps)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[2];?></option><?php
	}
	mysqli_close($conexion);
?>