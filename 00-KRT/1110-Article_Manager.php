			<?php
				
				$base_url="http://localhost/00-KRT/";
				//	Primero comprobamos que el email no existe //			
				if(isset($_GET['varId'])){
					
					$MiCode=$_GET['varId'];
					$MiKey=$_GET['Var2'];

					//aqui busco el tipo de web y le paso el id otra vez en la url, en el tipo de web ya busco y descargo

					include_once '506-myDBs.php';
					$KRT= new DB_KRT();
					$conn=$KRT->setKRTConnection();
					if ($MiKey==1){
						$sql="SELECT Tipo FROM camp_news WHERE id='$MiCode'";
					}elseif ($MiKey==2){
						$sql="SELECT Tipo FROM team_news WHERE id='$MiCode'";
					}
					if (!$resultado = $conn->query($sql)) {
						echo "Lo sentimos, este sitio web está experimentando problemas.";
					}

					while ($Puntero1 = $resultado->fetch_assoc()) {
						$MiTipo=$Puntero1['Tipo'];
						if($MiTipo==0){
							header("Location:3012-Article_0.php?VarId=".$MiCode."&Var2=".$MiKey."");	
						}elseif($MiTipo==1){
							header("Location:3013-Article_1.php?VarId=".$MiCode."&Var2=".$MiKey."");
						}
					}					
				}else{
					header("Location:1000-Index.php");					
				}

			?>