	$(document).ready(function(){
		$('#cboCamp').change(function(){
			UpdateClas();
		});
	});
	
	function UpdateClas(){
	$.ajax({
		type:"POST",
		url:"3001-myCla.php",
		data:"campeonato=" + $('#cboCamp').val(),
		success:function(r){
			$('#cboClasi').html(r);
		}
	});
	};
	
	$(document).ready(function(){
		$('#cboClasi').change(function(){
			if($('#cboClasi').val()!="0"){
				$("#cboClasi option:selected").each(function(){
					str_cla=$(this).val();
					str_camp=$('#cboCamp').val();
					$.ajax({
						type:"POST",
						url:"3002-ShowCla.php",
						data:{str_cla: str_cla, str_camp:str_camp},
						success:function(r){
							var str='<table class="myTable" id="tblClasi">';
							str +='<caption>Clasificacion</caption>';
							str +='<tr>';
							str +='<th>Pos.</th>';
							str +='<th colspan="3">Piloto</th>';
							str +='<th>Pts</th>';
							str +='</tr>';
							str +=r;
							str +="</table>";
							document.getElementById("dvShowClasi").innerHTML= str;
						}
					});
					$.ajax({
						type:"POST",
						url:"3003-ShowWinner.php",
						data:{str_cla: str_cla, str_camp:str_camp},
						success:function(r){
							var str='<h2 id="tWinner">Ganador</h2>';
							str +="<img src='8000-Driver_Pictures/";
							str +=r;
							str +="' class='Pic-Body'>";
							document.getElementById("dvWinner").innerHTML= str;
						}
					});
				});
			};
		});
	});
