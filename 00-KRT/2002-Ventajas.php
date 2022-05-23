<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 0" />
		
		<script type="text/javascript" src="001-KRT_General.JS"></script>
		
		<link href="2002-Ventajas.CSS" rel="stylesheet" type="text/css" />
		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT | Hazte socio</title>
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
			<div id="Texto">
				<h1 id="SociosTittle">Hazte socio</h1>
				<h3 class="Tout">Ser socio de KRT es muy sencillo, sólo debes ponerte al día con los pagos</h3>
				<ul class="myDocs">
					<li>Realizar el pago de inscripción (10 euros)</li>
					<li>Realizar el pago de cuota anual (15 euros)</li>
				</ul>
				<h3 class="Tout">Tras esto, debes enviar un email a CDKRTMotorsport@gmail.com con los siguientes datos</h3>
				<ul class="myDocs">
					<li>Nombre y apellidos</li>
					<li>DNI</li>
					<li>Justificante de pago de inscripcion</li>
					<li>Justificante de pago de cuota</li>
				</ul>
				<h3 class="Tout">Si eres menor de edad, además deberás adjuntar</h3>
					<ul class="myDocs">
					<li>Autorización firmada por padre, madre o tutor legal</li>
					<li>fotocopia del DNI del autorizante</li>
				</ul>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>