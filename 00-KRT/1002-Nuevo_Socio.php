<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 1.0" />
		
		<title>Web Master</title>
	</head>
	<body>
		<h1>Alta de nuevo socio</h1>
		<div id="Core">	
			<form action="1003-GuardarSocio.php" name="NuevoSocio" method="POST">
					<fieldset id="Pictures"><legend for="Pictures">Datos de Socio</legend>
						<label for="id">Nº Socio:</label>
						<input type="text" name="id" id="id" required></input>
						<label for="Nombre">Nombre:</label>
						<input type="text" name="Nombre" id="Nombre" required></input>
						<label  class="myLabel" for="Apellido1">Apellido 1</label>
						<input type="text" name="Apellido1" id="Apellido1" required></input>
						<label  class="myLabel" for="Apellido2">Apellido 2</label>
						<input type="text" name="Apellido2" id="Apellido2"></input>
						<input type="submit" value="Actualizar"></input>
					</fieldset>
				</form>
		</div>
		<a href="1001-WebManager.php">Volver</a>
	</body>
</html>