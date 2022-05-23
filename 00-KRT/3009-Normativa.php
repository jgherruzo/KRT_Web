<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="generator" content="Notepad++" />
		<meta name="author" content="José García Herruzo" />
		<meta name="keywords" content="KRT, Club, amateur, Karting" />
		<meta name="description" content="Rincón para amantes de la velocidad" />
		<meta name="version" content="Versión 0" />
		
		<script type="text/javascript" src="001-KRT_General.js"></script>
		
		<link href="3009-Normativa.css" rel="stylesheet" type="text/css" />
		<link href="201-Menu.css" rel="stylesheet" type="text/css" />
		<link href="200-Partner.css" rel="stylesheet" type="text/css" />
		<link href="202-Header.css" rel="stylesheet" type="text/css" />
		<link href="203-Body.css" rel="stylesheet" type="text/css" />
		
		<title>KRT Championship | Normativa</title>
	</head>
	<body>
		<script>BackGroundPicture()</script>
		<div id="myHeader">
			<div id="Login">
			<?php
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado			
				session_start();
				
				if(isset($_SESSION['usr'])){
					echo '<a href="1150-Profile.php">Perfil de piloto</a>';
				}
				else{
					echo '<a href="1100-Login.php">Iniciar Sesión</a>';
				}
			
			?>
			</div>
		</div>
		<Div id="Menu">
			<script>BuildMenu()</script>
		</Div>
		
		<div id="dvCore">
			<div id="dvNorma">
				<h1>Normativa KRT Rental Kart Series</h1>
				<div id="dvIndex">
					<h2 id="tittleIndex">Índice</h2>
					<ul class="myDocs">
						<li><a href="#P1">Descripción</a></li>
						<li><a href="#P2">Formato</a></li>
						<li><a href="#P3">Calendario</a></li>
						<li><a href="#P4">Puntuación</a></li>
						<li><a href="#P5">Comportamiento en Pista</a></li>
						<li><a href="#P6">Sanciones</a></li>
						<li><a href="#P7">Inscripción</a></li>
					</ul>
				</div>
				<div id="dvt1">
					<h3 class="hNorma"><a name="P1">Descripción</a><h3>
					<p>KRT Championship es un campeonato de karts de alquiler para aficionados al deporte de motor, organizado por el Club Deportivo KRT Motorsport.
						 Se trata de una competición donde prima la deportividad y el compañerismo frente a la competitividad.</br></br>
						El campeonato está formado por seis carreras individuales que tendrán lugar cada dos meses aproximadamente.</p>
						
					<h3 class="hNorma"><a name="P2">Formato</a><h3>
					<p>Cada gran premio constará de 45 minutos repartidos en tres tandas de 15 minutos</br></br>
					El orden de salida de la primera tanda se decidirá mediante clasificación a una vuelta. Para el resto de tandas, se invertirá
					el orden de la mitad mejor clasificada, manteniendo el orden del resto de pilotos. Por ejemplo, para una carrera de 10 pilotos,
					el orden de la segunda tanda sería 5 - 4 - 3 - 2 - 1 - 6 - 7 - 8 - 9 - 10.</br></br>
					Se realizará un sorteo de kart inicial, otro para la segunda tanda y otro para la tercera tanda.</br></br>
					El peso mínimo será de 85kg por piloto, de forma que aquellos participantes de menor peso deberán lastrar sus karts hasta 85kg.</br></br>
					El sentido de cada tanda y clasificación se comunicará durante el briefing de cada GP. Durante el campeonato, se disputarán
					los mismos kilómetros en ambos sentidos.</br></br>
					No existirá límite de pilotos inscritos salvo como sigue a continuación. Para cada Gran Premio, existirá un número mínimo de pilotos
					de 20 y un máximo de 30 participantes por serie. Siguiendo esta tabla:</p>

					<table class="tblPuntos">
						<tr><th>Pilotos</th><th>Series</th></tr>
						<tr><td>menos de 30</td><td>1</td></tr>
						<tr><td>40-50</td><td>2</td></tr>
						<tr><td>60-70</td><td>3</td></tr>
					</table>
					
					<p>Como podrá verse, existe un vacio entre 30 y 40 o 50 y 60. Esto quiere decir que sólo se admitirán más de 30 pilotos si se 
					consigue un mínimo de 40</p>
					<p><i>Creación de series</i></br></br></p>
					<p>En caso de necesitar más de una serie por tanda, las series se crearan siguiendo las siguientes normas.</br></br>
					- Serie 1 de superpole seguirá el orden en base al tipo de inscripción: Piloto invitado/Inscrito/Socios.</br></br>
					- Serie 1 de tanda 1 formada por la mitad de parrilla peor clasificada en la superpole.
					- Serie 1 de tanda 2 formada a partir de la mitad de parrilla peor clasificada de ambas series durante la tanda 1.</br></br>
					- Serie 1 de tanda 3 formada a partir de la mitad de parrilla peor clasificada de ambas series durante la tanda 2.</br></br>
					</p>
					<h3 class="hNorma"><a name="P3">Calendario</a><h3>
					<table class="tblPuntos">
						<tr><th>Prueba</th><th>Fecha</th></tr>
					<?php
					
						//empieza por ver si es campeonato actual o siguiente
						
						$AñoActual=date("Y");
						$Diciembre= strtotime("01-12-".$AñoActual." 10:00:00");
						$FechaActual=strtotime(date("d-m-Y H:i:00",time()));
						
						if($FechaActual > $Diciembre){
							//inscibirme en el proximo campeonato
							$AñoActual=date("Y")+1;
						}
						
						//Ahora compruebo que la base de datos existe
						$conn=mysqli_connect('localhost','root','',$AñoActual);
						if (!$conn) {
							die("Aún no se ha creado este campeonato");
						}
						//Compruebo los GP
						
						$strCalendar="SELECT * FROM calendario";
						$Calendarquery=mysqli_query($conn,$strCalendar);
						if (mysqli_num_rows($Calendarquery)>0){
								while ($Prueba= mysqli_fetch_array ($Calendarquery)){
									echo "<tr><td>GP".$Prueba['GP']."</td><td>".$Prueba['Fecha']."</td></tr>";									
								}
						}
					?>
					</table>
					<h3 class="hNorma"><a name="P4">Puntuación</a><h3>
					<p>Clasificación</br></p>
					<table class="tblPuntos">
						<tr><th>Puesto</th><th>Puntos</th></tr>
						<tr><td>1</td><td>15</td></tr>
						<tr><td>2</td><td>13</td></tr>
						<tr><td>3</td><td>11</td></tr>
						<tr><td>4</td><td>8</td></tr>
						<tr><td>5</td><td>5</td></tr>
						<tr><td>6</td><td>3</td></tr>
						<tr><td>7</td><td>2</td></tr>
						<tr><td>8</td><td>1</td></tr>
					</table>
					<p>Tanda</br></p>
					<table class="tblPuntos">
						<tr><th>Puesto</th><th>Puntos</th></tr>
						<tr><td>1</td><td>65</td></tr>
						<tr><td>2</td><td>58</td></tr>
						<tr><td>3</td><td>53</td></tr>
						<tr><td>4</td><td>50</td></tr>
						<tr><td>5</td><td>47</td></tr>
						<tr><td>6</td><td>40</td></tr>
						<tr><td>7</td><td>36</td></tr>
						<tr><td>8</td><td>32</td></tr>
						<tr><td>9</td><td>29</td></tr>
						<tr><td>10</td><td>26</td></tr>
						<tr><td>11</td><td>23</td></tr>
						<tr><td>12</td><td>21</td></tr>
						<tr><td>13</td><td>19</td></tr>
						<tr><td>14</td><td>17</td></tr>
						<tr><td>15</td><td>15</td></tr>
						<tr><td>16</td><td>14</td></tr>
						<tr><td>17</td><td>13</td></tr>
						<tr><td>18</td><td>12</td></tr>
						<tr><td>19</td><td>11</td></tr>
						<tr><td>20</td><td>10</td></tr>
						<tr><td>21</td><td>9</td></tr>
						<tr><td>22</td><td>8</td></tr>
						<tr><td>23</td><td>7</td></tr>
						<tr><td>24</td><td>6</td></tr>
						<tr><td>25</td><td>5</td></tr>
						<tr><td>26</td><td>4</td></tr>
						<tr><td>27</td><td>3</td></tr>
						<tr><td>28</td><td>2</td></tr>
						<tr><td>29</td><td>1</td></tr>
					</table>
					<p>Adicionalmente se otorgarán 5 puntos a la vuelta rápida de cada tanda.</br></p>
					
					<h3 class="hNorma"><a name="P5">Comportamiento en Pista</a><h3>
					<p><i>Lastre</i></br></br></p>
					<p>La organización realizará un pesaje previo a la clasficiación, otorgando una pulsera con el peso.
					El uso del lastre será responsabilidad de cada piloto, usando las pesas necesarias y retirandolas del kart tras cada tanda.
					Si algún miembro de la organización detecta que un piloto usa lastre de menos, podrá considerarse como sanción grave.</br></br></p>
					<p><i>Adelantarse en la salida</i></br></br></p>
					<p>Queda prohibido adelantarse en la salida antes del banderazo o antes de que el semáforo indique el comienzo de la carrera.
					Tampoco se puede avanzar levemente y pararse justo antes de la salida.</br></br>
					Todos los karts deben estar colocados en sus posiciones en parrilla, estando la rueda delantera en la línea sobre el asfalto. 
					De no existir dicha línea, cada piloto se colocará alineando la parte trasera del kart que esté delante (posición impar), con 
					la parte delantera del que esté por detrás (posición par) y viceversa, dejando la distancia de un kart entre unos y otros
					completando toda la parrilla.</br></br>
					En el momento que se avisa a todos los pilotos que el proceso de salida dará comienzo, todos los karts deben permanecer 
					inmóviles en sus posiciones. Será responsabilidad de cada piloto mantener el kart inmóvil en su posición hasta que dé
					comienzo la salida.</br></br>
					Si es con bandera, la salida comienza en el momento que la bandera empieza a bajar. Si es con semáforo, la salida comienza 
					cuando se enciende la luz verde o cuando se apaguen las luces rojas, dependiendo del sistema utilizado en cada circuito.</br></br>
					Adelantarse en la salida tendrá una sanción media, pero en caso de avanzar y parar antes del comienzo se considerará una
					sanción leve.</br></br></p>
					<p><i>Salidas de pista</i></br></br></p>
					<p>Para poder realizar un adelantamiento, será necesario tener como mínimo el espacio total del ancho del kart y no se podrá
					alterar la trayectoria del piloto que va delante. No se podrá adelantar aprovechando el exterior de la pista (incluido piano
					cuando la rueda interior sobrepase el piano), salvo que, por motivos de seguridad o montonera posterior a una salida, haya 
					que cambiar la trayectoria.</br></br>
					No tendrá carácter de sanción los adelantamientos en los cuales se haya ganado claramente el interior antes de la entrada en
					curva. Se considerará "ganado" el interior cuando la parte delantera del kart que intenta adelantar alcance la mitad del kart
					que va primero). Una vez perdido el interior el piloto que marche por el exterior debe permitir que se le adelante limpiamente.</br></br> 
					Es importante que el piloto que va a realizar el adelantamiento comience a trazar la curva con el interior ganado, en caso
					contrario deberá ceder el paso siempre que el piloto delantero intente tomar el interior.</br></br>
					El comité decidirá que adelantamientos podrán ser objeto de sanción, entre falta leve, media o grave en función de lo sucedido.</br></br></p>
					<p><i>Cambios de sentido</i></br></br></p>
					<p>Queda prohibido hacer más de un cambio de trayectoria para evitar ser adelantado bloqueando a los pilotos precedentes.</br></br>
					El comité decidirá entre sanción leve o media en función de la reincidencia en la acción.</br></br></p>
					<p><i>Golpes</i></br></br></p>
					<p>Queda prohibido ganar la posición a cualquier piloto con ayuda de golpes, ya sean deliberados o no. Tampoco está permitido
					cerrar la trayectoria del piloto que haya ganado el interior. Si se demuestra cualquiera de estos supuestos, se sancionará
					según lo siguiente:</br></br>
					- Si el piloto afectado realiza un trompo, sale fuera de pista o cualquier otra consecuencia que lo deje parado, el piloto
					responsable tendrá una sanción media.</br></br>
					- Si el piloto perjudicado resultara afectado en la trazada sin necesidad de reiniciar la	marcha, saliéndose pista o no y 
					pierde su posición, el piloto responsable tendrá una sanción leve.</br></br>
					No será de aplicación esta sanción cuando el piloto responsable ceda su posición inmediatamente, bien por iniciativa propia
					o por recriminación de piloto afectado. En este caso deberá señalizarse tal acción con el brazo (haciendo señales de que pase).
					Los pilotos que lleguen detrás no podrán beneficiarse de tal acción y deberán respetar sus posiciones naturales hasta que tenga
					lugar el cambio de posición. Una vez superada la primera curva tras el incidente (o la segunda en el caso de que el incidente
					haya ocurrido muy próximo a la primera) todos los pilotos podrán atacar dichas posiciones, indiferentemente de que la cesión haya
					tenido lugar o no. Se podrá señalizar desde la grada al/los piloto/s implicado/s la obligatoriedad de ceder la posición cuando
					ésta no se haya producido.</br></br>
					Los pilotos que adelanten en esta situación tendrán una sanción leve. Sólo se permitirá a cada piloto un incidente de estas
					características por GP.</br></br>
					En caso de reincidencia, el comité sancionador podrá aplicar una sanción grave o antideportiva .</br></br></p>	
					<p><i>Doblados</i></br></br></p>
					<p>Todo piloto en disposición de ser doblado debe dejarse adelantar inmediatamente por el/los piloto/s que lleve/n vuelta ganada.
					Está maniobra se realizará lo antes posible, desplazándose a la zona contraria a la trazada lógica. Cuando los pilotos que van a 
					doblar sean más de 1, se deberá guardar el orden de adelantamiento al piloto doblado.</br></br>
					Cualquier piloto que se aproveche de tal situación será sancionado con nivel leve.</br></br>
					Si el piloto doblado entorpece el adelantamiento de algún piloto en concreto, beneficiando a algún piloto en especial, será 
					sancionado con antideportiva.</br></br></p>	

					<h3 class="hNorma"><a name="P6">Sanciones</a><h3>
					<p>El sistema de sanciones se basará en la categorización de las acciones en leve, media, grave y antideportiva.</br></br>
					• La sanción leve equivale a nivel 1 y se sancionará con 2 puestos.</br></br>
					• La sanción media equivale a nivel 2 y se sancionará con 5 puestos.</br></br>
					• La sanción grave equivale a nivel 6 y se sancionará con 10 puestos.</br></br>
					• La actitud antideportiva se sancionará con la expulsión inmediata.</br></br>
					La suma de dos acciones graves a lo largo del campeonato equivaldrá a una actitud antideportiva y será sancionada de igual forma.
					Así mismo, esto equivale a nivel 12, por lo tanto, el conjunto de acciones realizadas por un piloto que sumen este nivel, estarán 
					sancionadas de igual forma.</br></br></p>
					<p><i>Comite sancionador</i></br></br></p>
					<p>El comité sancionador estará formado por 2 miembros de la organización y 1 miembro del circuito. El comité sancionador debatirá
					sobre la acción en concreto y establecerá la resolución del caso.</br></br>
					El comité no actuará de oficio. Para que este se cree deberá haber una solicitud previa.</br></br></p>
					<p><i>Solicitud de investigación</i></br></br></p>
					<p>La solicitud se hará de forma personal a cualquier miembro de la organización y deberá aportarse video del suceso. En caso de
					no existir este, el comité evaluará el testimonio de otros pilotos que estuvieran cerca del incidente en concreto.</br></br></p>
					<h3 class="hNorma"><a name="P7">Inscripciones</a><h3>
					<p>La inscripción en el campeonato tendrá un coste de 12 euros. Para formalizar la inscripción, deberá registrarse como usuario de
					esta página e incribirse a través del formulario de inscripción que encontrará en el menú principal. Cada GP se abrirá una ventana
					de pago previo a la disputa de la prueba. El pago se realizará en efectivo en el mismo circuito a un miembro habilitado de la
					organización</br></br>
					La inscripción en cada gran premio se realizará a través del formulario de inscripción que se podrá encontrar en el menú principal. 
					El formulario de inscripción se habilitará con un mes de antelación. Cada Gran Premio tendrá un coste de 52 euros que se pagarán
					directamente en el circuito.</br></br>
					La preferencia de inscripción estará dada por el tipo de piloto y el orden de inscripción según la siguiente escala:
					Socio/Inscrito/Invitado.</br></br>
					Para Pruebas donde el número de pilotos supere los 30 y no llegue a los 40, los inscritos cuyo orden de inscripción se encuentre
					en este rango no tendrán asegurada su plaza.</br></br>
					Pilotos que se inscriban y no se presenten el día de la prueba pasarán a no tener preferencia a la hora de inscribirse.</br></br>					
					</p>
				</div>
			</div>
		</div>
		
		<div id="Partner" >
			<h3 id="myPartner"></h3>
			<script>BuildPartner()</script>
		</div>
	</body>
</html>
