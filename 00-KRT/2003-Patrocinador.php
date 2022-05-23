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

		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
				
		<link href="2003-Patrocinador.css" rel="stylesheet" type="text/css" />
		
		<title>KRT | Patrocinador</title>
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
			<h1 id="SociosTittle">Opciones de Patrocinio</h1>
			<div id="Texto">
				<table class="mySocios">
					<tr>
						<th>Parámetro</th>
						<th>Principal</th>
						<th>Premium</th>
						<th>Estandar</th>
						<th>Básico</th>
						<th>Colaborador</th>
					</tr>
					<?php
						include_once '506-myDBs.php';
						$KRT= new DB_KRT();
							
						$conn=$KRT->setKRTConnection();
						// Esto extrae la tabla entera //
						$sql="SELECT * FROM patrocinador";
						if (!$resultado = $conn->query($sql)) {
							echo "Lo sentimos, este sitio web está experimentando problemas.";

							// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
							// cómo obtener información del error
							echo "Error: La ejecución de la consulta falló debido a: \n";
							echo "Query: " . $sql . "\n";
							echo "Errno: " . $conn->errno . "\n";
							echo "Error: " . $conn->error . "\n";

						}
						
						while ($Pat= mysqli_fetch_array ($resultado)){
							
							echo "<tr>";
								echo "<th>".utf8_encode($Pat['Par'])."</th>";
								if($Pat['Main']=="si"){
									echo '<td><img class="tic" src="400-Check.png"></td>';
								}elseif($Pat['Main']==""){
									echo '<td><img class="tic" src="401-Check-.png"></td>';
								}else{
									echo "<td>".utf8_encode($Pat['Main'])."</td>";
								}
								if($Pat['Premium']=="si"){
									echo '<td><img class="tic" src="400-Check.png"></td>';
								}elseif($Pat['Premium']==""){
									echo '<td><img class="tic" src="401-Check-.png"></td>';
								}else{
									echo "<td>".$Pat['Premium']."</td>";
								}
								if($Pat['Standard']=="si"){
									echo '<td><img class="tic" src="400-Check.png"></td>';
								}elseif($Pat['Standard']==""){
									echo '<td><img class="tic" src="401-Check-.png"></td>';
								}else{
									echo "<td>".$Pat['Standard']."</td>";
								}
								if($Pat['Basic']=="si"){
									echo '<td><img class="tic" src="400-Check.png"></td>';
								}elseif($Pat['Basic']==""){
									echo '<td><img class="tic" src="401-Check-.png"></td>';
								}else{
									echo "<td>".$Pat['Basic']."</td>";
								}
								if($Pat['Partn']=="si"){
									echo '<td><img class="tic" src="400-Check.png"></td>';
								}elseif($Pat['Partn']==""){
									echo '<td><img class="tic" src="401-Check-.png"></td>';
								}else{
									echo "<td>".$Pat['Partn']."</td>";
								}
							echo "</tr>";
						}
								
					?>
				</table>
			</div>		
					?>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>