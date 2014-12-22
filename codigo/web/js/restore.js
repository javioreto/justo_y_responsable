function checkCamposLogin(){ 
	var dni = $("#dni").val();

   	if(dni==""){
   		$('#alertCampos').show();
   		$('#alertOk').hide();
   	}else{
   		
   			$.ajax({
				dataType: "json",
				data: {"dni":dni},
				url:   '../controller/restore.php',
				type:  'post',
				beforeSend: function(){
					//Lo que se hace antes de enviar el formulario
				},
				success: function(response){
					$('#alertCampos').hide();
   					$('#alertOk').show();
				},
				error:	function(xhr,err){
					page = '../view/errorBd.php';
					setTimeout(document.location.href=page,12500);					 
				}
			});

   	}
}

function checkCamposRestore(){ 
	var pass = $("#pass").val();
	var pass1 = $("#pass1").val();
	var dni = $("#dni").val();

   	if(pass=="" || pass1==""){
   		$('#alertCampos').show();
   		$('#alertIguales').hide();
   		$('#alertOk').hide();
   	}else{
   		if(pass!=pass1){
   			$('#alertCampos').hide();
   			$('#alertIguales').show();
   			$('#alertOk').hide();
   		}else{
   			$.ajax({
				dataType: "json",
				data: {"dni":dni, "pass":pass},
				url:   '../controller/restorePass.php',
				type:  'post',
				beforeSend: function(){
					//Lo que se hace antes de enviar el formulario
				},
				success: function(response){
					$('#alertCampos').hide();
   					$('#alertIguales').hide();
   					$('#alertOk').show();
				},
				error:	function(xhr,err){
					page = '../view/errorBd.php';
					setTimeout(document.location.href=page,12500);					 
				}
			});
		}
   	}
}



function volver(){
	history.back(1);
}
