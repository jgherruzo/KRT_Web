<?php

$db=$_POST['str_camp'];
$table=$_POST['str_cla'];
		
$conn=mysqli_connect('localhost','root','',$db);

$sql="SELECT Num FROM ".$table. " WHERE Posicion='1'";
$result=mysqli_query($conn,$sql);
$Numero=mysqli_fetch_assoc($result);

$mystr="SELECT DriverKey FROM inscritos WHERE Num = ".$Numero['Num']."";
$query=mysqli_query($conn,$mystr);

$DriverData= mysqli_fetch_array ($query);

include_once '506-myDBs.php';
$KRT= new DB_KRT();
$KRTconn=$KRT->setKRTConnection();
	
		
		if(strlen($DriverData['DriverKey'])<2){
			
			$Pic="8000-Body.jpg";
			
		}else{
			
		$KRTsql = "SELECT Id FROM users WHERE DriverKey = '".$DriverData['DriverKey']."'";
		$resultado=mysqli_query($KRTconn,$KRTsql);

		$CampoId= mysqli_fetch_assoc($resultado);
		$Number=8000+intval($CampoId['Id']);
		$Pic=$Number."-Body.jpg";
		}
mysqli_close($conn);
mysqli_close($KRTconn);

echo $Pic;
?>