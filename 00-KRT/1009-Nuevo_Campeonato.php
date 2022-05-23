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
		<h1>Alta de nuevo Campeonato</h1>
		<div id="Core">	
			<form action="1010-CrearCalendario.php" name="NuevoCampeonato" method="POST">
					<fieldset id="Pictures"><legend for="Pictures">Datos del Campeonato</legend>
						<label for="Camp">Año:</label>
						<input type="text" name="Camp" id="Camp" required></input>
						<label for="Calendario">Nº de GPs:</label>
						<input type="text" name="Calendario" id="Calendario" required></input>
						<input type="submit" value="Siguiente"></input>
					</fieldset>
				</form>
		</div>
		<a href="1001-WebManager.php">Volver</a>
	</body>
</html>