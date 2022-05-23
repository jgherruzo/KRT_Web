<?php
	
	include_once '506-myDBs.php';
				
	$KRT= new DB_KRT();
					
	$sAccion=$_GET['Estado'];
	$sSocio=$_GET['Socio'];

	$conn=$KRT->setKRTConnection();
	
	if ($sAccion==0){
		
		$miString = "UPDATE socios SET Estado='Alta' WHERE IdSocio=".$sSocio."";
		//echo "<script type='text/javascript'>alert('".$miString."');</script>";
		
	}else{
		$miString = "UPDATE socios SET Estado='Baja' WHERE IdSocio=".$sSocio."";
	}
	mysqli_query($conn, $miString);
	mysqli_close($conn);
				
	header("Location:1004-Gestor_Socio.php");

?>