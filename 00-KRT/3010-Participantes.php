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
		
		<link href="3010-Participantes.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.CSS" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT Championship| Participantes</title>
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
		<?php
			//Primero buscamos cual es el campeonato actual
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

			
			$db=$MiCampeonato;
			$Campconn=mysqli_connect('localhost','root','',$db);

			$sql="SELECT * FROM inscritos";
			$resultado=mysqli_query($Campconn,$sql);
			if (mysqli_num_rows($resultado)===0) {
				//No hay inscritos y aquí se acaba
				echo "<script>alert('No hay ningún inscrito');</script>";
			}else{
					
				//Hay inscritos, ahora, por cada inscritos
				while($Inscrito=mysqli_fetch_assoc($resultado)){
					//Comprobamos si ha pagado
					if ($Inscrito['Pagado']=="X"){
						//Extraigo driver key paa buscar id de usuario
						//nombre apellido y numero
						$PilotoKey=$Inscrito['DriverKey'];
						
						if($Inscrito['Num']=="N/I"){							
							$PilotoNum=$Inscrito['Num'];
						}elseif($Inscrito['Num']<10){
							$PilotoNum="#0".$Inscrito['Num'];
						}else{
							$PilotoNum="#".$Inscrito['Num'];
						}
						
						$PilotoNomb=$Inscrito['Nombre'];
						$PilotoApe=$Inscrito['Apellido'];
					}
					//Nos aseguramos que sea usuario de la web
					//echo "<script>alert('".strlen($PilotoKey)."');</script>";
					if (strlen($PilotoKey)>1){
						//Ahora buscamos el id para sacar las fotos
						$Picsql="SELECT Id FROM users WHERE DriverKey='".$PilotoKey."'";
						$PicResult=mysqli_query($conn,$Picsql);
						$Usuario=mysqli_fetch_assoc($PicResult);
						$UNumber=8000+intval($Usuario['Id']);
						$PicCasco=$UNumber."-Casco.png";
						$PicBody=$UNumber."-Body.jpg";
						
						//Miramos el equipo
						$Teamsql="SELECT Equipo FROM users WHERE DriverKey='".$PilotoKey."'";

						$TeamResult=mysqli_query($conn,$Teamsql);
						$Equipo=mysqli_fetch_assoc($TeamResult);
						$MiEquipo=$Equipo['Equipo'];
						//echo "<script>alert('".$MiEquipo."');</script>";
						$TeamIDsql="SELECT Id FROM teams WHERE Team='".$MiEquipo."'";
						$TeamIDResult=mysqli_query($conn,$TeamIDsql);
						if (mysqli_num_rows($TeamIDResult)===0) {
							$TNumber=8902;
						}else{
							$EquipoID=mysqli_fetch_assoc($TeamIDResult);
							$TNumber=8900+intval($EquipoID['Id']);
						}							
						$PicTeam=$TNumber."-Team.jpg";
						
						//Miramos la categoria
							include_once '501-UserWork.php';
							$User= new User();
							if($User->IsStaff($PilotoKey)){								
								$Categoria='<img src= "9999-Club.jpg" id="Cat" class="Bott">';
							}else{
								$Categoria='<img src= "9998-Pro.jpg" id="Cat" class="Bott">';
							}

//=============================================================================================================================================================================
//=============================================================================================================================================================================
					//ESTE PHP ES SOLO PARA ACTUALIZAR LA TABLA DE ESTADISTICA DE ESTE PILOTO
					$myKRT= new DB_KRT();
					$connA=$myKRT->setKRTConnection();
							
					$sqlCampeonato2="SELECT * FROM campeonatos";
					$queryCampeonato2=mysqli_query($connA,$sqlCampeonato2);
					// PRIMERO BUSCAMOS EL ULTIMO CAMPEONATO YA QUE ES EL UNICO QUE SE VA A ACTUALIZAR SI O SI
					$MiContador2=0;
							
					while ($Puntero2 = $queryCampeonato2->fetch_assoc()) {
						if ($Puntero2['Id']>$MiContador2){
							$MiContador2=$Puntero2['Id'];	
							$CampeonatoActual2=$Puntero2['Year'];									
						}
					}
					//AHORA COMPROBAMOS SI EN LA TABLA DE ESTADISTICA EXISTE ALGÚN REGISTRO PARA ESTE AÑO
					$queryCampeonato2=mysqli_query($connA,$sqlCampeonato2);
					while ($MiCampeonato2 = $queryCampeonato2->fetch_assoc()) {
						
						$sql="SELECT * FROM estadistica WHERE DriverKey='".$PilotoKey."' AND Campeonato='".$MiCampeonato2['Year']."'";
						//echo "<script>alert('".$sql."');</script>";
						$db=$MiCampeonato2['Year'];
						//echo "<script>alert('".$db."');</script>";
						$CampConnA=mysqli_connect('localhost','root','',$db);		
						$resultado2=mysqli_query($connA,$sql);
						if (mysqli_num_rows($resultado2)===0) {
							//NO EXISTE Y HAY QUE ACTUALIZARLA
							//-->PRIMERO VEMOS SI EL PILOTO ESTABA INSCRITO
							$Campsql2="SELECT Num FROM inscritos WHERE DriverKey='".$PilotoKey."'";
							$CampQuery2=mysqli_query($CampConnA,$Campsql2);
							if (mysqli_num_rows($CampQuery2)===0) {
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
								$Valor= $CampQuery2->fetch_assoc();
								$MiNumero=$Valor['Num'];
								//Comprobamos posicion en la general
								$Gensql="SELECT Posicion FROM general WHERE Num=".$MiNumero."";
								$GenQuery=mysqli_query($CampConnA,$Gensql);
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
								$GPQuery=mysqli_query($CampConnA,$GPsql);
				
								while($GP=mysqli_fetch_row($GPQuery)){
									$myGP=$GP[0];
									//echo "<script>alert('".$myGP."');</script>";
									if ($myGP=="inscritos"){
										
									}elseif($myGP=="calendario"){

									}elseif($myGP=="general"){

									}else{
										$Finalsql="SELECT * FROM ".$myGP." WHERE Num=".$MiNumero."";
										$FinalQuery=mysqli_query($CampConnA,$Finalsql);
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
							$myStrA=$PilotoKey;
							$myStrB=$MiCampeonato2['Year'];
							$INSsql="INSERT INTO estadistica (DriverKey, Campeonato, Campeon, SubCampeon, Tercero, Participacion, Pole, Vuelta, Victoria, Podio) VALUES ('$myStrA', '$myStrB', '$Campeon','$SubCampeon','$Tercero','$Participación','$Pole','$Vuelta','$Victoria','$Podio')";
							//echo $INSsql;
							//pOR AQUI VAMOS
							if (!$myqINSQuery= $connA->query($INSsql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";
							}
						}else{
							//SI YA EXISTE, VEMOS SI ES EL ULTIMO CAMPEONATO Y LO DESCARTAMOS SI NO LO ES
							$Valor = $resultado2->fetch_assoc();
							if ($Valor['Campeonato']==$CampeonatoActual2){
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
								$GPQuery=mysqli_query($CampConnA,$GPsql);
				
								while($GP=mysqli_fetch_row($GPQuery)){
									$myGP=$GP[0];
									//echo "<script>alert('".$myGP."');</script>";
									if ($myGP=="inscritos"){
										
									}elseif($myGP=="calendario"){

									}elseif($myGP=="general"){

									}else{
										$Finalsql="SELECT * FROM ".$myGP." WHERE Num=".$PilotoNum."";
										$test="SELECT * FROM ".$myGP;
										$myquerytest=mysqli_query($CampConnA,$test);
				
										if (mysqli_num_rows($myquerytest)===0) {
										}else{

										//SIGUE POR AQUI COMPROBANDO SI HGAY REGISTROS
											$FinalQuery=mysqli_query($CampConnA,$Finalsql);
					
												if (!mysqli_num_rows($FinalQuery)) {
													//No participa
												}else{
													//Participa
													$GPResult= $FinalQuery->fetch_assoc();
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
								$INSsql="UPDATE estadistica SET Campeon='$Campeon', SubCampeon='$SubCampeon', Tercero='$Tercero', Participacion='$Participación', Pole='$Pole', Vuelta='$Vuelta',Victoria='$Victoria',Podio='$Podio' WHERE DriverKey='".$PilotoKey."' AND Campeonato='".$Valor['Campeonato']."'";
								if (!$myqINSQuery= $connA->query($INSsql)) {
									echo "Lo sentimos, este sitio web está experimentando problemas.";
								}
							}								
						}
						
					}
//=============================================================================================================================================================================
//=============================================================================================================================================================================
//=============================================================================================================================================================================
//=============================================================================================================================================================================
											// Actualizo la estadistica
											$my2KRT= new DB_KRT();
											$connB=$my2KRT->setKRTConnection();
											$sqlEstadistica="SELECT * FROM estadistica WHERE DriverKey='".$PilotoKey."'";
											//echo "<script>alert('".$_SESSION['DriverKey']."');</script>";
											$EstadisticaQuery=mysqli_query($connB,$sqlEstadistica);
											
						//CREAMOS LAS VARIABLES DE ESTADISTICA
								$Campeon=0;
								$SubCampeon=0;
								$Tercero=0;
								$Participación=0;
								$Pole=0;
								$Vuelta=0;
								$Victoria=0;
								$Podio=0;
								
											if (mysqli_num_rows($EstadisticaQuery)===0) {
												//No ha participado en nada											
											}else{
												//Por cada campeonato
												while($EstaResult=mysqli_fetch_assoc($EstadisticaQuery)){
													
													//echo "<script>alert('".$EstaResult['Campeonato']."');</script>";
													$Campeon=$Campeon+$EstaResult['Campeon'];
													$SubCampeon=$SubCampeon+$EstaResult['Subcampeon'];
													$Tercero=$Tercero+$EstaResult['Tercero'];
													$Participación=$Participación+$EstaResult['Participacion'];
													$Pole=$Pole+$EstaResult['Pole'];
													$Vuelta=$Vuelta+$EstaResult['Vuelta'];
													$Victoria=$Victoria+$EstaResult['Victoria'];
													$Podio=$Podio+$EstaResult['Podio'];													
												}
											}

//=============================================================================================================================================================================
//=============================================================================================================================================================================
						//echo "<script>alert('".$PilotoKey." ".$Podio."');</script>";		
						//Ahora, con todas las variables, montamos la web
						$HTML='<div id="Enclosure">';
						$HTML=$HTML.'<div id="Participante">';
							$HTML=$HTML.'<div id="PartTop">';
								$HTML=$HTML.'<h2 id="PartTopName">'.$PilotoNum.' '.utf8_encode($PilotoNomb).' '.utf8_encode($PilotoApe).'</h2>';
							$HTML=$HTML."</div>";
							$HTML=$HTML.'<div id="PartMiddle">';
							if (file_exists("8000-Driver_Pictures/".$PicBody."")){
								$HTML=$HTML.'<img src="8000-Driver_Pictures/'.$PicBody.'" id="Pic-Body">';
							}else{
								$HTML=$HTML.'<img src="8000-Driver_Pictures/8000-Body.jpg" id="Pic-Body">';
							}							
							$HTML=$HTML."</div>";
							$HTML=$HTML.'<div class="PartBottom">';
								$HTML=$HTML.$Categoria;
							if (file_exists("8900-Club_Pictures/".$PicTeam."")){
								$HTML=$HTML.'<img src="8900-Club_Pictures/'.$PicTeam.'" id="Pic-Team">';
							}else{
								$HTML=$HTML.'<img src="8900-Club_Pictures/8900-Team.jpg" id="Pic-Team">';
							}									
							$HTML=$HTML."</div>";
							
							$HTML=$HTML.'<div id="dEstadistica">';
								$HTML=$HTML.'<table id="tEstadistica">';
									$HTML=$HTML.'<thead>';
										$HTML=$HTML.'<tr class="Tittles">';
											$HTML=$HTML.'<th colspan="4" class="gen">Estadisticas</th>';
										$HTML=$HTML.'</tr>';
									$HTML=$HTML.'</thead>';
									$HTML=$HTML.'<tbody>';
									
										$HTML=$HTML.'<tr class="Tittles">';
											$HTML=$HTML.'<th colspan="2" class="subcol">Gran Premio</th>';
											$HTML=$HTML.'<th colspan="2" class="subcol">General</th>';
										$HTML=$HTML.'</tr>';
									
				
										$HTML=$HTML.'<tr class="data">';
											$HTML=$HTML.'<td class="col1">Participaciones</td>';
											$HTML=$HTML.'<td class="col2">'.$Participación.'</td>';
										$HTML=$HTML.'</tr>';
										$HTML=$HTML.'<tr class="data">';
											$HTML=$HTML.'<td class="col1">Poles</td>';
											$HTML=$HTML.'<td class="col2">'.$Pole.'</td>';
											$HTML=$HTML.'<td class="col3">Ganador</td>';
											$HTML=$HTML.'<td class="col4">'.$Campeon.'</td>';
										$HTML=$HTML.'</tr>';
										$HTML=$HTML.'<tr class="data">';
											$HTML=$HTML.'<td class="col1">V. Rapida</td>';
											$HTML=$HTML.'<td class="col2">'.$Vuelta.'</td>';
											$HTML=$HTML.'<td class="col3">Segundo</td>';
											$HTML=$HTML.'<td class="col4">'.$SubCampeon.'</td>';
										$HTML=$HTML.'</tr>';
										$HTML=$HTML.'<tr class="data">';
											$HTML=$HTML.'<td class="col1">Victorias</td>';
											$HTML=$HTML.'<td class="col2">'.$Victoria.'</td>';
											$HTML=$HTML.'<td class="col3">Podio</td>';
											$HTML=$HTML.'<td class="col4">'.$Tercero.'</td>';											
										$HTML=$HTML.'</tr>';
										$HTML=$HTML.'<tr class="data">';
											$HTML=$HTML.'<td class="col1">Podios</td>';
											$HTML=$HTML.'<td class="col2">'.$Podio.'</td>';
										$HTML=$HTML.'</tr>';										
									$HTML=$HTML.'</tbody>';
								$HTML=$HTML.'</table>';
							$HTML=$HTML."</div>";
						$HTML=$HTML."</div>";
						$HTML=$HTML."</div>";
						echo $HTML;
					}
				}				
			}
			
			mysqli_close($conn);
			mysqli_close($Campconn);
			if(isset($CampConnA)){
				mysqli_close($CampConnA);
			}
			if(isset($connA)){
				mysqli_close($connA);
			}
			if(isset($connB)){
				mysqli_close($connB);
			}			
							
		?>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>