function checkCamposLogin(){ 
	var dni = $("#dni").val();
	var password = $("#pass").val(); 

   	if(dni=="" || password==""){
   		$('#alertCampos').show();
   		$('#alertDatos').hide();
   		$('#alertCorrect').hide();
   		$('#alertDni').hide();
   	}else{
   		if(checkDni()){
   			$.ajax({
				dataType: "json",
				data: {"dni":dni, "password":password},
				url:   '../controller/checkLogin.php',
				type:  'post',
				beforeSend: function(){
					//Lo que se hace antes de enviar el formulario
				},
				success: function(response){
					var user = response.user;
					var arrayInformation = user.split(";");
					
					var exist = arrayInformation[0];
					
					if(exist=="no"){
						$('#alertCampos').hide();
				   		$('#alertCorrect').hide();
				   		$('#alertDni').hide();
						$('#alertDatos').show();
					}else{
						var valid = arrayInformation[2];
						if(valid==0){
							$('#alertCampos').hide();
					   		$('#alertDatos').hide();
					   		$('#alertDni').hide();
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
					page = '../view/errorBd.php';
					setTimeout(document.location.href=page,12500);
					 
				}
			});
   		}else{
   			$('#alertCampos').hide();
	   		$('#alertDatos').hide();
	   		$('#alertCorrect').hide();
   			$('#alertDni').show();
   		}
   	}
}

function checkCamposRegister(){ 
	
	var name = $("#name").val();
	var surname = $("#surname").val();
	var dni = $("#dni").val();
	var password = $("#pass").val();
	var password2 = $("#pass2").val();
	var phone = $("#phone").val();
	var email = $("#email").val();
	var result = $('#result').val();
	var admin = 0;
	$correct = false;
	if(document.getElementById("admincheck")){
		if(document.getElementById("admincheck").checked){
			admin = 1;
		}
	}
	
   	if(dni=="" || password=="" || password2=="" || name=="" || email=="" || surname=="" || result == ""){
   		$('#alertTerms').hide();
   		$('#alertCampos').show();
   		$('#alertPass').hide();
   		$('#alertDniExist').hide();
   		$('#alertCaptcha').hide();
   		$('#alertDni').hide();
   		$('#alertPhone').hide();
   		$('#alertEmail').hide();
   	}else{
   		if(password!=password2){
   			$('#alertTerms').hide();
   			$('#alertCampos').hide();
	   		$('#alertDniExist').hide();
	   		$('#alertCaptcha').hide();
	   		$('#alertDni').hide();
   			$('#alertPass').show();
   			$('#alertPhone').hide();
   			$('#alertEmail').hide();
   		}else{
   			if(phone!="" && !checkphone(phone)){
   				$('#alertTerms').hide();
	   			$('#alertCampos').hide();
		   		$('#alertDniExist').hide();
		   		$('#alertCaptcha').hide();
		   		$('#alertDni').hide();
	   			$('#alertPass').hide();
	   			$('#alertPhone').show();
	   			$('#alertEmail').hide();
   			}else{
   				if(!checkEmail(email)){
   					$('#alertTerms').hide();
		   			$('#alertCampos').hide();
			   		$('#alertDniExist').hide();
			   		$('#alertCaptcha').hide();
			   		$('#alertDni').hide();
		   			$('#alertPass').hide();
		   			$('#alertPhone').hide();
		   			$('#alertEmail').show();
   				}else{
   					if(checkDni()){
			   			if(document.getElementById("terms")){
			   				if(document.getElementById("terms").checked){
			   					$correct = true;
			   				}else{
				   				$('#alertTerms').show();
				   				$('#alertDni').hide();
					   			$('#alertCampos').hide();
						   		$('#alertPass').hide();
						   		$('#alertDniExist').hide();
						   		$('#alertCaptcha').hide();
						   		$('#alertPhone').hide();
		   						$('#alertEmail').hide();
					   		}
			   			}else{
			   				$correct = true;
			   			}
			   			if($correct){
			   				$.ajax({
								dataType: "json",
								data: {"name":name, "surname":surname, "dni":dni, "password":password, "phone":phone, "email":email, "captcha":result, "adminch":admin},
								url:   '../controller/checkRegister.php',
								type:  'post',
								beforeSend: function(){
									//Lo que se hace antes de enviar el formulario
								},
								success: function(response){
									var response = response.html;
									var arrayResponse = response.split(";");
									var ok = arrayResponse[0];
									var session = arrayResponse[1];
									if(ok == "si"){
										if(session == "nosession"){
											$('#myModal').modal();
										}else{
											var page = '../view/gestionUser.php';
											setTimeout(document.location.href=page,12500);	
										}
									}else{
										if(ok == "exist"){
											$('#alertTerms').hide();
											$('#alertCampos').hide();
									   		$('#alertPass').hide();
									   		$('#alertCaptcha').hide();
									   		$('#alertDni').hide();
											$('#alertDniExist').show();
											$('#alertPhone').hide();
		   									$('#alertEmail').hide();
										}else{
											$('#alertTerms').hide();
											$('#alertCaptcha').show();
											$('#alertCampos').hide();
									   		$('#alertPass').hide();
									   		$('#alertDniExist').hide();
									   		$('#alertDni').hide();
									   		$('#alertPhone').hide();
		   									$('#alertEmail').hide();
										}
									}
								},
								error:	function(xhr,err){
									alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
								}
							});
			   			}
			   			
			   		}else{
			   			$('#alertTerms').hide();
			   			$('#alertDni').show();
			   			$('#alertCampos').hide();
				   		$('#alertPass').hide();
				   		$('#alertDniExist').hide();
				   		$('#alertCaptcha').hide();
				   		$('#alertPhone').hide();
		   				$('#alertEmail').hide();
			   		}
   				}
   			}
	   	}
   	}
}

function redir(){
	var page = '../view/login.php';
	setTimeout(document.location.href=page,12500);
}

function checkCamposEdit(id){ 
	
	var name = $("#name").val();
	var surname = $("#surname").val();
	var dni = $("#dni").val();
	var oldpass = $("#oldpass").val();
	var password = $("#pass").val();
	var password2 = $("#pass2").val();
	var phone = $("#phone").val();
	var email = $("#email").val();
   	
   	if(dni=="" || name=="" || surname=="" || email==""){
   		$('#alertCampos').show();
   		$('#alertPass').hide();
   		$('#alertDni').hide();
   		$('#alertPhone').hide();
		$('#alertEmail').hide();
		$('#alertConfirmPass').hide();
   	}else{
   		if(password!="" && password2==""){
   			$('#alertCampos').hide();
	   		$('#alertPass').hide();
	   		$('#alertDni').hide();
	   		$('#alertPhone').hide();
			$('#alertEmail').hide();
			$('#alertConfirmPass').show();
   		}else{
	   		if(password!=password2){
	   			$('#alertPass').show();
	   			$('#alertCampos').hide();
		   		$('#alertDni').hide();
		   		$('#alertPhone').hide();
			   	$('#alertEmail').hide();
			   	$('#alertConfirmPass').hide();
	   		}else{
	   			if(phone!="" && !checkphone(phone)){
	   				$('#alertCampos').hide();
			   		$('#alertPass').hide();
			   		$('#alertDni').hide();
			   		$('#alertPhone').show();
					$('#alertEmail').hide();
	   			}else{
	   				if(checkEmail(email)){
	   					if(checkDni()){
				   			$.ajax({
								dataType: "json",
								data: {"id":id, "name":name, "surname":surname, "dni":dni,"oldpass":oldpass, "password":password, "phone":phone, "email":email},
								url:   '../controller/checkEdit.php',
								type:  'post',
								beforeSend: function(){
									
								},
								success: function(response){
									var response = response.html;
									var arrayResponse = response.split(";");
									var ok = arrayResponse[0];
									if(ok == "si"){
										var page = '../view/informationUser.php?id='+id;
										setTimeout(document.location.href=page,12500);
										
									}
								},
								error:	function(xhr,err){
									alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
								}
							});
				   		}else{
				   			$('#alertDni').show();
				   			$('#alertCampos').hide();
					   		$('#alertPass').hide();
					   		$('#alertPhone').hide();
			   				$('#alertEmail').hide();
				   		}
	   				}else{
	   					$('#alertCampos').hide();
				   		$('#alertPass').hide();
				   		$('#alertDni').hide();
				   		$('#alertPhone').hide();
						$('#alertEmail').show();
	   				}
	   			}
		   	}
		}
   	}
}


function checkDni(){ 
	var check = true;
	var dni = $("#dni").val();
   	var numero = dni.substring(0,dni.length-1);
	var l = dni.substring(dni.length-1,dni.length);
	var letra = l.toUpperCase();
	var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
	
	if(numero<0 || numero>99999999){
		check = false;
	}else{
		var letraObtenida = letras[numero%23];
		if(letraObtenida!=letra){
			check = false;
		}
	}
	
	return check;
}

function checkphone(phone){
	var expr =  /^([0-9]+){9}$/;
	if(expr.test(phone)){
		return true;
	}
	return false;
}

function checkEmail(email) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(expr.test(email)){
        return true;
    }
    return false;
}

