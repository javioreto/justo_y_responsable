function deleteEstablishment(id){
	$.ajax({
			dataType: "json",
			data: {"id": id},
			url:   '../controller/deleteEstablishment.php',
			type:  'post',
			beforeSend: function(){
				
			},
			success: function(response){
				
				var arraylocations = response.establishment;
				var array = arraylocations.split(";");
				if(array[0]=="si"){
					page = '../view/gestionEstablishment.php';
					setTimeout(document.location.href=page,12500);
				}
				
			},
			error:	function(xhr,err){ 
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
			}
		});
}
