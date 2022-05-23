<?php
	
	include_once '506-myDBs.php';
				
	$KRT= new DB_KRT();
					
	$sClave=$_GET['Clave'];
	$sSocio=$_GET['Socio'];

	$conn=$KRT->setKRTConnection();
		
	$miString = "UPDATE socios SET DriverKey='$sClave' WHERE IdSocio=".$sSocio."";

	mysqli_query($conn, $miString);
	mysqli_close($conn);
				
	header("Location:1007-Link_Socio.php");

?>