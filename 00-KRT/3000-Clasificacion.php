<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 0" />
		
		<script type="text/javascript" src="000-jquery-3.4.1.js.js"></script>
		<script type="text/javascript" src="001-KRT_General.js"></script>
		
		<link href="3000-Clasificacion.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.css" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT Championship| Clasificacion</title>
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
		
		<div id="dvCore">
			<div id="dvClaMenu">
				<h2 class="myTittle">Menu</h2>
							<Div id="dvCamp">
								<label>Campeonato:</label>
								<select name="cboCamp" id="cboCamp">
									<option value="0">Selecciona un campeonato</option>
									<?php
										include_once '506-myDBs.php';
										$KRT= new DB_KRT();
											
										$conn=$KRT->setKRTConnection();
										// Esto extrae la tabla entera //
										$sql="SELECT * FROM campeonatos";
										if (!$resultado = $conn->query($sql)) {
											echo "Lo sentimos, este sitio web está experimentando problemas.";

											// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
											// cómo obtener información del error
											echo "Error: La ejecución de la consulta falló debido a: \n";
											echo "Query: " . $sql . "\n";
											echo "Errno: " . $conn->errno . "\n";
											echo "Error: " . $conn->error . "\n";

										}
										
										$i=1;
										while ($Doc= mysqli_fetch_array ($resultado)){

												echo '<option value="'.$Doc['Year'].'">';
												echo "".$Doc['Year']."";
												echo "</option>";
										}
												
									?>
								</select>
							</div>
							<div id="dvClasi">
								<label>Clasificación:</label>
								<select id="cboClasi" name="cboClasi">
								</select>
							</div>
			</div>
			<div id="a1">
				<div id="dvWinner">
					
				</div>
				<div id="dvContShowClasi">
					<div id="dvShowClasi" class="myScroll">				
					</div>
				</div>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
		<script src="000-jquery-3.4.1.js"></script>
		<script src="006-Clasificacion.js"></script>
	</body>
</html>
