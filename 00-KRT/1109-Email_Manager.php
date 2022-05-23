			<?php

				include_once '501-UserWork.php';
				include_once '502-UserSession.php';
				include_once '506-myDBs.php';
				
				//echo "<script>alert('Tarea Guardada');</script>";
				
				$usersession = new UserSession();
				$User= new User();
				$KRT= new DB_KRT();
				
				$base_url="http://localhost/00-KRT/";
				//	Primero comprobamos que el email no existe //			
				if(isset($_POST['mail'])){
					
					$UserForm=$_POST['mail'];
					$md5pass=md5("Activar cambio de contraseña");
					
					if($User->EmailExists($UserForm)){
						
						//AQUI TOENES QUE COMPROBAR SI EL CAMBIO DE CONTRASEÑA ESTÁ ACTIVADO O NO
						$conn=$KRT->setKRTConnection();
						$sql="SELECT * FROM users WHERE Email = '".$UserForm."'";
						
						if (!$resultado = $conn->query($sql)) {
								echo "Lo sentimos, este sitio web está experimentando problemas.";

						}else{
							$Driver = $resultado->fetch_assoc();
							$myCambio =$Driver['Cambio'];
							$myCode =$Driver['Code'];
						}
						//Si no esta activado, recupera el codigo de usuario//
						
						if ($myCambio==0){
							//ya esta habilitado
							include_once "1101-PassModification.php";
						}else{
							// sending email
							include '507-Send_Mail.php';
							$to=$UserForm;
							$subject="KRT Website Pass Modification";
							$body='Estimad@, <br/> <br/> Pulsa el siguiente enlace para activar el cambio de contraseña. Una vez activado, vuelva a pulsar la opción de cambiar contraseña en la web de KRT <br/> <br/>
							<a href="'.$base_url.'Pass_Update/'.$myCode.'">'.$base_url.'Pass_Update/'.$myCode.'</a>';
							
							Send_Mail($to,$subject,$body);
								
							$ErrorLogin ="Se ha enviado un email de verificación a su cuenta de correo";						
							include_once "1100-Login.php";
							
						}					
						
					}else{

						$ErrorLogin="Este Email no está registrado";
						include_once "1100-Login.php";					

					}
					
				}

			?>