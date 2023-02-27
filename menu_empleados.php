<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.bundle.min.js"></script>
<title>Menu Dashboard</title>
	</head>

<body>
	<nav class="navbar navbar-expand-md navbar-light bg-light">
			<div class="container">
				<button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			 		<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarText">
			  		<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
				  			<a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
						</li>
						<li class="nav-item">
				  			<a class="nav-link" href="registro_empleado.php">Registrar Empleado</a>
						</li>
						<li class="nav-item">
				  			<a class="nav-link" href="empleados.php">Consultar Empleados</a>
						</li>
						<li class="nav-item">
				  			<a class="nav-link" href="#">Reportes</a>
						</li>
						<li class="nav-item dropdown">
          					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            				Perfil
          					</a>
          				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            				<li><a class="dropdown-item" href="edicion_usuario.php" >Actualizar datos usuario</a></li>
							<li><a class="dropdown-item" href="edicion_clave.php" >Cambiar Contraseña</a></li>
            				<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#CerrarSesion">Cerrar Sesión</a></li>
          				</ul>
        				</li>
					</ul>
			</div>
			</div>
		</nav> 
	<div class="modal fade" id="CerrarSesion" tabindex="-1" aria-labelledby="CerrarSesionLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!--<h5 class="modal-title" id="CerrarSesionLabel"></h5>-->
       <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
      </div>
      <div class="modal-body">
        ¿Deseas cerrar sesión?
      </div>
      <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
		 <a href="cerrar_sesion.php" class="btn btn-danger"> Cerrar Sesión</a> 
      </div>
    </div>
  </div>
</div>
</body>
</html>