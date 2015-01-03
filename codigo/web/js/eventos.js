function eventOk(id, type, div){
$.ajax({
			dataType: "json",
			data: {"id":id, "type": type, "action": 1},
			url:   '../controller/events.php',
			type:  'post',
			beforeSend: function(){
				
			},
			success: function(response){
				$(div).addClass('hidden');	
				
				$('#alertOk').removeClass('hidden').addClass('visible');

				setTimeout(function () {
      				$('#alertOk').removeClass('visible').addClass('hidden');
   				 }, 3000);

				
			},
			error:	function(xhr,err){
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
			}
		});
}

function eventCancel(id, type, div){
if (confirm('Esta a punto de eliminar este comentario \u00BFdesea continuar?')) {
$.ajax({
			dataType: "json",
			data: {"id":id, "type": type, "action": 2},
			url:   '../controller/events.php',
			type:  'post',
			beforeSend: function(){
				
			},
			success: function(response){
				$(div).addClass('hidden');	
				
				$('#alertCancel').removeClass('hidden').addClass('visible');

				setTimeout(function () {
      				$('#alertCancel').removeClass('visible').addClass('hidden');
   				 }, 3000);
	
			},
			error:	function(xhr,err){
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
			}
		});
		}
}


function filtrar(filtro){
$.ajax({
			dataType: "json",
			data: {"filtro":filtro},
			url:   '../view/notificaciones.php',
			type:  'post',
			beforeSend: function(){	
			},
			success: function(response){
				document.getElementById('contenedor-objetos').innerHTML=response.categ;
			},
			error:	function(xhr,err){
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
			}
		});
}