// Devuelve un número aleatorio entre a y b //
function AleatorioAB(a,b){
	
	return Math.round(Math.random()*(b-a)+parseInt(a));

}

var obj,dir;

function iniciar() {
	var txt=document.getElementById("NewsTittle").innerHTML;
	var letras=txt.split("");
	var res="";
	
	for (var i=0;i<letras.length;i++)
		res +="<span>"+letras[i]+"</span>";
	document.getElementById("NewsTittle").innerHTML=res;
	obj=document.getElementById("NewsTittle").firstChild;
	dir=1;
	setInterval("efecto()",150);
}

function efecto(){
	obj.style.color="white";
		if(dir==1){
			if(obj.nextSibling != null)
				obj=obj.nextSibling;
			else
				dir=0;			
		}
		else{
			if(obj.previousSibling != null)
				obj=obj.previousSibling;
			else
				dir=1;			
		}
		
		obj.style.color="red";
}

