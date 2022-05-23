<?php

	include_once '501-UserWork.php';
	include_once '502-UserSession.php';
	include_once '506-myDBs.php';

	$KRT= new DB_KRT();
	$usersession = new UserSession();
	$User= new User();
	
	if(isset($_SESSION['usr'])){
					
		$User->setUser($usersession->getCurrentUser());
		//echo $User->getNombre();//
		header("Location:3005-Register.php");
					
	}
	else if(isset($_POST['mail']) && isset($_POST['pass'])){
					
		//echo "Validación de sesion";//
		$UserForm=$_POST['mail'];
		$PassForm=$_POST['pass'];
		if($User->userExists($UserForm,$PassForm)){
		//echo "Usuario validado";//
						
			$usersession->setCurrentUser($UserForm);
			$User->setUser($UserForm);
					$connKRT=mysqli_connect('localhost','root','','krt_users');
					$mystrKRT="SELECT * FROM users WHERE Email = '".$_SESSION['usr']."'";
					$query=mysqli_query($connKRT,$mystrKRT);
					while ($KRTUser= mysqli_fetch_array ($query)){
											
						$_SESSION['DriverKey']=$KRTUser['DriverKey'];
						$_SESSION['Nombre']=$KRTUser['Nombre'];
						$_SESSION['Apellido']=$KRTUser['Apellido'];

					}
					mysqli_close($connKRT);
			header("Location:3005-Register.php");
						
						
		}
		else {
			//echo "Error de validación;//
			$ErrorLogin="Email y/o Contraseña incorrectos";
			include_once "1105-LoginReg.php";
		}
						
	}
		else {
					
			header("Location: 1105-LoginReg.php");
					
		}
?>