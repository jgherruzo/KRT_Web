<?php
	session_start();
	//empieza por ver si es campeonato actual o siguiente
	$AñoActual=date("Y");
	$Diciembre= strtotime("01-12-".$AñoActual." 10:00:00");
	if($FechaActual > $Diciembre){
		//inscibirme en el proximo campeonato
		$AñoActual=date("Y")+1;
	}
	//Si he llegado aquí, la db exite asi que me ahorro comprobar
	$conn=mysqli_connect('localhost','root','',$AñoActual);

	//Compruebo el siguiente GP
						
	$strCalendar="SELECT * FROM calendario";
	$Calendarquery=mysqli_query($conn,$strCalendar);
	$Hoy=date("d-m-Y");
	$Bandera="No";
	$NextGP=0;

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
										
	//Primero miramos si está inscrito en el campeonato o no
	$mystr="SELECT * FROM inscritos WHERE DriverKey = '".$_SESSION['DriverKey']."'";
	$query=mysqli_query($conn,$mystr);

	if (mysqli_num_rows($query)>0){
		//está inscrito, comprobamos el calendario del campeonato
		while ($Driver= mysqli_fetch_array ($query)){
			//Miramos el número
			$DriverNumber=$Driver['Num'];
		}										
		//Lo inscribimos en el GP
		$GPstr="INSERT INTO GP".$NumberGP." (Num) VALUES ('$DriverNumber')";
		$myquery=mysqli_query($conn,$GPstr);
		
	}else{
		//Hay que inscribirlo como invitado
		$mystr="SELECT * FROM inscritos";
		$query=mysqli_query($conn,$mystr);
		$MyNewNumber=0;
		if (mysqli_num_rows($query)>0){
				
			while ($DriverData= mysqli_fetch_array ($query)){
					
				if($DriverData['Num']>$MyNewNumber){
					$MyNewNumber=$DriverData['Num'];	
				}
			}				
		}
		//Si no hay ningún invitado le pongo el 1001
		If($MyNewNumber<1000){
			$MyNewNumber=1001;
		}else{
			//Si ya hay alguno, le doy el siguiente
			$MyNewNumber=$MyNewNumber+1;
		}
		$MiNombre=$_SESSION['Nombre'];
		$MiApellido=$_SESSION['Apellido'];
		$MiKey=$_SESSION['DriverKey'];
		$sql = "INSERT INTO inscritos (Num, Nombre, Apellido, DriverKey) VALUES ('$MyNewNumber', '$MiNombre', '$MiApellido','$MiKey')";
		$myquery=mysqli_query($conn,$sql);
		
		//y ahora lo inscribo en el GP
		$GPstr="INSERT INTO GP".$NumberGP." (Num) VALUES ('$MyNewNumber')";
		$myquery=mysqli_query($conn,$GPstr);
	}

	mysqli_close($conn);
	
	//include_once "3005-Register.php";
	header("Location: 3005-Register.php");
?>