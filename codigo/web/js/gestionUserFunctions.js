function validUser(){
	var arrayUsers = new Array();
    $("input:checkbox:checked").each(function(){
        
        arrayUsers.push($(this).attr("id"));
    });
    
    if(arrayUsers.length>0){
    	$.ajax({
			dataType: "json",
			data: {"arrayUsers": arrayUsers},
			url:   '../controller/validUsers.php',
			type:  'post',
			beforeSend: function(){
				
			},
			success: function(response){
				
				var arraylocations = response.uservalid;
				var array = arraylocations.split(";");
				var i = 1;
				if(array[0]=="si"){
					page = '../view/gestionUser.php';
					setTimeout(document.location.href=page,12500);
				}
				
			},
			error:	function(xhr,err){ 
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
			}
		});
    }else{
    	$('#alertValid').show();
    }
}

function deleteUser(id){
	$.ajax({
			dataType: "json",
			data: {"id": id},
			url:   '../controller/deleteUser.php',
			type:  'post',
			beforeSend: function(){
				
			},
			success: function(response){
				
				var arraylocations = response.user;
				var array = arraylocations.split(";");
				if(array[0]=="si"){
					page = '../view/gestionUser.php';
					setTimeout(document.location.href=page,12500);
				}
				
			},
			error:	function(xhr,err){ 
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
			}
		});
}

function allusercheck(source){
	checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
    {
        if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
        {
            checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
        }
    }
}
