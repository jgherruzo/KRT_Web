<?php

	session_start();
	//Primero compruebo si es socio
	$connSocio=mysqli_connect('localhost','root','','krt_users');
	$mystrSocio="SELECT * FROM socios WHERE DriverKey = '".$_SESSION['DriverKey']."'";
	
	$querySocios=mysqli_query($connSocio,$mystrSocio);
	$EsSocio="No";
	if (mysqli_num_rows($querySocios)>0){
		$EsSocio="Si";
	}
	mysqli_close($connSocio);

	
	//luego compruebo en que campeonato inscribimos
	$AñoActual=date("Y");
	$AñoAnterior=date("Y")-1;
	$Diciembre= strtotime("01-12-".$AñoActual." 10:00:00");
	$FechaActual=strtotime(date("d-m-Y H:i:00",time()));
							
	if($FechaActual > $Diciembre){
		//inscibirme en el proximo campeonato
		$AñoAnterior=$AñoActual;
		$AñoActual=date("Y")+1;
	}
	
	
	//Ahora miro si corrio el año anterior para ver su posición y cuantos pilotos hubo
	$conn=mysqli_connect('localhost','root','',$AñoAnterior);
							
	if (!$conn) {
		die("Error al acceder a la base de datos");
	}

	$mystr="SELECT * FROM inscritos WHERE DriverKey = '".$_SESSION['DriverKey']."'";
	$MyNumber=0;
	$query=mysqli_query($conn,$mystr);
	$Inscrito="No";
	if (mysqli_num_rows($query)>0){
		
		while ($DriverData= mysqli_fetch_array ($query)){
			
			$MyNumber=$DriverData['Num'];
			$Inscrito="Si";				
		}
		
	}
	//Si esta inscrito, vemos su posicion y sino, buscamos el mayor puesto
	$MyNewNumber=0;
	if ($Inscrito=="Si"){
		$mystr="SELECT * FROM general WHERE Num = '".$MyNumber."'";
		$query=mysqli_query($conn,$mystr);
		if (mysqli_num_rows($query)>0){
			
			while ($DriverData= mysqli_fetch_array ($query)){
				
				$MyNewNumber=$DriverData['Posicion'];			
			}
			
		}
	}else{
		
		$mystr="SELECT * FROM general";
		$query=mysqli_query($conn,$mystr);
		if (mysqli_num_rows($query)>0){
			
			while ($DriverData= mysqli_fetch_array ($query)){
				
				if($DriverData['Posicion']>$MyNewNumber){
					$MyNewNumber=$DriverData['Posicion'];	
				}
			}
			//Sumamos 1 a la última posicion
			$MyNewNumber=$MyNewNumber+1;
		}
		mysqli_close($conn);
		
		//Ahora miro si hay ya algún inscrito que no corriera el año anterior
		//Para ello compruebo si el número actual es superior al anterior
		$conn=mysqli_connect('localhost','root','',$AñoActual);
		$mystr="SELECT * FROM inscritos";
		$query=mysqli_query($conn,$mystr);
		if (mysqli_num_rows($query)>0){
				
			while ($DriverData= mysqli_fetch_array ($query)){
					
				if($DriverData['Num']>$MyNewNumber){
					$MyNewNumber=$DriverData['Num'];	
				}
			}
			
			$MyNewNumber=$MyNewNumber+1;
				
		}
		mysqli_close($conn);
	}
	$conn=mysqli_connect('localhost','root','',$AñoActual);
	//si es socio lo inscribo como pagado
	$MiNombre=$_SESSION['Nombre'];
	$MiApellido=$_SESSION['Apellido'];
	$MiKey=$_SESSION['DriverKey'];
	if($EsSocio=="Si"){
		$sql = "INSERT INTO inscritos (Num, Nombre, Apellido, DriverKey, Pagado) VALUES ('$MyNewNumber', '$MiNombre', '$MiApellido','$MiKey','X')";
	}else{
		$sql = "INSERT INTO inscritos (Num, Nombre, Apellido, DriverKey) VALUES ('$MyNewNumber', '$MiNombre', '$MiApellido','$MiKey')";
	}

	$myquery=mysqli_query($conn,$sql);
	mysqli_close($conn);
	
	//include_once "3005-Register.php";
	header("Location: 3005-Register.php");

?>