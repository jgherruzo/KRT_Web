function BuildPartner(){
	
	var myStr="";
	myStr +="<h3>Patrocinadores:</h3>";
	
	myStr +='<a href="https://www.kartingsevilla.com">';
	myStr +='<img src = "9900-Patrocinador.png" class="Part">';
	myStr +='</a>';
	
	myStr +='<a href="https://www.instagram.com/gonzalodebenito">';
	myStr +='<img src = "9901-Patrocinador.jpg" class="Part">';
	myStr +='</a>';
	
	myStr +='<a href="https://www.sparco-official.com">';
	myStr +='<img src = "9902-Patrocinador.png" class="Part">';
	myStr +='</a>';
	
	document.getElementById("Partner").innerHTML= myStr;

}

function BuildMenu(){
		
	var myMenu="";
	
	myMenu +='<ul class="ca-menu">';
	
	// MENU C.D. KRT MOTORSPORT	//
		myMenu +='<li>';
		myMenu +='<a href="">';
		myMenu +='<div class="Menu">';
		myMenu +='<h2 class="ca-main">C.D. KRT</h2>';
		myMenu +='<h3 class="ca-sub">Motorsport</h3>';
		myMenu +='</div>';
		myMenu +='</a>';
		
			myMenu +='<div class="Submenu">';
			myMenu +='<ul class="Sub-menu">';
			
				myMenu +='<li>';
				myMenu +='<a href="2000-Club_Index.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">El Club</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
			
				myMenu +='<li>';
				myMenu +='<a href="2001-Socios.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Socios / documentos</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';

				myMenu +='<li>';
				myMenu +='<a href="2002-Ventajas.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Hazte socio</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';

				myMenu +='<li>';
				myMenu +='<a href="2003-Patrocinador.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Hazte patrocinador</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
			
			myMenu +='</ul>';
			myMenu +='</Div>';

		myMenu +='</li>';
		
	// MENU C.D. KRT MOTORSPORT	//
		myMenu +='<li>';
		myMenu +='<a href="">';
		myMenu +='<div class="Menu">';
		myMenu +='<h2 class="ca-main">KRT</h2>';
		myMenu +='<h3 class="ca-sub">Rental Kart Series</h3>';
		myMenu +='</div>';
		myMenu +='</a>';
		
			myMenu +='<div class="Submenu">';
			myMenu +='<ul class="Sub-menu">';
			
				myMenu +='<li>';
				myMenu +='<a href="3011-Champ_News.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Actualidad</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
			
				myMenu +='<li>';
				myMenu +='<a href="3009-Normativa.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Normativa</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';

				myMenu +='<li>';
				myMenu +='<a href="3004-RegIndex.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Inscripciones</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
				
				myMenu +='<li>';
				myMenu +='<a href="3000-Clasificacion.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Clasificación</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';

				myMenu +='<li>';
				myMenu +='<a href="3010-Participantes.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Participantes</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
			
			myMenu +='</ul>';
			myMenu +='</Div>';

		myMenu +='</li>';

	// MENU VIRTUAL KRT MANAGER	//
		myMenu +='<li>';
		myMenu +='<a href="">';
		myMenu +='<div class="Menu">';
		myMenu +='<h2 class="ca-main">Virtual KRT</h2>';
		myMenu +='<h3 class="ca-sub">Manager</h3>';
		myMenu +='</div>';
		myMenu +='</a>';
		
			myMenu +='<div class="Submenu">';
			myMenu +='<ul class="Sub-menu">';
			
				myMenu +='<li>';
				myMenu +='<a href="4000-Virtual_Index.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">¿Qué es?</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
			
				myMenu +='<li>';
				myMenu +='<a href="4000-Virtual_Index.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Normativa</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';

				myMenu +='<li>';
				myMenu +='<a href="4000-Virtual_Index.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">Clasificación</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
			
			myMenu +='</ul>';
			myMenu +='</Div>';

		myMenu +='</li>';

	// MENU KRT TEAM	//
		myMenu +='<li>';
		myMenu +='<a href="">';
		myMenu +='<div class="Menu">';
		myMenu +='<h2 class="ca-main">KRT</h2>';
		myMenu +='<h3 class="ca-sub">Team</h3>';
		myMenu +='</div>';
		myMenu +='</a>';
		
			myMenu +='<div class="Submenu">';
			myMenu +='<ul class="Sub-menu">';
			
				myMenu +='<li>';
				myMenu +='<a href="5001-Team_News.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">KarTEAM</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';

				myMenu +='<li>';
				myMenu +='<a href="4000-Virtual_Index.php">';
				myMenu +='<div class="submenu-Index">';
				myMenu +='<h4 class="su-main">KRT eTEAM</h4>';
				myMenu +='</div>';
				myMenu +='</a>';
				myMenu +='</li>';
				
			myMenu +='</ul>';
			myMenu +='</Div>';

		myMenu +='</li>';	

	myMenu +='</ul>';		
		
	document.getElementById("Menu").innerHTML= myMenu;

}

function BackGroundPicture(){
	
	var a=9000;
	var b=9002;
	
	var value=Math.round(Math.random()*(b-a)+parseInt(a));
	
	var txt= "url("+value+"-Fondo.jpg)"
	
	document.body.style.backgroundImage=txt;
		
}

var ValidaLogin = function() {

   var form = document.getElementById("LoginForm");
   
   var emailRegex = /^[\w]+@{1}[\w]+\.[a-z]{2,3}$/;
   
   if (!form.mail.value.match(emailRegex)) {
	   
	   alert("Formato de email no valido")
	   
      return false;
   }
   
   var passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
   if (!form.pass.value.match(passRegex)) {
	   
	   alert("Formato de contraseña no valida")
	   
      return false;
   }
   return true;
}

var ValidaRegistro = function() {
	
   var form = document.getElementById("RegisterForm");
   
   var NombreRegex = /^[\w\.\-\s]+$/;
   if (!form.Nombre.value.match(NombreRegex)) {
	   
	   alert("Formato de nombre no valido")
	   
      return false;
   }
   if (!form.Apellido1.value.match(NombreRegex)) {
	   
	   alert("Formato de primer apellido no valido")
	   
      return false;
   }
   
   /* Comprueba email*/
   var emailRegex = /^[\w]+@{1}[\w]+\.[a-z]{2,3}$/;
   if (!form.Email.value.match(emailRegex)) {
	   
	   alert("Formato de email no valido")
	   
      return false;
   }
   
   /* Comprueba contraseña*/
   var passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
   if (!form.Password.value.match(passRegex)) {
	   
	   alert("Formato de contraseña no valida")
	   
      return false;
   }
	
	var pass1=form.Password.value;
	var pass2=form.Password2.value;
	
	/* Comprueba QUER la contraseña sea igual*/
   if (pass1 != pass2) {
	  
	  alert("La contraseña es diferente")
	   
      return false;
   }
   
   return true;
}

var ValidaCambioPass = function() {
	
   var form = document.getElementById("PassForm");
   
   
   /* Comprueba email*/
   var emailRegex = /^[\w]+@{1}[\w]+\.[a-z]{2,3}$/;
   if (!form.mail.value.match(emailRegex)) {
	   
	   alert("Formato de email no valido")
	   
      return false;
   }
   
   /* Comprueba contraseña*/
   var passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
   if (!form.pass.value.match(passRegex)) {
	   
	   alert("Formato de contraseña no valida")
	   
      return false;
   }
	
	var pass1=form.pass.value;
	var pass2=form.Password2.value;
	
	/* Comprueba QUER la contraseña sea igual*/
   if (pass1 != pass2) {
	  
	  alert("La contraseña es diferente")
	   
      return false;
   }
   
   return true;
}

var ValidaCambio = function() {
	

   var form = document.getElementById("UpdateForm");

   var NombreRegex = /^[\w\.\-\s]+$/;
   if (!form.Nombre.value.match(NombreRegex)) {
	   
	   alert("Formato de nombre no valido")
	   
      return false;
   }
   if (!form.Apellido1.value.match(NombreRegex)) {
	   
	   alert("Formato de primer apellido no valido")
	   
      return false;
   }
   
   /* Comprueba email*/
   var emailRegex = /^[\w]+@{1}[\w]+\.[a-z]{2,3}$/;
   if (!form.Email.value.match(emailRegex)) {
	   
	   alert("Formato de email no valido")
	   
      return false;
   }
   
   return true;
}

var ValidaFotos = function() {
	

   var form = document.getElementById("FormFotos");

   var NombreRegex = /^[\w\.\-\s]+$/;
   if (!form.Nombre.value.match(NombreRegex)) {
	   
	   alert("Formato de nombre no valido")
	   
      return false;
   }
   if (!form.Apellido1.value.match(NombreRegex)) {
	   
	   alert("Formato de primer apellido no valido")
	   
      return false;
   }
   
   /* Comprueba email*/
   var emailRegex = /^[\w]+@{1}[\w]+\.[a-z]{2,3}$/;
   if (!form.Email.value.match(emailRegex)) {
	   
	   alert("Formato de email no valido")
	   
      return false;
   }
   
   return true;
}