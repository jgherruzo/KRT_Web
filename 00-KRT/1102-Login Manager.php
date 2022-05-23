<?php

	include_once '501-UserWork.php';
	include_once '502-UserSession.php';
	include_once '506-myDBs.php';

	$KRT= new DB_KRT();
	$usersession = new UserSession();
	$User= new User();
	
	$conn=$KRT->setKRTConnection();
	
	if(isset($_SESSION['usr'])){
			
			$myTemp=$_SESSION['usr'];
			$sql="SELECT Estado FROM users WHERE Email = '$myTemp'";
			$resultado=mysqli_query($conn,$sql);
			
			while($myRows=mysqli_fetch_assoc($resultado)){
				if($myRows['Estado']==1){
						
					$User->setUser($usersession->getCurrentUser());
					//echo $User->getNombre();//
					header("Location:1000-Index.php");
				
				}else{
					
					$ErrorLogin="Email no verificado";
					include_once "1100-Login.php";
				}
			}
					
	}
	else if(isset($_POST['mail']) && isset($_POST['pass'])){
					
		//echo "Validación de sesion";//
		$UserForm=$_POST['mail'];
		$PassForm=$_POST['pass'];
		if($User->userExists($UserForm,$PassForm)){
		//echo "Usuario validado";//
			
			$sql="SELECT Estado FROM users WHERE Email = '$UserForm'";
			$resultado=mysqli_query($conn,$sql);
			while($myRows=mysqli_fetch_assoc($resultado)){
				if($myRows['Estado']==1){
			
					$usersession->setCurrentUser($UserForm);
					$User->setUser($UserForm);
						
					header("Location:1000-Index.php");
				
				}else{
					
					$ErrorLogin="Email no verificado";
					include_once "1100-Login.php";
				}
				
			}
			
		}
		else {
			//echo "Error de validación;//
			$ErrorLogin="Email y/o Contraseña incorrectos";
			include_once "1100-Login.php";
		}
						
	}
		else {
					
			header("Location: 1100-Login.php");
					
		}
?>