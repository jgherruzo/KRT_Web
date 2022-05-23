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
		<script type="text/javascript" src="004-PassCheck.js"></script>
		<script type="text/javascript" src="001-KRT_General.js"></script>
		
		<link href="1101-Pass.css" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="203-Body.CSS" rel="stylesheet" type="text/css" />
		
		<title>KRT | Cambiar contraseña</title>
	</head>
	<body>
	<script>BackGroundPicture()</script>
		<div class="Core">

			<div class="myLogin">
				<h2 class="myTittle">Actualizar contraseña</h2>
				
				<form action="1109-Email_Manager.php" method="POST" class="myForm" id="PassForm">
					<?php
					
						if (isset($ErrorLogin)){
							
							echo $ErrorLogin;
						
						}
					?>
					<input type="email" placeholder="Email" name="mail" id="mail" required></input>
					<span id="PassError"></span>
					<input type="submit" value="Enviar email de validación"></input>					
				</form>
				
			</div>
		</div>
		
		<script src="000-jquery-3.4.1.js"></script>
		<script src="005-PassCheck.js"></script>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>