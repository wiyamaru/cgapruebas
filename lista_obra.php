<?php
	include('conexion.php');
	
	if ($_SESSION["todos"]==true)
	{
		$consulta = "select id_obra, ds_obra from obra order by id_obra";
	}
	else
	{
		if ($_SESSION["todos"]==false)
		{
			$consulta = "select id_obra, ds_obra from obra where fec_fin_obra is null order by id_obra";
		}
	}
	
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_obra;
			if (trim($id_obra)==true)
			{
				if ($row[0]==$id_obra)
				{
					?> selected <?php
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option><?php
	}
	mysqli_close($conexion);
	$_SESSION["todos"]=='';
?>