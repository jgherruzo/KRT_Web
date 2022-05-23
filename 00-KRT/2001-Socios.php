<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 0" />
		
		<script type="text/javascript" src="001-KRT_General.js"></script>
		
		<link href="2001-Socios.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT | Socios y Documentos</title>
	</head>
	<body>
		<script>BackGroundPicture()</script>
		<div id="myHeader">
			<div id="Login">
			<?php
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado			
				session_start();
				
				if(isset($_SESSION['usr'])){
					echo '<a href="1150-Profile.php">Perfil de piloto</a>';
				}
				else{
					echo '<a href="1100-Login.php">Iniciar Sesión</a>';
				}
			
			?>
			</div>
		</div>
		<Div id="Menu">
			<script>BuildMenu()</script>
		</Div>
		
		<div id="Core">
			<div id="Biblioteca">
				<h1 id="NewsTittle">Documentos</h1>
				<ul class="myDocs">
					<?php
						include_once '506-myDBs.php';
						$KRT= new DB_KRT();
							
						$conn=$KRT->setKRTConnection();
						// Esto extrae la tabla entera //
						$sql="SELECT * FROM documentos";
						if (!$resultado = $conn->query($sql)) {
							echo "Lo sentimos, este sitio web está experimentando problemas.";

							// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
							// cómo obtener información del error
							echo "Error: La ejecución de la consulta falló debido a: \n";
							echo "Query: " . $sql . "\n";
							echo "Errno: " . $conn->errno . "\n";
							echo "Error: " . $conn->error . "\n";

						}
						
						while ($Doc= mysqli_fetch_array ($resultado)){

								echo "<li>";
								//voy por aqui//
								echo "<a href='7800-Documentos/".$Doc['pdf'].".pdf'>";
								echo "".$Doc['Descriptor']."";
								echo "</a>";
								echo "</li>";
						}
								
					?>
				</ul>
			</div>
			<div id="Texto">
				<h1 id="SociosTittle">Listado de socios</h1>
				<table class="mySocios">
					<?php
						include_once '506-myDBs.php';
						$KRT= new DB_KRT();
							
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
							
							if($Socio['Estado']=="Alta"){
								echo "<tr>";
								echo "<td>".$Socio['IdSocio']."</td>";
								echo "<td>".utf8_encode($Socio['Nombre'])." ".utf8_encode($Socio['Apellido1'])." ".utf8_encode($Socio['Apellido2'])."</td>";
								echo "</tr>";
							}
						}
								
					?>
				</table>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>