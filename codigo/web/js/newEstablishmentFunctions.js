function valida(){
	var name = $("#name").val();
	var address = $("#address").val();
	var latitude = $("#lat").val();
	
	var cecj = false;
	var arrayNetwork = new Array();
     $('#chnetwork :checked').each(function() {
     	if($(this).attr("id")==2){
     		cecj=true;
     	}
       arrayNetwork.push($(this).attr("id"));
     });
     	
	
	var arrayOrgImp = new Array();
     $('#chorgimp :checked').each(function() {
       arrayOrgImp.push($(this).attr("id"));
     });
     if(arrayOrgImp.length==0){
     	arrayOrgImp = "";
     }
	
	var valSector = $("#selectSector").val();
	var valType = $("#selectType").val();
	
	var user = "";
	var flag = false;
	
	if(name=="" || address=="" || arrayNetwork.length==0 || valSector==0 || valType==0){
		if($("#selectUsers").length){
			user = $("#selectUsers").val();
			flag = true;
		}
		if(flag && user==0){
			$('#alertCampos').show();
			$('#alertAddress').hide();
			$('#alertCamposImp').hide();
			return false;
		}
		$('#alertCampos').show();
		$('#alertAddress').hide();
		$('#alertCamposImp').hide();
		return false;
	}else{
		if($("#selectUsers").length){
			user = $("#selectUsers").val();
			flag = true;
		}
		if(flag && user==0){
			$('#alertCampos').show();
			$('#alertAddress').hide();
			$('#alertCamposImp').hide();
			return false;
		}
		if(latitude==0){
			$('#alertAddress').show();
			$('#alertCampos').hide();
			$('#alertCamposImp').hide();
			return false;
		}
	}
		
	if(!cecj && arrayOrgImp==0 && valSector==1){
		$('#alertCampos').hide();
		$('#alertAddress').hide();
		$('#alertCamposImp').show();
		return false;
	}
}

function addSubCat(id){ 
	var sidSelect = id;
	var idSelect = sidSelect.slice(3,sidSelect.length);
	var selectSub = parseInt(idSelect)+1;
	var entra = false;
	while($("#cat"+selectSub).length){
		$("#cat"+selectSub).remove();
		selectSub = selectSub+1;
		entra = true;
	}
	if(entra){
		selectSub = selectSub-1;
		document.getElementById('num').value = selectSub;
	}else{
		document.getElementById('num').value = selectSub;
	}
	var idCategSelec = $('#'+id).val();
	document.getElementById('cat').value = idCategSelec;
	
	
    if(idCategSelec!=0){
    	$.ajax({
			dataType: "json",
			data: {"idCateg":idCategSelec},
			url:   '../controller/loadSubCat.php',
			type:  'post',
			beforeSend: function(){
				
			},
			success: function(response){
				var categ = response.categ;
				var arrayInformation = categ.split(";");
				
				var exist = arrayInformation[0];
				
				if(exist=="si"){
					var i=1;	
					var options = "<select id='cat"+selectSub+"' class='paramCateg form-control' onchange='addSubCat(this.id)'><option value='0'>-- *SubCategoría --</option>";
					
					for(i=1;i<arrayInformation.length-1;i = i+2){
						options += "<option value="+arrayInformation[i]+">"+arrayInformation[i+1]+"</option>";
			
					}
					$("#divSelect").append(options);
					
				}
			},
			error:	function(xhr,err){
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
			}
		});
    }
}

function addProducts(){
	var idCateg = document.getElementById('cat').value; 
	var num = document.getElementById('num').value;
	var ok = true;
	if($("#cat"+num).length){
		var valnum = document.getElementById('cat'+num+'').value;
		if(valnum==0){
			ok=false;
		}
	}else{
		if(num!=""){
			var valnum = document.getElementById('cat'+(num-1)+'').value;
			if(valnum==0){
				ok = false;
			}
		}else{
			ok = false;
		}
	}
	if(ok){
		var name = $("#namedata").val();
		var description = $("#descriptiondata").val();
		if(name != "" && idCateg != ""){
	    	$.ajax({
				dataType: "json",
				data: {"name":name, "description":description, "idCateg":idCateg},
				url:   '../controller/addProduct.php',
				type:  'post',
				beforeSend: function(){
					
				},
				success: function(response){
					var categ = response.product;
					var arrayInformation = categ.split(";");
					
					var correct = arrayInformation[0];
					if(correct=="si"){
						var idProduct = arrayInformation[1];
						var product = "<li id="+idProduct+" class='list-group-item'><h4 class='list-group-item-heading'>"+name+"</h4><button style='border: 1px solid black; background-color: #CE8483; color: #FFFFFF; border-color: #000000; float:right; margin-top:-30px;' class='btn btn-default' onclick='deleteProduct("+idProduct+")' >Borrar</button><p class='list-group-item-text'>"+description+"</p></li>";
						var stringidproducts = document.getElementById('idproducts').value;
						stringidproducts = stringidproducts + ""+idProduct+";";
						document.getElementById('idproducts').value = stringidproducts;
						$("#listProduct").append(product);
						
						$("#namedata").val("");
						$("#descriptiondata").val("");
						
						var selectSub = num-1;
						while($("#cat"+selectSub).length && selectSub>0){
							$("#cat"+selectSub).remove();
							selectSub = selectSub-1;
						}
						document.getElementById('cat0').value = "0";
					}
					document.getElementById('num').value = "";
				},
				error:	function(xhr,err){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
				}
			});
	    }else{
	    	$('#alertCamposPr').show();
	    }
	}else{
		$('#alertCamposPr').show();	
	}
	
}

function deleteProduct(id){
	var arrayStringProduct = document.getElementById('idproducts').value;
	var arrayProduct = arrayStringProduct.split(";");
	var stringp = "";
	var entra = false;
	for(var i=0;i<arrayProduct.length;i++){
		if(arrayProduct[i]!=""){
			if(arrayProduct[i]==id){
				delete arrayProduct[i];
			}else{
				stringp = stringp + arrayProduct[i];
				stringp = stringp + ";";
			}
		}
	}
	document.getElementById('idproducts').value = stringp;
	$('#'+id).remove();
}

function searchGoogle(){
	function initialize() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            place = autocomplete.getPlace();
    		
    		var numeros="0123456789";
    		var stringfirst = place.address_components[0].long_name;
    		var first = false;
    		for(i=0; i<stringfirst.length; i++){
		      if (numeros.indexOf(stringfirst.charAt(i),0)!=-1){
		         first = true;
		      }
		    }
    		if(first){
    			document.getElementById('adr').value = place.address_components[1].long_name +","+ place.address_components[0].long_name;
    			document.getElementById('locality').value = place.address_components[2].long_name;
    			document.getElementById('cp').value = place.address_components[6].long_name;
    		}else{
    			document.getElementById('adr').value = place.address_components[0].long_name;
    			document.getElementById('locality').value = place.address_components[1].long_name;
    			var stringlast = place.address_components[place.address_components.length-1].long_name;
	    		var last = false;
	    		for(i=0; i<stringlast.length; i++){
			      if (numeros.indexOf(stringlast.charAt(i),0)!=-1){
			         last = true;
			      }
			    }
			    if(last){
			    	document.getElementById('cp').value = place.address_components[place.address_components.length-1].long_name;
			    }else{
			    	document.getElementById('cp').value = "";
			    }
    			
    		}
    		
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();
       
            
            var map = new GMaps({
                el: document.getElementById("map-canvas"),
                lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng(),
                zoom : 15,
                click: function(e) {
                    lat = e.latLng.lat();
                    lng = e.latLng.lng();
                    document.getElementById('lat').value = lat;
            		document.getElementById('lng').value = lng;
                    
                    var geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(lat, lng);
                    geocoder.geocode({"latLng":latlng},function(data,status){
                        if(status == google.maps.GeocoderStatus.OK){
                            var dir = data[0].address_components;
                             document.getElementById('address').value = data[0].formatted_address;
                            var address = dir[1].long_name +","+ dir[0].long_name;
                            var locality = dir[2].long_name;
                            var cp = dir[6].long_name;
                            document.getElementById('adr').value = address;
			    			document.getElementById('locality').value = locality;
			    			document.getElementById('cp').value = cp;
			    			a.setMap(null);
			    			a = map.addMarker({
                                lat: lat,
                                lng: lng
                            });
                        }
                    });
                    
                },
               
            });
            var a = map.addMarker({
                lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng(),
            });
   		});
       	
    }
    google.maps.event.addDomListener(window, 'load', initialize);
}

function showhideproducts(){
	var sector = $('#selectSector').val()	;
	if(sector == 1){
		$("#productSection").show();
		$("#redSection").show();
	}else{
    	$("#productSection").hide();
    	$("#redSection").hide();
	}
}

function showurlFace(){
	if(document.getElementById("chface").checked){
        $("#inputFacebook").show();
	}else{
    	$("#inputFacebook").hide();
    	$("#inputFacebook").val("");
	}
}

function showurlTwitter(){
	if(document.getElementById("chtwitter").checked){
        $("#inputTwitter").show();
	}else{
    	$("#inputTwitter").hide();
    	$("#inputTwitter").val("");
	}
}



function volver(){
	var stringpro = document.getElementById('idproducts').value;
	var arrayProducts = stringpro.split(";");
	if(arrayProducts[0]!=""){
		$.ajax({
			dataType: "json",
			data: {"arrayProducts":arrayProducts},
			url:   '../controller/removeProduct.php',
			type:  'post',
			beforeSend: function(){
				//Lo que se hace antes de enviar el formulario
			},
			success: function(response){
				var products = response.deleteProduct;
				var arrayInformation = products.split(";");
				
				var correct = arrayInformation[0];
				if(correct=="si"){
					page = './gestionEstablishment.php';
					setTimeout(document.location.href=page,12500);
				}
			},
			error:	function(xhr,err){
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText); 
			}
		});
	}else{
		page = './gestionEstablishment.php';
		setTimeout(document.location.href=page,12500);
	}
}