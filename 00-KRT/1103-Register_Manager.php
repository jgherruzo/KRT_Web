			<?php

				include_once '501-UserWork.php';
				include_once '502-UserSession.php';
				include_once '506-myDBs.php';
				$usersession = new UserSession();
				$User= new User();
				$KRT= new DB_KRT();
				
				$base_url="http://localhost/00-KRT/";
				
				//	Primero comprobamos que el email no existe //			
				if(isset($_POST['Email'])){
					
					$UserForm=$_POST['Email'];
					$NameForm=$_POST['Nombre'];
					$SurForm=$_POST['Apellido1'];
					$PassForm=$_POST['Password'];
					
					$md5pass = md5($PassForm);
					$activation=md5($UserForm.time());
					$Equipo="Independiente";
					$Valor=1;
					
					if($User->EmailExists($UserForm)){
						
						$ErrorLogin="Este Email ya está registrado";
						include_once "1100-Login.php";					
						
					}else{
						 
						 $conn=$KRT->setKRTConnection();
						 
						$sql = "INSERT INTO users (Nombre, Apellido, Email, Password, Code, Equipo, Cambio) VALUES ('$NameForm', '$SurForm', '$UserForm','$md5pass','$activation','$Equipo','$Valor')";
						if (mysqli_query($conn, $sql)) {
							
							$usersession->setCurrentUser($UserForm);
							$User->setUser($UserForm);
							$sql="SELECT Id, Nombre, Apellido, Equipo FROM users WHERE Email = '".$_SESSION['usr']."'";
							if (!$resultado = $conn->query($sql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";

								// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
								// cómo obtener información del error
								echo "Error: La ejecución de la consulta falló debido a: \n";
								echo "Query: " . $sql . "\n";
								echo "Errno: " . $conn->errno . "\n";
								echo "Error: " . $conn->error . "\n";

							}else{
								
									$Driver = $resultado->fetch_assoc();
									$_SESSION['DriverId']=$Driver['Id'];
									$_SESSION['DriverName']=$Driver['Nombre'];
									$_SESSION['DriverSur']=$Driver['Apellido'];
									$_SESSION['DriverTeam']=$Driver['Equipo'];
									//Declaramos el array de 3 posiciones
									$arrayStrings = [substr($NameForm, 0, 1),substr($SurForm, 0, 1),$_SESSION['DriverId']];
									//Declaramos una variable para el resultado
									$myKey = "";
									//Recorremos el array con un foreach
									foreach($arrayStrings as $temp){
										//Concatenamos cada posición
										$myKey = $myKey . $temp;
									}
									$_SESSION['DriverKey']=$myKey;
									$sql = "UPDATE users SET DriverKey='$myKey' WHERE Email='".$UserForm."'";
									mysqli_query($conn, $sql);
							}

							// sending email
							include '507-Send_Mail.php';
							$to=$UserForm;
							$subject="KRT Website verification";
							$body='Estimad@, <br/> <br/> Esto es un email de verificación. <br/> <br/> <a href="'.$base_url.'activation/'.$activation.'">'.$base_url.'activation/'.$activation.'</a>';
						
							Send_Mail($to,$subject,$body);
							
							$ErrorLogin ="Se ha enviado un email de verfificación a su cuenta de correo";
							include_once "1100-Login.php";
						
						} else {
							  			
							  $ErrorLogin ="Error de conexion";
							  include_once "1100-Login.php";
						}
						

					}
					
				}

			?>