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
		
		<link href="3011-Champ_News.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.css" rel="stylesheet" type="text/css" />
		<link href="200-Partner.css" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT | Team KRT</title>
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
			<div id="dvNorma">
				<h1 id="hTittle">Noticias</h1>
				<div id="dTable">
					<table id="tArticulos">
						<?php
							include_once '506-myDBs.php';
							$KRT= new DB_KRT();
							$conn=$KRT->setKRTConnection();
							$sql="SELECT * FROM team_news order by Fecha desc";
							if (!$resultado = $conn->query($sql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";
							}
							$HTML="";
							$MiFecha="a";
							$MiTitulo="a";
							while ($Puntero1 = $resultado->fetch_assoc()) {
								$MiFecha=date_create($Puntero1['Fecha']);
								$MiFecha=date_format($MiFecha,'d-m-Y');
								$MiTitulo=$Puntero1['Titulo'];
								$MiId=$Puntero1['id'];
								$HTML=$HTML.'<tr class="data">';
									$HTML=$HTML.'<td class="col1">'.$MiFecha.'</td>';
									$HTML=$HTML.'<td class="col2"><a href="1110-Article_Manager.php?varId='.$MiId.'&Var2=2">'.utf8_encode($MiTitulo).'</a></td>';
								$HTML=$HTML.'</tr>';							
							}
							echo $HTML;
							mysqli_close($conn);
						?>
					</table>
				</div>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>
