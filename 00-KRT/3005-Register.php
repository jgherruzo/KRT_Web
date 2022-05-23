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
		
		<link href="3005-Register.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.css" rel="stylesheet" type="text/css" />
		<link href="200-Partner.CSS" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT Championship | Inscripciones</title>
	</head>
	<body>
		<?php
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado		
			if(isset($_SESSION['usr'])){
			}else{	
			session_start();
			}
		?>
		<script>BackGroundPicture()</script>
		<div id="myHeader">
			<div id="Login">
				<a href="1150-Profile.php">Perfil de piloto</a>	
			</div>
		</div>
		<Div id="Menu">
			<script>BuildMenu()</script>
		</Div>
		
		<div id="dvCore">

			<div id="dvContenedor1">
				<h2 class="myTittle">Inscripción en KRT Championship</h2>
				<div id="dvA">
					<h2 class="Status">
					<?php
						// tienes que entrar en el campeonato correspondiente y ver si el driverkey existe
						
						//empieza por ver si es campeonato actual o siguiente
						
						$AñoActual=date("Y");
						$Diciembre= strtotime("01-12-".$AñoActual." 10:00:00");
						$FechaActual=strtotime(date("d-m-Y H:i:00",time()));
						
						if($FechaActual > $Diciembre){
							//inscibirme en el proximo campeonato
							$AñoActual=date("Y")+1;
						}
						
						//Ahora compruebo que la base de datos existe
						$conn=mysqli_connect('localhost','root','',$AñoActual);
						
						if (!$conn) {
							die("Aún no se ha creado este campeonato");
						}
						
						//Compruebo si está inscrito
						$mystr="SELECT * FROM inscritos WHERE DriverKey = '".$_SESSION['DriverKey']."'";
						
						$query=mysqli_query($conn,$mystr);
						
						if (mysqli_num_rows($query)>0){
							while ($DriverData= mysqli_fetch_array ($query)){
								//Compruebo si esta confirmado
								
								if ($DriverData['Num']>1000){
									echo 'Invitado</h2>';
									echo '<form class="myForm" action="3007-RegGenManager.php" method="POST" id="RegGen">';
									echo '<input type="submit" value="Inscríbeme"></input>'	;				
									echo '</form>';
									echo '<table>';
									echo "<tr><th>Número:</th><td>#".$DriverData['Num']."</td></tr>";
									echo "<tr><th>Piloto:</th><td>".$DriverData['Nombre']." ".$DriverData['Apellido']."</td></tr>";
								}else{
									if ($DriverData['Pagado']=="X"){
										echo 'Inscrito</h2>';
									}else{
										echo 'Pendiente de pago</h2>';
									}
								}
								echo '<table>';
								echo "<tr><th>Número:</th><td>#".$DriverData['Num']."</td></tr>";
								echo "<tr><th>Piloto:</th><td>".$DriverData['Nombre']." ".$DriverData['Apellido']."</td></tr>";
							}
						}else{
							//no esta inscrito
							echo '<form class="myForm" action="3007-RegGenManager.php" method="POST" id="RegGen">';
							echo '<input type="submit" value="Inscríbeme"></input>'	;				
							echo '</form>';
							echo '<table>';
							echo '<tr><th>Número:</th></tr><tr><th>Piloto:</th></tr>';
						}
						echo '</table>';
						echo '</div>';
					?>

			</div>

			<div id="dvContenedor2">
				<h2 class="myTittle">Inscripción en próximo GP</h2>
				<div id="dvB">
				<h2 class="Status">
				<?php
						// tienes que entrar en el campeonato correspondiente y ver si el driverkey existe
						
						//empieza por ver si es campeonato actual o siguiente
						
						$AñoActual=date("Y");
						$Diciembre= strtotime("01-12-".$AñoActual." 10:00:00");
						$FechaActual=strtotime(date("d-m-Y H:i:00",time()));
						
						if($FechaActual > $Diciembre){
							//inscibirme en el proximo campeonato
							$AñoActual=date("Y")+1;
						}
						
						//Ahora compruebo que la base de datos existe
						$conn=mysqli_connect('localhost','root','',$AñoActual);
						if (!$conn) {
							die("Aún no se ha creado este campeonato");
						}
						//Compruebo el siguiente GP
						
							$strCalendar="SELECT * FROM calendario";
							$Calendarquery=mysqli_query($conn,$strCalendar);
							$Hoy=date("d-m-Y");
							$Bandera="No";
							$NextGP=0;
							if (mysqli_num_rows($Calendarquery)>0){
								while ($Prueba= mysqli_fetch_array ($Calendarquery)){
									//Miramos que GP nos encaja con un mes de diferencia
									//mira si es mayor que fecha actual y menor que fecha mas un mes, si esta entre medias, ese es mi GP
									$myGP=strtotime($Prueba['Fecha']);
									$myGP=date("d-m-Y",$myGP);
									if(strtotime($myGP)>strtotime($Hoy)){
										
										if($Bandera=="No"){
											$Bandera="Si";
											$NextGP=$myGP;
											$NumberGP=$Prueba['GP'];
										}
									}
									
								}
							
								$Limite = date('d-m-Y', strtotime('+1 month')) ;
								//echo '<p>'.$NextGP.' '.$Hoy.' '.$Limite.'</p>';
								if($NextGP==0){
									//No se ha encontrado en la DB ninguna fecha superior al día de hoy
									//campeonato acabado
									echo 'El campeonato actual ya ha finalizado</h2>';
									
								}else{
									//Compruebo si queda más de un mes para la siguiente prueba
									if(strtotime($NextGP)>strtotime($Limite)){
										echo 'Las inscripciones se abren con un mes de antelación<br>';
										echo 'Proximo GP: '.$NextGP.'<br></h2>';
									}else{
										//AQUI HACEMOS TODO LO RELATIVO A LA INSCRIPCIÓN
										
										//Primero miramos si está inscrito en el campeonato o no
										$mystr="SELECT * FROM inscritos WHERE DriverKey = '".$_SESSION['DriverKey']."'";
										$query=mysqli_query($conn,$mystr);

										if (mysqli_num_rows($query)>0){
											//está inscrito, comprobamos el calendario del campeonato
											while ($Driver= mysqli_fetch_array ($query)){
													//Miramos el número
													$DriverNumber=$Driver['Num'];
											}										

											$GPstr="SELECT * FROM GP".$NumberGP." WHERE Num = '".$DriverNumber."'";
											$GPquery=mysqli_query($conn,$GPstr);
											if (mysqli_num_rows($GPquery)>0){
												
												echo 'Inscrito</h2>';
												
											}else{
											
												//Se puede inscribir
												//CREA LA BASE TABLA DEL GP Y SIGUE POR AQUI
												echo 'GP '.$NumberGP.'<br></h2>';
												echo '<form class="myForm" action="3008-RegGPManager.php" method="POST" id="RegGP">';
												echo '<input type="submit" value="Inscríbeme"></input>';
												echo '</form>';
											}
										}else{
											
											echo 'GP '.$NumberGP.'<br></h2>';
											echo '<form class="myForm" action="3008-RegGPManager.php" method="POST" id="RegGP">';
											echo '<input type="submit" value="Inscríbeme"></input>';
											echo '</form>';
											
										}									
										
									}
								}							
							}else{
								//no hay calendario
								echo 'Calendario por definir</h2>';
							}							
							
				?>

				</div>
			</div>
			<div id="dvContenedor3">
				<h2 class="myTittle">Lista de inscritos</h2>
				<div class="dvC">
					<h2 class="Status">
					<?php
						//comprobamos que el gp está disponible
						$AñoActual=date("Y");
						$Diciembre= strtotime("01-12-".$AñoActual." 10:00:00");
						$FechaActual=strtotime(date("d-m-Y H:i:00",time()));
						
						if($FechaActual > $Diciembre){
							//inscibirme en el proximo campeonato
							$AñoActual=date("Y")+1;
						}					
						//Ahora compruebo que la base de datos existe
						$conn=mysqli_connect('localhost','root','',$AñoActual);
						if (!$conn) {
							die("Aún no se ha creado este campeonato");
						}
						//Compruebo el siguiente GP
						$strCalendar="SELECT * FROM calendario";
						$Calendarquery=mysqli_query($conn,$strCalendar);
						$Hoy=date("d-m-Y");
						$Bandera="No";
						$NextGP=0;
						if (mysqli_num_rows($Calendarquery)>0){
							while ($Prueba= mysqli_fetch_array ($Calendarquery)){
								//Miramos que GP nos encaja con un mes de diferencia
								//mira si es mayor que fecha actual y menor que fecha mas un mes, si esta entre medias, ese es mi GP
								$myGP=strtotime($Prueba['Fecha']);
								$myGP=date("d-m-Y",$myGP);
								if(strtotime($myGP)>strtotime($Hoy)){
										
									if($Bandera=="No"){
										$Bandera="Si";
										$NextGP=$myGP;
										$NumberGP=$Prueba['GP'];
									}
								}
									
							}
							$OrdenInc=1;
							$Limite = date('d-m-Y', strtotime('+1 month')) ;
							if($NextGP==0){
									//No se ha encontrado en la DB ninguna fecha superior al día de hoy
									//campeonato acabado
								echo '</h2>';
									
							}else{
								//Compruebo si queda más de un mes para la siguiente prueba
								if(strtotime($NextGP)>strtotime($Limite)){
										echo '</h2>';
								}else{
									echo 'GP'.$NumberGP.'</h2>';
									echo '<table>';
									echo "<tr><th>Orden</th><th>Número</th><th>Categoría</th><th>Piloto</th></tr>";
									//Primero sacamos los inscritos
									$GPstr="SELECT * FROM GP".$NumberGP."";
									$GPquery=mysqli_query($conn,$GPstr);
									if (mysqli_num_rows($GPquery)>0){
										
										//primero miramos los socios
										while ($Driver= mysqli_fetch_array ($GPquery)){
											//Miramos el número
											$DriverNumber=$Driver['Num'];
											
											//Comprobamos los datos
											$DatosPiloto="SELECT * FROM inscritos WHERE Num = '".$DriverNumber."'";
											$DatosPilotoQuery=mysqli_query($conn,$DatosPiloto);
											//primero miramos los socios
											while ($Inc= mysqli_fetch_array ($DatosPilotoQuery)){
												$MiNombre=$Inc['Nombre'];
												$MiApellido=$Inc['Apellido'];
												$MiKey=$Inc['DriverKey'];
												$Socio="SELECT * FROM socios WHERE DriverKey = '".$MiKey."'";
												$KRTconn=mysqli_connect('localhost','root','','krt_users');
												$SocioQuery=mysqli_query($KRTconn,$Socio);

												if (mysqli_num_rows($SocioQuery)>0){
													echo "<tr><td>".$OrdenInc."</td>";
													echo "<td>#".$DriverNumber."</td>";
													echo "<td>PRO/CLUB</td>";
													echo "<td>".$MiNombre." ".$MiApellido."</td></tr>";
													$OrdenInc=$OrdenInc+1;
												}
											}											
										}
												
									}
									$GPquery=mysqli_query($conn,$GPstr);
									if (mysqli_num_rows($GPquery)>0){
										
										//primero miramos los socios
										while ($Driver= mysqli_fetch_array ($GPquery)){
											//Miramos el número
											$DriverNumber=$Driver['Num'];
											
											//Comprobamos los datos
											$DatosPiloto="SELECT * FROM inscritos WHERE Num = '".$DriverNumber."'";
											$DatosPilotoQuery=mysqli_query($conn,$DatosPiloto);
											while ($Inc= mysqli_fetch_array ($DatosPilotoQuery)){
												
												if($DriverNumber<1000){
													$MiNombre=$Inc['Nombre'];
													$MiApellido=$Inc['Apellido'];
													$MiKey=$Inc['DriverKey'];
													$Socio="SELECT * FROM socios WHERE DriverKey = '".$MiKey."'";
													$KRTconn=mysqli_connect('localhost','root','','krt_users');
													$SocioQuery=mysqli_query($KRTconn,$Socio);

													if (mysqli_num_rows($SocioQuery)>0){
													}else{
													
														echo "<tr><td>".$OrdenInc."</td>";
														echo "<td>#".$DriverNumber."</td>";
														echo "<td>PRO</td>";
														echo "<td>".$MiNombre." ".$MiApellido."</td></tr>";
														$OrdenInc=$OrdenInc+1;
													}
												}
											}											
										}
												
									}
									$GPquery=mysqli_query($conn,$GPstr);
									if (mysqli_num_rows($GPquery)>0){
										
										//primero miramos los socios
										while ($Driver= mysqli_fetch_array ($GPquery)){
											//Miramos el número
											$DriverNumber=$Driver['Num'];
											
											//Comprobamos los datos
											$DatosPiloto="SELECT * FROM inscritos WHERE Num = '".$DriverNumber."'";
											$DatosPilotoQuery=mysqli_query($conn,$DatosPiloto);
											while ($Inc= mysqli_fetch_array ($DatosPilotoQuery)){
												
												if($DriverNumber>1000){
												$MiNombre=$Inc['Nombre'];
												$MiApellido=$Inc['Apellido'];
												$MiKey=$Inc['DriverKey'];
													$Socio="SELECT * FROM socios WHERE DriverKey = '".$MiKey."'";
													$KRTconn=mysqli_connect('localhost','root','','krt_users');
													$SocioQuery=mysqli_query($KRTconn,$Socio);

													if (mysqli_num_rows($SocioQuery)>0){
													}else{
													
														echo "<tr><td>".$OrdenInc."</td>";
														echo "<td>#".$DriverNumber."</td>";
														echo "<td>No Compite</td>";
														echo "<td>".$MiNombre." ".$MiApellido."</td></tr>";
														$OrdenInc=$OrdenInc+1;
													}
												}
											}											
										}
												
									}
								mysqli_close($conn);
								if (isset($KRTconn)){
									mysqli_close($KRTconn);
								}
								echo '</table>';
								}
							}
						}else{
							//no hay calendario
							echo '</h2>';
						}						
					?>
				</div>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>
