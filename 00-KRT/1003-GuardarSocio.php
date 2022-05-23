<?php

	include_once '506-myDBs.php';
				
	$KRT= new DB_KRT();
					
	$sNombre=utf8_decode($_POST['Nombre']);
	$sApellido1=utf8_decode($_POST['Apellido1']);
	$sApellido2=utf8_decode($_POST['Apellido2']);
	$sId=$_POST['id'];				
	$conn=$KRT->setKRTConnection();
							
	$sql = "INSERT INTO socios (IdSocio, Nombre, Apellido1, Apellido2, Estado) VALUES ('$sId','$sNombre','$sApellido1','$sApellido2','Alta')";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
					
	header("Location:1001-WebManager.php");

?>