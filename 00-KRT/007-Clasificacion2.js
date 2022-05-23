	$(document).ready(function(){
		$('#cboClasi').change(function(){
			alert('in');
			DownloadClas();
		});
	});
	
	function DownloadClas(){
	$.ajax({
		type:"POST",
		url:"3002-ShowCla.php",
		data:{'campeonato': $('#myCamp').val(),
		'clasi': $('#myClasificacion').val()},
		success:function(r){
			$('#myShow').html(r);
		}
	});
	};
