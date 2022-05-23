<?php

$db=$_POST['str_camp'];
$table=$_POST['str_cla'];
	
	$conn=mysqli_connect('localhost','root','',$db);

	$sql="SELECT * FROM ".$table;
	$result=mysqli_query($conn,$sql);

	$i=0;
		include_once '506-myDBs.php';
		$KRT= new DB_KRT();
		$KRTconn=$KRT->setKRTConnection();
		
	while ($CLA= mysqli_fetch_array ($result)){

		$mystr="SELECT Nombre, Apellido, DriverKey FROM inscritos WHERE Num = ".$CLA['Num']."";
		
		$query=mysqli_query($conn,$mystr);
		while ($DriverData= mysqli_fetch_array ($query)){
			$Posicion[$i]=$CLA['Posicion'];
			$Numero[$i]="#".$CLA['Num'];
			$Piloto[$i]=$DriverData['Nombre']." ".$DriverData['Apellido'];
			$Puntos[$i]=$CLA['Puntos'];

			$columnName = 'Cat';
			
			$Colstr="SHOW COLUMNS FROM inscritos WHERE Field = '$columnName'";
			$Colquery=mysqli_query($conn,$Colstr);

			if (mysqli_num_rows($Colquery)===0) {
				$Categoria[$i]="CLUB";
			}else{
				$Categoria[$i]=$CLA['Cat'];
			}
			
			if(strlen($DriverData['DriverKey'])<2){
				
				$Casco[$i]="8000-Casco.png";
				
			}else{
				
			$KRTsql = "SELECT Id FROM users WHERE DriverKey = '".$DriverData['DriverKey']."'";
			
						if (!$resultado = $KRTconn->query($KRTsql)) {
						echo "Lo sentimos, este sitio web está experimentando problemas.";

						// De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
						// cómo obtener información del error
						echo "Error: La ejecución de la consulta falló debido a: \n";
						echo "Query: " . $KRTsql . "\n";
						echo "Errno: " . $KRTconn->errno . "\n";
						echo "Error: " . $KRTconn->error . "\n";

						}
				$CampoId= $resultado->fetch_assoc();
				$Number=8000+intval($CampoId['Id']);
				$Casco[$i]=$Number."-Casco.png";
			}
			$i=$i+1;
		}
	}

	mysqli_close($conn);
	mysqli_close($KRTconn);
	$long=count($Posicion);

	$Position=1;
	//Recorre todo el rango
	for ($j=0;$j<$long;$j++){
		
		//Busca la menor posicion
		for ($k=0;$k<$long;$k++){
			if ($Posicion[$k]==$Position){
				$Pointer=$k;
			}
		}
		///echo "<script>alert('j=".$j." puntero=".$Pointer."');</script>";
		$myPointer[$j]=$Pointer;
		$Position=$Position+1;
	}
	for ($j=0;$j<$long;$j++){
		
		if ($j==0){
			$cadena="<tr><td>".$Posicion[$myPointer[$j]]."</td>
						<td><img src='8000-Driver_Pictures/".$Casco[$myPointer[$j]]."' class='Pic-Casco'></td>
						<td>".$Numero[$myPointer[$j]]."</td>
						<td>".utf8_encode($Piloto[$myPointer[$j]])."</td>
						<td>".$Puntos[$myPointer[$j]]."</td></tr>";
		}else{
			$cadena=$cadena."<tr><td>".$Posicion[$myPointer[$j]]."</td>
						<td><img src='8000-Driver_Pictures/".$Casco[$myPointer[$j]]."' class='Pic-Casco'></td>
						<td>".$Numero[$myPointer[$j]]."</td>
						<td>".utf8_encode($Piloto[$myPointer[$j]])."</td>
						<td>".$Puntos[$myPointer[$j]]."</td></tr>";
		}
	}

echo $cadena;
?>