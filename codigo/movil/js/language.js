function selectLanguage(language){

	if(language != ""){
	
		//Tenemos que llamar a una funcion pasarle los parametros y que esta se conecte a la base de datos y si todo esta bien appen.
		$.ajax({
			dataType: "json",
			data: {"language":language},
			url:   '../controller/selectLanguage.php',
			type:  'post',
			beforeSend: function(){
				//Lo que se hace antes de enviar el formulario
			},
			success: function(response){
				page = '../view/index.php';
				setTimeout(document.location.href=page,12500);
			},
			error:	function(xhr,err){
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
			}
		});
	}
		
	

	

}