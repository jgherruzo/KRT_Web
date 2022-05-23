<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 0.1" />

		<script type="text/javascript" src="000-jquery-3.4.1.js.js"></script>
		<script type="text/javascript" src="004-LoginCheck.js"></script>
		<script type="text/javascript" src="001-KRT_General.js"></script>
		
		<link href="1100-Login.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="203-Body.CSS" rel="stylesheet" type="text/css" />
		
		<title>KRT | Login</title>
	</head>
	<body>
	<script>BackGroundPicture()</script>
		<div class="Core">
			<div class="Cuenta">
				<span>Crear Cuenta</span>
			</div>
			<div class="myLogin">
				<h2 class="myTittle">Iniciar sesión</h2>
				
				<form action="1106-LoginRegManager.php" method="POST" class="myForm" id="LoginForm" onsubmit="return ValidaLogin()">
					<?php
					
						if (isset($ErrorLogin)){
							
							echo $ErrorLogin;
						
						}
					?>
					<input type="email" placeholder="Email" name="mail" required></input>
					<input type="password" placeholder="Contraseña" name="pass" required></input>
					<input type="submit" value="Iniciar sesión"></input>					
				</form>
				
			</div>
			<div class="myLogin">
				<h2 class="myTittle">Crear Cuenta</h2>
				
				<form action="1103-Register_Manager.php" method="POST" class="myForm" id="RegisterForm" onsubmit="return ValidaRegistro()">
					<input type="text" placeholder="Nombre" name="Nombre" id="Nombre" title="No usar acentos" required></input>
					<input type="text" placeholder="Apellido/s" name="Apellido1" id="Apellido1" title="No usar acentos" required></input>
					
					<input type="email" placeholder="Email" name="Email" id="Email" required></input>
					<input type="password" placeholder="Contraseña" name="Password" id="Password" title="Contraseña con mínimo 8 caracteres, 1 letra y 1 número" required></input>
					<input type="password" placeholder="Repita Contraseña" name="Password2" id="Password2" required></input>
					<span id="PassError"></span>
					<input type="submit" value="Registrar"></input>
				</form>
				
			</div>
			<div class="reset-password">
				<a href="1101-PassModification.php">Olvidé mi contraseña</a>
			</div>
		</div>
		
		<script src="000-jquery-3.4.1.js"></script>
		<script src="002-Login.js"></script>
		<script src="004-LoginCheck.js"></script>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>