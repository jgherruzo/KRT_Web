<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 1.0" />
		
		<script type="text/javascript" src="001-KRT_General.js"></script>
		<script type="text/javascript" src="003-General_JGH_1.js"></script>
		
		<link href="1000-Index-Page.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT Motorsport</title>
	</head>
	<body onload="iniciar()">
		<script>BackGroundPicture()</script>
		<div id="myHeader">
			<div id="Login">
			<?php
			
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
				session_start();
				
				if(isset($_SESSION['usr'])){					
					$connKRT=mysqli_connect('localhost','root','','krt_users');
					$mystrKRT="SELECT * FROM users WHERE Email = '".$_SESSION['usr']."'";
					$query=mysqli_query($connKRT,$mystrKRT);
					while ($KRTUser= mysqli_fetch_array ($query)){
											
						$_SESSION['DriverKey']=$KRTUser['DriverKey'];
						$_SESSION['Nombre']=$KRTUser['Nombre'];
						$_SESSION['Apellido']=$KRTUser['Apellido'];

					}
					mysqli_close($connKRT);
					
					
					if ($_SESSION['usr']=="krtchampionship@gmail.com"){
						echo '<a href="1001-WebManager.php">Web Master</a>';
					}else{
						echo '<a href="1150-Profile.php">Perfil de piloto</a>';
					}
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
			<div id="News">
				<h1 id="NewsTittle">KRT news</h1>
						<?php
							include_once '506-myDBs.php';
							$KRT= new DB_KRT();
							$conn=$KRT->setKRTConnection();
							$sql="SELECT * FROM camp_news order by Fecha desc";
							if (!$resultado = $conn->query($sql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";
							}
							$HTML='<h2 id="hList">KRT RKS</h2><ul id="uList">';
							$MiFecha="a";
							$MiTitulo="a";
							$MiCount=0;
							while ($Puntero1 = $resultado->fetch_assoc()) {
								if ($MiCount<5){
									$MiFecha=date_create($Puntero1['Fecha']);
									$MiFecha=date_format($MiFecha,'d-m-Y');
									$MiTitulo=$Puntero1['Titulo'];
									$MiId=$Puntero1['id'];
										$HTML=$HTML.'<li><a href="1110-Article_Manager.php?varId='.$MiId.'&Var2=2">'.utf8_encode($MiTitulo).'</a></li>';
									$MiCount=$MiCount+1;									
								}									
							}
							$HTML=$HTML.'</ul>';
							$sql="SELECT * FROM team_news order by Fecha desc";
							if (!$resultado = $conn->query($sql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";
							}
							$HTML=$HTML.'<h2 id="hList">Team KRT</h2><ul id="uList">';
							$MiCount=0;
							while ($Puntero1 = $resultado->fetch_assoc()) {
								if ($MiCount<5){
									$MiFecha=date_create($Puntero1['Fecha']);
									$MiFecha=date_format($MiFecha,'d-m-Y');
									$MiTitulo=$Puntero1['Titulo'];
									$MiId=$Puntero1['id'];
										$HTML=$HTML.'<li><a href="1110-Article_Manager.php?varId='.$MiId.'&Var2=2">'.utf8_encode($MiTitulo).'</a></li>';
									$MiCount=$MiCount+1;									
								}									
							}
							$HTML=$HTML.'</ul>';
							echo $HTML;
							mysqli_close($conn);
						?>
			</div>
			<div id="Texto">
				<p><em>Bienvenido a la comunidad de referencia </br>para el karting amateur</br> en el sur de España</em></p>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>