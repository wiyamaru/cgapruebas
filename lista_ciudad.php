<?php
	if (isset($_REQUEST['id_departamento']))
	{
		$id_departamento=$_REQUEST['id_departamento'];
	}

	include("conexion.php");
	$consulta="select id_ciudad,ds_ciudad from ciudad where id_departamento = '$id_departamento' and op_estado_ciudad='1' order by ds_ciudad";
	echo '<option value="" style="display:none;">Seleccione ciudad de expedición documento</option>';
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = mysqli_fetch_row($resultado))
	{
		?> <option 
		<?php 
			global $id_ciudad;
			if (trim($id_ciudad)==true)
			{
				if ($row[0]==$id_ciudad)
				{
					?> selected <?php	
				}
			}
		?>
		value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option><?php
	}
	mysqli_close($conexion);
?>