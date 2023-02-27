<?php				
	global $mensaje_error;
	if (trim($mensaje_error)==true)
	{
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?php echo $mensaje_error; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php 
	}
?>
<?php				
	global $mensaje_exitoso;
	if (trim($mensaje_exitoso)==true)
	{
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php echo $mensaje_exitoso; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php 
	}
?>