function addComment(id){
	
	var name = $('#nameComment').val();
	var text = $('#textComment').val();
	var result = $('#result').val();

	

	if(name != "" && text != "" && result != ""){
		
	
		//Tenemos que llamar a una funcion pasarle los parametros y que esta se conecte a la base de datos y si todo esta bien appen.
		$.ajax({
				dataType: "json",
				data: {"name":name, "text":text, "refE":id, "captcha": result},
				url:   '../controller/addNewComment.php',
				type:  'post',
				beforeSend: function(){
					//Lo que se hace antes de enviar el formulario
				},
				success: function(response){
					var response = response.html;
					var arrayResponse = response.split(";");
					var ok = arrayResponse[0];
					if(ok=="si"){
						var date = arrayResponse[1];
						$('#listComment').prepend('<li><div><p style="font-size: small" >Fecha y hora:  '+date+'</p><img style="float: left" src="../../images/bubble.png" /><blockquote><h2>'+name+'</h2></blockquote><p id="adddesc">'+text+'</p></div></li>').listview('refresh');
						$('#nameComment').val("");
						$( "#nameComment" ).textinput( "refresh" );
						$('#textComment').val("");
						$( "#textComment" ).textinput( "refresh" );
						$('#listComment').listview( "refresh" );
						$('#result').val("");
						document.getElementById('captcha').src='../images/captcha.php?'+Math.random();
						$("#divnocom").hide();
						$( "#comentOk" ).height('auto');
						$( "#comentOk" ).css("visibility","visible");	

					}else{
						alert("No se a introducido correctamente la palabra de la imagen");
					}
				},
				error:	function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
				}
			});
		}
		else{
			if(name == "" || text == ""){
				alert("Los campos nombre y texto no pueden estar vacios");
			}else{
				alert("El resultado de validacion no es correcto");
			}
		}
	

	

}

function addCommentEvent(id){
	
	var name = $('#nameComment').val();
	var text = $('#textComment').val();
	var result = $('#result').val();

	

	if(name != "" && text != "" && result != ""){
		
	
		//Tenemos que llamar a una funcion pasarle los parametros y que esta se conecte a la base de datos y si todo esta bien appen.
		$.ajax({
				dataType: "json",
				data: {"name":name, "text":text, "refE":id, "captcha": result},
				url:   '../controller/addNewCommentEvent.php',
				type:  'post',
				beforeSend: function(){
					//Lo que se hace antes de enviar el formulario
				},
				success: function(response){
					var response = response.html;
					var arrayResponse = response.split(";");
					var ok = arrayResponse[0];
					if(ok=="si"){
						var date = arrayResponse[1];
						$('#listComment').prepend('<li><div><p style="font-size: small" >Fecha y hora:  '+date+'</p><img style="float: left" src="../../images/bubble.png" /><blockquote><h2>'+name+'</h2></blockquote><p id="adddesc">'+text+'</p></div></li>').listview('refresh');
						$('#nameComment').val("");
						$( "#nameComment" ).textinput( "refresh" );
						$('#textComment').val("");
						$( "#textComment" ).textinput( "refresh" );
						$('#listComment').listview( "refresh" );
						$('#result').val("");
						document.getElementById('captcha').src='../images/captcha.php?'+Math.random();
						$("#divnocom").hide();
						$( "#comentOk" ).height('auto');
						$( "#comentOk" ).css("visibility","visible");	

					}else{
						alert("No se a introducido correctamente la palabra de la imagen");
					}
				},
				error:	function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
				}
			});
		}
		else{
			if(name == "" || text == ""){
				alert("Los campos nombre y texto no pueden estar vacios");
			}else{
				alert("El resultado de validacion no es correcto");
			}
		}
	

	

}