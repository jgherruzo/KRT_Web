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
		<h1>Gestión de socios</h1>
		<div id="Core">	
			<table>
					<?php
						include_once '506-myDBs.php';
						$KRT= new DB_KRT();
							
						$conn=$KRT->setKRTConnection();
						// Esto extrae la tabla entera //
						$sql="SELECT * FROM users";
						if (!$resultado = $conn->query($sql)) {
							echo "Lo sentimos, este sitio web está experimentando problemas.";

							// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
							// cómo obtener información del error
							echo "Error: La ejecución de la consulta falló debido a: \n";
							echo "Query: " . $sql . "\n";
							echo "Errno: " . $conn->errno . "\n";
							echo "Error: " . $conn->error . "\n";

						}
						
						while ($Socio= mysqli_fetch_array ($resultado)){
								echo "<tr>";
								$miVariable=$Socio['DriverKey'];
								echo "<td>".utf8_encode($Socio['Nombre'])." ".utf8_encode($Socio['Apellido'])."</td>";
								echo "<td>".$Socio['Email']."</td>";
								echo '<td><a href="1007-Link_Socio.php?Key='.$miVariable.'">Enlazar</a></td>';
								echo "</tr>";
						}
						mysqli_close($conn);	
					?>
			</table>
		</div>
		<a href="1001-WebManager.php">Volver</a>
	</body>
</html>