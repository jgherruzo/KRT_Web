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
		
		<link href="2000-Club_Index.CSS" rel="stylesheet" type="text/css" />
		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT | C.D. KRT Motorsport</title>
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
			<h1>Club Deportivo KRT Motorsport</h1>
			<div id="Icon">
				<img src= "9997-KRT_Icon.jpg">
			</div>
			<div id="Texto">
				<p>La marca KRT se crea originalmente en 2010 como un campeonato de karts de alquiler entre amigos.
				El campeonato prosigue con la misma idea hasta 2015, año en el que empiezan a aparecer las primeras resistencias 
				organizadas por Karting Sevilla y parte de los integrantes de este campeonato se unen
				para correr juntos. En 2017, tras correr las primeras 24 horas Hispalenses, surge la idea 
				de crear un equipo de forma oficial.</br></br> En 2018 se funda el Club Deportivo KRT Motorsport
				con el objetivo de promocionar el deporte del motor y el karting en especial.</br></br>
				Si te gusta la velocidad, no lo dudes, esta es tu familia</p>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>