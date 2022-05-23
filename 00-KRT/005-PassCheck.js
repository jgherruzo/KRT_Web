$(document).ready(function() {
	
	$('#Password2').keyup(function(){
		var pass1 = $('#pass').val();
		var pass2 = $('#Password2').val();
		
		if (pass1 == pass2){
			$('#PassError').text("");
		}else{
			$('#PassError').text("Las contraseñas no coinciden").css("color","#fff004");
		}
		
	});

	$('#pass').keyup(function(){
		var pass1 = $('#pass').val();
		var Regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
		if (pass1.match(Regex)){
			$('#PassError').text("");
		}else{
			$('#PassError').text("La contraseña no cumple con los requisitos").css("color","#fff004");
		}
		
	});

	$('#mail').keyup(function(){
		var pass1 = $('#mail').val();
		var Regex = /^[\w]+@{1}[\w]+\.[a-z]{2,3}$/;
		if (pass1.match(Regex)){
			$('#PassError').text("");
		}else{
			$('#PassError').text("El email parece no tener un formato adecuado").css("color","#fff004");
		}
		
	});
	
});