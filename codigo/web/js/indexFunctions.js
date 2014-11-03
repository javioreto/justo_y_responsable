function search(){ 
	var param = $("#param").val();
	var text = $("#inputParam").val();
   	
   	if(param=="-- Parametro de búsqueda --" || text==""){
   		$('#alertCampos').show();
   		$('#alertDni').hide();
   		$('#alertDatos').hide();
   		$('#alertCorrect').hide();
   		
   	}else{
   		if(checkDni()){
   			$.ajax({
				dataType: "json",
				data: {"param":param, "text":text},
				url:   '../controller/loadEstablishmentSearch.php',
				type:  'post',
				beforeSend: function(){
					//Lo que se hace antes de enviar el formulario
				},
				success: function(response){
					var user = response.user;
					var arrayInformation = user.split(";");
					
					var exist = arrayInformation[0];
					
					if(exist=="no"){
						$('#alertDatos').show();
						$('#alertCampos').hide();
				   		$('#alertDni').hide();
				   		$('#alertCorrect').hide();
					}else{
						var valid = arrayInformation[2];
						if(valid==0){
							$('#alertCampos').hide();
					   		$('#alertDni').hide();
					   		$('#alertDatos').hide();
							$('#alertCorrect').show();
						}else{
							var admin = arrayInformation[1];
							if(admin==0){
								var id = arrayInformation[3];
								page = './gestionEstablishment.php';
								setTimeout(document.location.href=page,12500);
								
							}else{
								var id = arrayInformation[3];
								page = './gestion.php';
								setTimeout(document.location.href=page,12500);
							}
						}
					}
				},
				error:	function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
				}
			});
   		}else{
   			$('#alertCampos').show();
	   		$('#alertDatos').hide();
	   		$('#alertCorrect').hide();
   			$('#alertDni').show();
   		}
   	}
}
