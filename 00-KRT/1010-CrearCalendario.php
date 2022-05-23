<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 1.0" />
		
		<title>Web Master</title>
	</head>
	<body>
		<h1>Alta de nuevo Campeonato</h1>
		<div id="Core">	
			<form action="1011-CrearCampeonato.php" name="NuevoCampeonato" method="POST">
					<fieldset id="Pictures"><legend for="Pictures">Calendario</legend>
					<?php
						$GPs=$_POST['Calendario'];
						$MiAño=$_POST['Camp'];
						$Limite=1+$GPs;
						$contador=1;
						$Str="";
						$Str=$Str.'<label for="Camp">Año</label>';
						$Str=$Str.'<input type="text" name="Camp" id="Camp" value="'.ucwords($MiAño).'" required></input>';
						$Str=$Str.'<label for="Calendario">Nº de GPs:</label>';
						$Str=$Str.'<input type="text" name="Calendario" id="Calendario" value="'.ucwords($GPs).'" required></input>';
						while ($contador<$Limite) {
							
							$Str=$Str.'<label for="GP'.$contador.'">GP'.$contador.'</label>';
							$Str=$Str.'<input type="date" name="GP'.$contador.'" id="GP'.$contador.'" required></input>';
							$contador=$contador+1;
						}
						echo $Str;
					?>
					<input type="submit" value="Crear"></input>
					</fieldset>
				</form>
		</div>
		<a href="1009-Nuevo_Campeonato.php">Volver</a>
	</body>
</html>