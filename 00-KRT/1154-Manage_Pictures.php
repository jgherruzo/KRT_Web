<?php

if (isset($_SESSION['DriverId'])) {
}
else{
session_start();
}
$MiNumero=8000+intval($_SESSION['DriverId']);
$extensiones = array(0=>'image/jpg', 1=>'image/jpeg');
$max_tamanyo = 1024 * 1024 * 8;

if (!isset($_FILES["ImgBody2"]) ||  $_FILES["ImgBody2"]["error"] > 0){
            //echo "<script type='text/javascript'>alert('Ha ocurrido un error. Inténtelo de nuevo...');</script>";
            //echo "Ha ocurrido un error. Inténtelo de nuevo...";
			echo $_FILES["ImgBody2"]["error"];
			include_once "1150-Profile.php";
}else{
	//echo "<script>alert('".$_FILES["ImgBody2"]['type']."');</script>";		
	if ( in_array($_FILES["ImgBody2"]['type'], $extensiones) ) {
		
		//echo "<script>alert('Es jpg la primera');</script>";
		 
			 if ( $_FILES['ImgBody2']['size']< $max_tamanyo ) {
					  
					$ruta_indexphp = dirname(realpath(__FILE__));
					$ruta_fichero_origen = $_FILES['ImgBody2']['tmp_name'];
					
					$ruta_nuevo_destino = $ruta_indexphp . '/8000-Driver_Pictures/' .$MiNumero.'-Body.jpg';
					if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
						include_once "1150-Profile.php";
					}
			}else{
			echo "La imagen del cuerpo es demasiado pesada";
			include_once "1150-Profile.php";
			}
	}else{
	echo "La imagen no cumple los requisitos de formato";
	include_once "1150-Profile.php";
	}
}
?>