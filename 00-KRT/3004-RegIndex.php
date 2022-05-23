<?php

session_start();
				
if(isset($_SESSION['usr'])){
	
	header("Location:3005-Register.php");
	
}else{
	
	header("Location: 1105-LoginReg.php");
	
}
?>