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
						$MiClave="";
						if(isset($_GET['Key'])){
							$MiClave=$_GET['Key'];
						}
						$conn=$KRT->setKRTConnection();
						// Esto extrae la tabla entera //
						$sql="SELECT * FROM socios";
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
								echo "<td>".$Socio['IdSocio']."</td>";
								$miVariable=$Socio['IdSocio'];
								echo "<td>".utf8_encode($Socio['Nombre'])." ".utf8_encode($Socio['Apellido1'])." ".utf8_encode($Socio['Apellido2'])."</td>";
								echo "<td>".$Socio['DriverKey']."</td>";
								echo '<td><a href="1008-EnlazarSocio.php?Clave='.$MiClave.'&Socio='.$miVariable.'">Elegir</a></td>';
								echo "</tr>";
						}
						mysqli_close($conn);		
					?>
			</table>
		</div>
		<a href="1001-WebManager.php">Volver</a>
	</body>
</html>