			<?php

				include_once '501-UserWork.php';
				include_once '502-UserSession.php';
				include_once '506-myDBs.php';
				
				$KRT= new DB_KRT();
				$usersession = new UserSession();
				$User= new User();
				
				//	Primero comprobamos que el email no existe //			
				if(isset($_POST['mail'])){
					
					$UserForm=$_POST['mail'];
					$NameForm=$_POST['Nombre'];
					$SurForm=$_POST['Apellido1'];
					$TeamForm=$_POST['Team'];
					
					$conn=$KRT->setKRTConnection();
					
					// Comprobamos si el nombre ha cambiado //
					
					if($NameForm != S_SESSION['DriverName']){
						
						$sql = "UPDATE users SET Nombre='$NameForm' WHERE Email='".$_SESSION['usr']."'";
						if (mysqli_query($conn, $sql)) {
							$_SESSION['DriverName']=$NameForm;
						
						} else {
							  			
							  echo "Error de conexion ";
							  include_once "1150-Profile.php";
						}
					}
										
					if($SurForm != S_SESSION['DriverSur']){
						
						$sql = "UPDATE users SET Apellido='$SurForm' WHERE Email='".$_SESSION['usr']."'";
						if (mysqli_query($conn, $sql)) {
							$_SESSION['DriverSur']=$SurForm;
						
						} else {
							  			
							  echo "Error de conexion ";
							  include_once "1150-Profile.php";
						}
					}
					
					if($TeamForm != S_SESSION['DriverTeam']){
						
						$sql = "UPDATE users SET Equipo='$TeamForm' WHERE Email='".$_SESSION['usr']."'";
						if (mysqli_query($conn, $sql)) {
							$_SESSION['DriverTeam']=$TeamForm;
						
						} else {
							  			
							  echo "Error de conexion ";
							  include_once "1150-Profile.php";
						}
					}
					if($UserForm != S_SESSION['usr']){
						
						if($User->EmailExists($UserForm)){
							
							echo '<script>alert("El nuevo email ya está registrado")</script>';
						
						}
						else{
							$sql = "UPDATE users SET Email='$UserForm' WHERE Email='".$_SESSION['usr']."'";
							if (mysqli_query($conn, $sql)) {
								$_SESSION['usr']=$UserForm;
							
							} else {
											
								  echo "Error de conexion ";
								  include_once "1150-Profile.php";
							}
						}
					}
					
					header("Location:1150-Profile.php");
				}

			?>