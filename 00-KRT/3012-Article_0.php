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
		
		<link href="3012-Article_0.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT | KRT Rental Series</title>
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
			<?php
				if(isset($_GET['VarId'])){
					
					$MiCode=$_GET['VarId'];
					include_once '506-myDBs.php';
					$KRT= new DB_KRT();
					$conn=$KRT->setKRTConnection();
					$sql="SELECT * FROM camp_news WHERE id='$MiCode'";
					if (!$resultado = $conn->query($sql)) {
						echo "Lo sentimos, este sitio web está experimentando problemas.";
					}
					while ($Puntero1 = $resultado->fetch_assoc()) {
					
					$MiTitulo=utf8_encode($Puntero1['Titulo']);
					$MiTexto=utf8_encode($Puntero1['Texto']);
					$HTML='<div id="Core">';
						$HTML=$HTML."<h1>".$MiTitulo."</h1>";
						$HTML=$HTML.'<div id="Texto">';
							$HTML=$HTML."<p>".$MiTexto."</p>";
						$HTML=$HTML."</div>";
					$HTML=$HTML."</div>";
					}
						echo $HTML;
				}else{
					header("Location:1000-Index.php");					
				}
			?>		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>