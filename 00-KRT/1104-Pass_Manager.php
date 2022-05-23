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
					$PassForm=$_POST['pass'];
					
					$md5pass = md5($PassForm);
					
					if($User->EmailExists($UserForm)){						
						
						$conn=$KRT->setKRTConnection();
						 
						$sql = "UPDATE users SET Password='$md5pass' WHERE Email='".$UserForm."'";
						
							
						if (mysqli_query($conn, $sql)) {
							
							$sql = "UPDATE users SET Cambio='1' WHERE Email='".$UserForm."'";
							
							if (mysqli_query($conn, $sql)) {
								header("Location:1000-Index.php");
							}
						
						} else {
							  			
							  $ErrorLogin ="Error de conexion ";
							  include_once "1100-Login.php";
						}
					
						
					}else{

						$ErrorLogin="Este Email no está registrado";
						include_once "1100-Login.php";					

					}
					
				}

			?>