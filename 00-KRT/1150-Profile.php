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
		
		<link href="1150-Profile.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT | Perfil de Piloto</title>
	</head>
	<body>
		<?php
			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
			header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
			
			if (isset($_SESSION['DriverId'])) {
			}
			else{
				session_start();
				include_once '506-myDBs.php';
				$KRT= new DB_KRT();
				
				if(isset($_SESSION['usr'])){
					$conn=$KRT->setKRTConnection();

					$sql="SELECT Id, Nombre, Apellido, DriverKey, Equipo FROM users WHERE Email = '".$_SESSION['usr']."'";
					if (!$resultado = $conn->query($sql)) {
					echo "Lo sentimos, este sitio web está experimentando problemas.";

					// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
					// cómo obtener información del error
					echo "Error: La ejecución de la consulta falló debido a: \n";
					echo "Query: " . $sql . "\n";
					echo "Errno: " . $conn->errno . "\n";
					echo "Error: " . $conn->error . "\n";

					}
	
					if ($resultado->num_rows === 0) {
						// ¡Oh, no ha filas! Unas veces es lo previsto, pero otras
						// no. Nosotros decidimos. En este caso, ¿podría haber sido
						// actor_id demasiado grande? 
						echo "Lo sentimos. No se pudo encontrar una coincidencia para ".$_SESSION['usr'].". Inténtelo de nuevo.";
						mysqli_close($conn);
					}
					
					$Driver = $resultado->fetch_assoc();
					$_SESSION['DriverId']=$Driver['Id'];
					$_SESSION['DriverName']=$Driver['Nombre'];
					$_SESSION['DriverSur']=$Driver['Apellido'];
					$_SESSION['DriverKey']=$Driver['DriverKey'];
					$_SESSION['DriverTeam']=$Driver['Equipo'];
					
				}
				else {
						
						header("Location:1000-Index.php");	
						
				}
			}
		?>
		<script>BackGroundPicture()</script>
		
		<div id="Login">
			<a href="503-LogOut.php">Cerrar sesión</a>
		</div>
		<Div id="Menu">
			<script>BuildMenu()</script>
		</Div>
		
		<div id="Core">
		
			<div id="myProfile" >
				<h2 class="myTittle">Perfil de Piloto</h2>
				
				<form action="1151-Load_Profile.php" method="POST" class="myForm" id="UpdateForm" onsubmit="return ValidaCambio()">
					<fieldset id="Personal"><legend for="Personal">  Datos personales</legend>
						<label class="myLabel" for="Nombre">Nombre:</label>
						<?php
							echo '<input type="text" name="Nombre" id="Nombre" value="'.ucwords($_SESSION['DriverName']).'" required></input>';
						?>
						<label  class="myLabel" for="Apellido1">Apellido/s:</label>
						<?php
							echo '<input type="text" name="Apellido1" id="Apellido1" value="'. ucwords($_SESSION['DriverSur'] ).'"required></input>';
						?>
						<label  class="myLabel" for="mail">Email:</label>
						<?php
							echo '<input type="email" name="mail" value="' . $_SESSION['usr'] . '" required></input>';
						?>
						
						<?php
							include_once '506-myDBs.php';
							$KRT= new DB_KRT();
								
							if(isset($_SESSION['DriverTeam'])){
								echo '<label  class="myLabel" for="Team" id="myTeamLabel">Equipo: '.$_SESSION['DriverTeam'].'</label>';
							}
							else{
								echo '<label  class="myLabel" for="Team" id="myTeamLabel">Equipo: Independiente</label>';
							}
								
								echo '<select name="Team">';
								$conn=$KRT->setKRTConnection();

								$sql="SELECT Team FROM teams";
								if (!$resultado = $conn->query($sql)) {
									echo "Lo sentimos, este sitio web está experimentando problemas.";

									// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
									// cómo obtener información del error
									echo "Error: La ejecución de la consulta falló debido a: \n";
									echo "Query: " . $sql . "\n";
									echo "Errno: " . $conn->errno . "\n";
									echo "Error: " . $conn->error . "\n";

								}
					
								if ($resultado->num_rows === 0) {
									// ¡Oh, no ha filas! Unas veces es lo previsto, pero otras
									// no. Nosotros decidimos. En este caso, ¿podría haber sido
									// actor_id demasiado grande? 
									echo "Lo sentimos. No se pudo encontrar una coincidencia. Inténtelo de nuevo.";
									mysqli_close($conn);
								}
									
							while ($Equipos = $resultado->fetch_assoc()) {
								echo "<option>" . $Equipos['Team'] . "</option>";
							}
									
						?>
						</select>
						
						<input type="submit" value="Actualizar"></input>
					</fieldset>
				</form>
				<div id="Tooltip-Container">
						<div class="tooltip">Registrar un equipo
							<span class="tooltiptext">Debes enviar un mail a KRTChampionship@gmail.com bajo el asunto "Nuevo equipo" 
							con el nombre del equipo y la imagen de su escudo</span>
						 </div>
						 <div class="tooltip">Criterios de imagen
							<span class="tooltiptext">- La imágen principal deberá ser tipo jpg e inferior a 1MB</br>
							- Si desea que la imagen de su casco aparezca en las clasificaciones deberá enviar una foto al correo KRTChampionship@gmail.com</span>
						 </div>
				</div>
				
				<form action="1154-Manage_Pictures.php" class="myForm" name="subida-imagenes" id="FormFotos" method="POST" enctype="multipart/form-data">
					<fieldset id="Pictures"><legend for="Pictures">Imagenes</legend>
						<label  class="myLabel2" for="ImgBody2">Piloto:</label>
						<input type="file" name="ImgBody2" id="ImgBody"/>
						<input type="submit" name="subir-imagen" value="Enviar imagen" />
					</fieldset>
				</form>
				
			</div>
			
			<div id="myView">
			
				<h2 class="myTittle">Vista Pública de Piloto</h2>
				<div id="myContainer">
					<div id="Body-Picture">
								<?php
									$Number=8000+intval($_SESSION['DriverId']);
									$Pic=$Number."-Body.jpg";
									if (file_exists("8000-Driver_Pictures/".$Pic."")){
										$cadena='<img src="8000-Driver_Pictures/'.$Pic.'" id="Body">';
									}else{
										$cadena='<img src="8000-Driver_Pictures/8000-Body.jpg" id="Body">';
									}
									echo $cadena;
								?>
					</div>
					<div id="Categoria">
					<?php
							include_once '501-UserWork.php';
							$User= new User();
							if($User->IsStaff($_SESSION['DriverKey'])){
								
								echo '<img src= "9999-Club.jpg" id="Cat" class="Bott">';
							}else{
								echo '<img src= "9998-Pro.jpg" id="Cat" class="Bott">';
							}
						
					?>
					</div>
					<div id="Equipo">
						<?php
						//AQUI PONER CODIGO QUE BUSQUE EL EQUIPO
						?>
						<img src= "8900-Club_Pictures/8901-Team.jpg" id="Cat" class="Bott">
					</div>
				</div>
				
				<div id="Estadistica">
					<div id="Head">
						<?php
						//DETECTAR CAMPEONATO EN CURSO Y BUSCAR SI ESTÁ INSCRITO, SINO, PONER n/i DE NO INSCRITO
							include_once '506-myDBs.php';
							$KRT= new DB_KRT();
							$conn=$KRT->setKRTConnection();
							$sql="SELECT * FROM campeonatos";
							if (!$resultado = $conn->query($sql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";

							}
							
							$MiContador=0;
							$MiCampeonato=0;
							
							while ($Puntero = $resultado->fetch_assoc()) {
								if ($Puntero['Id']>$MiContador){
									$MiContador=$Puntero['Id'];
									$MiCampeonato=$Puntero['Year'];
									
								}
							}

							mysqli_close($conn);
							$db=$MiCampeonato;
							$conn=mysqli_connect('localhost','root','',$db);

							$sql="SELECT Num FROM inscritos WHERE DriverKey='".$_SESSION['DriverKey']."'";
							$resultado=mysqli_query($conn,$sql);
							if (mysqli_num_rows($resultado)===0) {
								$MiNumero="N/I";
							}else{
								$Valor= $resultado->fetch_assoc();
								$MiNumero=$Valor['Num'];
							}
							
							if ($MiNumero=="N/I"){
								$cadena='<div id="Num"><h1 class="Tittlef">#'.$MiNumero.'</h2></div>';
							}elseif ($MiNumero<10){
								$cadena='<div id="Num"><h1 class="Tittlef">#0'.$MiNumero.'</h2></div>';
							}else{
								$cadena='<div id="Num"><h1 class="Tittlef">#'.$MiNumero.'</h2></div>';
							}
							echo $cadena;
							
							$cadena='<div id="Nom"><h1 class="Tittlef">'.strtoupper($_SESSION['DriverName']).' '.strtoupper($_SESSION['DriverSur']).'</h2></div>';
							echo $cadena;
							mysqli_close($conn);
						?>
					</div>
					<?php
					//ESTE PHP ES SOLO PARA ACTUALIZAR LA TABLA DE ESTADISTICA DE ESTE PILOTO
					include_once '506-myDBs.php';
					$KRT= new DB_KRT();
					$conn=$KRT->setKRTConnection();
							
					$sqlCampeonato="SELECT * FROM campeonatos";
					$queryCampeonato=mysqli_query($conn,$sqlCampeonato);
					// PRIMERO BUSCAMOS EL ULTIMO CAMPEONATO YA QUE ES EL UNICO QUE SE VA A ACTUALIZAR SI O SI
					$MiContador=0;
							
					while ($Puntero = $queryCampeonato->fetch_assoc()) {
						if ($Puntero['Id']>$MiContador){
							$MiContador=$Puntero['Id'];	
							$CampeonatoActual=$Puntero['Year'];									
						}
					}
					//echo "<script>alert('".$CampeonatoActual."');</script>";
					//AHORA COMPROBAMOS SI EN LA TABLA DE ESTADISTICA EXISTE ALGÚN REGISTRO PARA ESTE AÑO
					$queryCampeonato=mysqli_query($conn,$sqlCampeonato);
					while ($MiCampeonato = $queryCampeonato->fetch_assoc()) {
						
						$sql="SELECT * FROM estadistica WHERE DriverKey='".$_SESSION['DriverKey']."' AND Campeonato='".$MiCampeonato['Year']."'";
						//echo "<script>alert('".$sql."');</script>";
						$db=$MiCampeonato['Year'];
						//echo "<script>alert('".$db."');</script>";
						$CampConn=mysqli_connect('localhost','root','',$db);		
						$resultado=mysqli_query($conn,$sql);
						if (mysqli_num_rows($resultado)===0) {
							//NO EXISTE Y HAY QUE ACTUALIZARLA
							//-->PRIMERO VEMOS SI EL PILOTO ESTABA INSCRITO

							$Campsql="SELECT Num FROM inscritos WHERE DriverKey='".$_SESSION['DriverKey']."'";
							$CampQuery=mysqli_query($CampConn,$Campsql);
							if (mysqli_num_rows($CampQuery)===0) {
								//echo "<script>alert('No inscrito');</script>";
								//==NO INSCRITO==
								$Campeon=0;
								$SubCampeon=0;
								$Tercero=0;
								$Participación=0;
								$Pole=0;
								$Vuelta=0;
								$Victoria=0;
								$Podio=0;
								
							}else{
								//echo "<script>alert('inscrito');</script>";
								$Participación=0;
								$Pole=0;
								$Vuelta=0;
								$Victoria=0;
								$Podio=0;
								
								//Vemos su numero
								$Valor= $CampQuery->fetch_assoc();
								$MiNumero=$Valor['Num'];
								//Comprobamos posicion en la general
								$Gensql="SELECT Posicion FROM general WHERE Num=".$MiNumero."";
								$GenQuery=mysqli_query($CampConn,$Gensql);
								$MiPosicion= $GenQuery->fetch_assoc();
								if ($MiPosicion['Posicion']==1){
									$Campeon=1;
									$SubCampeon=0;
									$Tercero=0;
								}elseif ($MiPosicion['Posicion']==2){
									$Campeon=0;
									$SubCampeon=1;
									$Tercero=0;
								}elseif ($MiPosicion['Posicion']==3){
									$Campeon=0;
									$SubCampeon=0;
									$Tercero=1;
								}	
								else {
									$Campeon=0;
									$SubCampeon=0;
									$Tercero=0;
								}
								//Ahora se analiza cada GP	
								$GPsql="SHOW TABLES";
								$GPQuery=mysqli_query($CampConn,$GPsql);
				
								while($GP=mysqli_fetch_row($GPQuery)){
									$myGP=$GP[0];
									//echo "<script>alert('".$myGP."');</script>";
									if ($myGP=="inscritos"){
										
									}elseif($myGP=="calendario"){

									}elseif($myGP=="general"){

									}else{
										$Finalsql="SELECT * FROM ".$myGP." WHERE Num=".$MiNumero."";
										$FinalQuery=mysqli_query($CampConn,$Finalsql);
										$GPResult= $FinalQuery->fetch_assoc();
										if (mysqli_num_rows($FinalQuery)===0) {
											//No participa
										}else{
											//Participa
											$Participación++;
											if ($GPResult['Posicion']==1){
												$Victoria++;
											}elseif ($GPResult['Posicion']==2){
												$Podio++;
											}elseif ($GPResult['Posicion']==3){
												$Podio++;
											}	
											if ($GPResult['Q']==1){
												$Pole++;
											}
											if ($GPResult['T1V']>0){
												$Vuelta++;
											}
											if ($GPResult['T2V']>0){
												$Vuelta++;
											}
											if ($GPResult['T3V']>0){
												$Vuelta++;
											}
										}
									}
								}							
							}
							$myStrA=$_SESSION['DriverKey'];
							$myStrB=$MiCampeonato['Year'];
							$INSsql="INSERT INTO estadistica (DriverKey, Campeonato, Campeon, SubCampeon, Tercero, Participacion, Pole, Vuelta, Victoria, Podio) VALUES ('$myStrA', '$myStrB', '$Campeon','$SubCampeon','$Tercero','$Participación','$Pole','$Vuelta','$Victoria','$Podio')";
							//echo $INSsql;
							//pOR AQUI VAMOS
							if (!$myqINSQuery= $conn->query($INSsql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";
							}
						}else{
							//SI YA EXISTE, VEMOS SI ES EL ULTIMO CAMPEONATO Y LO DESCARTAMOS SI NO LO ES
							$Valor = $resultado->fetch_assoc();
							if ($Valor['Campeonato']==$CampeonatoActual){
								//echo "<script>alert('".$Valor['Campeonato']."');</script>";
								// EL CAMPEONATO ESTÁ EN MARCHA, POR LO TANTO, NO HAY DATOS DE GENERAL
								$Campeon=0;
								$SubCampeon=0;
								$Tercero=0;
								//ACTUALIZAMOS LOS DATOS POR GP
								//Ahora se analiza cada GP	
								//Reiniciamos valores
								$Participación=0;
								$Pole=0;
								$Vuelta=0;
								$Victoria=0;
								$Podio=0;
								
								$GPsql="SHOW TABLES";
								$GPQuery=mysqli_query($CampConn,$GPsql);
				
								while($GP=mysqli_fetch_row($GPQuery)){
									$myGP=$GP[0];
									//echo "<script>alert('".$myGP."');</script>";
									if ($myGP=="inscritos"){
										
									}elseif($myGP=="calendario"){

									}elseif($myGP=="general"){

									}else{
										$Finalsql="SELECT * FROM ".$myGP." WHERE Num=".$MiNumero."";
										$FinalQuery=mysqli_query($CampConn,$Finalsql);
										$GPResult= $FinalQuery->fetch_assoc();
										if (mysqli_num_rows($FinalQuery)===0) {
											//No participa
										}else{
											//Participa
											$Participación++;
											if ($GPResult['Posicion']==1){
												$Victoria++;
											}elseif ($GPResult['Posicion']==2){
												$Podio++;
											}elseif ($GPResult['Posicion']==3){
												$Podio++;
											}	
											if ($GPResult['Q']==1){
												$Pole++;
											}
											if ($GPResult['T1V']>0){
												$Vuelta++;
											}
											if ($GPResult['T2V']>0){
												$Vuelta++;
											}
											if ($GPResult['T3V']>0){
												$Vuelta++;
											}
										}
									}
								}
								$INSsql="UPDATE estadistica SET Campeon='$Campeon', SubCampeon='$SubCampeon', Tercero='$Tercero', Participacion='$Participación', Pole='$Pole', Vuelta='$Vuelta',Victoria='$Victoria',Podio='$Podio' WHERE DriverKey='".$_SESSION['DriverKey']."' AND Campeonato='".$Valor['Campeonato']."'";
								if (!$myqINSQuery= $conn->query($INSsql)) {
									echo "Lo sentimos, este sitio web está experimentando problemas.";
								}
							}								
						}
						
					}

							mysqli_close($CampConn);
							mysqli_close($conn);
					?>
					<div id="Palmares">
						<div id="UpperBox">
							<div id="TableBox">
								<div class="Table-Tittle"><h3>CAMPEONATOS</h3></div>
								<div class="Table-Table">
									<table class="PreKRT" id="Table1">
										<?php
											// lo hago por partes mejor para seguir la estructura mas facil
											include_once '506-myDBs.php';
											$KRT= new DB_KRT();
											$conn=$KRT->setKRTConnection();
											$sqlEstadistica="SELECT * FROM estadistica WHERE DriverKey='".$_SESSION['DriverKey']."'";
											//echo "<script>alert('".$_SESSION['DriverKey']."');</script>";
											$EstadisticaQuery=mysqli_query($conn,$sqlEstadistica);
											
												$MiCampeon=0;
												$MiSubCampeon=0;
												$MiTercero=0;
												$MiParticipación=0;
												$MiPole=0;
												$MiVuelta=0;
												$MiVictoria=0;
												$MiPodio=0;	
											if (mysqli_num_rows($EstadisticaQuery)===0) {
												//No ha participado en nada											
											}else{
												//Por cada campeonato
												while($EstaResult=mysqli_fetch_assoc($EstadisticaQuery)){
													
													//echo "<script>alert('".$EstaResult['Campeonato']."');</script>";
													$MiCampeon=$MiCampeon+$EstaResult['Campeon'];
													$MiSubCampeon=$MiSubCampeon+$EstaResult['Subcampeon'];
													$MiTercero=$MiTercero+$EstaResult['Tercero'];
													$MiParticipación=$MiParticipación+$EstaResult['Participacion'];
													$MiPole=$MiPole+$EstaResult['Pole'];
													$MiVuelta=$MiVuelta+$EstaResult['Vuelta'];
													$MiVictoria=$MiVictoria+$EstaResult['Victoria'];
													$MiPodio=$MiPodio+$EstaResult['Podio'];													
												}
											}
											mysqli_close($conn);
											
											$String="<tr>";
											$String=$String."<th>Campeonatos:</th>";
											$String=$String."<td>".$MiCampeon."</td>";
											$String=$String."</tr>";

											$String=$String."<tr>";
											$String=$String."<th>Subcampeonatos:</th>";
											$String=$String."<td>".$MiSubCampeon."</td>";
											$String=$String."</tr>";

											$String=$String."<tr>";
											$String=$String."<th>Tercer puesto:</th>";
											$String=$String."<td>".$MiTercero."</td>";
											$String=$String."</tr>";
											
									$String=$String."</table>";
								$String=$String."</div>";
							$String=$String."</div>";
							
							echo $String;
											
							$cadena='<div id="CascoBox">';
							$Number=8000+intval($_SESSION['DriverId']);
							$Pic=$Number."-Casco.png";
									if (file_exists("8000-Driver_Pictures/".$Pic."")){
										$cadena='<img src="8000-Driver_Pictures/'.$Pic.'" id="Pic-Casco">';
									}else{
										$cadena='<img src="8000-Driver_Pictures/8000-Casco.png" id="Pic-Casco">';
									}							
							echo $cadena;
							
							$String="</div>";
						$String=$String."</div>";
						$String=$String.'<div id="BottomBox">';
						$String=$String.'<div class="Table-Tittle"><h3>GRAN PREMIO</h3></div>';
						$String=$String.'<table class="PostKRT-Tanda" id="Table2">';
						
						$String=$String."<tr>";
						$String=$String."<th>Carreras:</th>";
						$String=$String."<td>".$MiParticipación."</td>";
						$String=$String."</tr>";
						
						$String=$String."<tr>";
						$String=$String."<th>Pole:</th>";
						$String=$String."<td>".$MiPole."</td>";
						$String=$String."</tr>";

						$String=$String."<tr>";
						$String=$String."<th>V. Rapida:</th>";
						$String=$String."<td>".$MiVuelta."</td>";
						$String=$String."</tr>";
						
						$String=$String."</table>";
						
						$String=$String.'<table class="PostKRT-GP" id="Table3">';
						
						$String=$String."<tr>";
						$String=$String."<th>Victorias:</th>";
						$String=$String."<td>".$MiVictoria."</td>";
						$String=$String."</tr>";

						$String=$String."<tr>";
						$String=$String."<th>Podio:</th>";
						$String=$String."<td>".$MiPodio."</td>";
						$String=$String."</tr>";
						
						echo $String;
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>