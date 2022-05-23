<?php
	
	$db="`".$_POST['Camp']."`";
	$db2=$_POST['Camp'];
	$GPs=$_POST['Calendario'];
	$Limite=1+$GPs;
	$contador=1;
	//echo "<script type='text/javascript'>alert('".$db."');</script>";
	//PRIMERO CREAMOS LA BASE DE DATOS//
	$host     = 'localhost';
	$user     = 'root';
	$password = "";
	$charset  = 'utf8';
	$conn = mysqli_connect($host, $user, $password);
	if (!$conn) {
		die('No pudo conectarse: ' . mysqli_connect_error());
	}
	$sql = 'CREATE DATABASE '.$db.'';
	
	if (mysqli_query($conn, $sql)) {
		//SEGUNDO CREAMOS LA TABLA DE INSCRITOS//
		$Str="CREATE TABLE inscritos (Id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,Num INT(4) NOT NULL, Nombre VARCHAR(60) NOT NULL ,Apellido VARCHAR(60) NOT NULL ,DriverKey VARCHAR(10) NOT NULL ,Pagado VARCHAR(2) NOT NULL)";
		$conn = mysqli_connect($host, $user, $password, $db2);
		// Aquí se revisa la conexión con MySQL
		if (!$conn) {
			die("la conexión ha fallado: " . mysqli_connect_error());
		}	
		if (mysqli_query($conn, $Str)) {
			//Creamos la tabla general
			$Str="CREATE TABLE general (Id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, Num INT(4) NOT NULL , Posicion INT(4) NOT NULL , Puntos INT(10) NOT NULL)";
			if (mysqli_query($conn, $Str)) {
				//Creamos la tabla de calendario
				$Str="CREATE TABLE calendario (Id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, GP INT(4) NOT NULL , Fecha DATE NOT NULL)";
				if (mysqli_query($conn, $Str)) {
					
					//Completamos el calendario
					while ($contador<$Limite) {
						$miGP="GP".$contador;
						$miFecha=$_POST[''.$miGP.''];
						$sql = "INSERT INTO calendario (GP, Fecha) VALUES ('$contador','$miFecha')";
						//echo "<script type='text/javascript'>alert('".$sql."');</script>";
						mysqli_query($conn, $sql);
						
						$Str="CREATE TABLE ".$miGP." (Id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, Num VARCHAR(4) NOT NULL , Posicion VARCHAR(4) NOT NULL , Puntos VARCHAR(5) NOT NULL , Q VARCHAR(4) NOT NULL , QP VARCHAR(4) NOT NULL , T1 VARCHAR(4) NOT NULL , T1P VARCHAR(4) NOT NULL , T1V VARCHAR(4) NOT NULL , T2 VARCHAR(4) NOT NULL , T2P VARCHAR(4) NOT NULL , T2V VARCHAR(4) NOT NULL , T3 VARCHAR(4) NOT NULL , T3P VARCHAR(4) NOT NULL , T3V VARCHAR(4) NOT NULL )";
						mysqli_query($conn, $Str);
						
						$contador=$contador+1;
					}
					include_once '506-myDBs.php';
								
					$KRT= new DB_KRT();
												
					$KRTconn=$KRT->setKRTConnection();
											
					$sql = "INSERT INTO campeonatos (Year) VALUES ('$db2')";
					mysqli_query($KRTconn, $sql);
					mysqli_close($KRTconn);
	
				} else {
					// Mostramos mensaje si hubo algún error en el proceso de creación
					echo "Error al crear la tabla: " . mysqli_error($conn);
				}					
			} else {
				// Mostramos mensaje si hubo algún error en el proceso de creación
				echo "Error al crear la tabla: " . mysqli_error($conn);
			}				
				
		} else {
			// Mostramos mensaje si hubo algún error en el proceso de creación
			echo "Error al crear la tabla: " . mysqli_error($conn);
		}
		// Cerramos la conexión
		mysqli_close($conn);		
		header("Location:1001-WebManager.php");
		
	} else {
		echo 'Error al crear la base de datos: ' . mysqli_error($conn) . "\n";
	}
	
	//header("Location:1001-WebManager.php");
?>