<?php

//echo "<script>alert('hola');</script>";

$db=$_POST['campeonato'];

$cadena='<option value="0">Selecciona una clasificación</option>';
		
if ($db == 0) {
	
}else{

	$conn=mysqli_connect('localhost','root','',$db);
	$sql="SHOW TABLES";
	$result=mysqli_query($conn,$sql);
			
	$i=1;
	while($row=mysqli_fetch_row($result)){
		$table=$row[0];
		
		if ($table=="inscritos"){
			
		}else{
		if ($table=="calendario"){
			}else{
				$str="SELECT * FROM ".$table;
				$myquery=mysqli_query($conn,$str);
				
				if (mysqli_num_rows($myquery)===0) {
				}else{
					$cadena=$cadena.'<option value="'.$table.'">'.$table.'</option>';
				}
			}
		}
	}
}
mysqli_close($conn);
echo $cadena;
?>