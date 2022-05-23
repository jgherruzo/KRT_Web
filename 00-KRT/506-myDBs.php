<?php

class DB_KRT{

    public function setKRTConnection(){
    
	    $host     = 'localhost';
        $db       = 'krt_users';
        $user     = 'root';
        $password = "";
        $charset  = 'utf8';
		$conn = mysqli_connect($host, $user, $password, $db);
						// Check connection
						if (!$conn) {
							  die("Connection failed: " . mysqli_connect_error());
						}
						
						return $conn;
    }

}
?>