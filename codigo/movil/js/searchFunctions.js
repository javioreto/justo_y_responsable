function collectParameters(){
	var province = "";
	var radio = $("input[type='radio']:checked").val();
	var distance = $("#slider").val();
	var valor = $("#flipDistance").val();
	if(valor=="no"){
		distance = "0";
	}
	var lat = document.getElementById('miLat').value;
	var lng = document.getElementById('miLng').value;
	if(radio=="locality"){
		lat="";
		lng="";
		province = $("#inputLocality").val();
		lat = document.getElementById('cityLat').value;
		lng = document.getElementById('cityLng').value;
		valor = $("#flipDistance").val();
		if(valor=="no"){
			distance = "0";
		}
	}
	
	var arrayCategory = new Array();
     $('#allcheck :checked').each(function() {
       arrayCategory.push($(this).attr("id"));
     });	
     
     if(arrayCategory.length == 0){
     	arrayCategory = "";
     }
	
	var arraySector =  new Array();
	var i=0;
	if (document.form.comercioJusto.checked){
		//if(arrayCategory!=""){
			arraySector[i++] = 1;
		//}
	}
	if (document.form.bancaEtica.checked){
		arraySector[i++] = 2;
	}
	if (document.form.economiaSolidaria.checked){
		arraySector[i++] = 3;
	}
	if (document.form.consumidores.checked){
		arraySector[i++] = 4;
	}
	
    
	 if(province=="" && radio=="locality"){
		alert("Debe rellenar el campo localidad");
	 }else{
		if(lat=="" || lng==""){
			alert("Dirección incorrecta, debe seleccionar una de la lista");
		}else{
			if(arraySector.length==0){
				alert("Debe seleccionar al menos un sector");
			}else{
				if(arraySector[0]==1 && arrayCategory==""){
					alert("Debe seleccionar al menos una categoría");
				}else{
					$.ajax({
						dataType: "json",
						data: {"radio": radio, "distance": distance, "lat": lat, "lng": lng, 
						"province": province, "arraysector": arraySector, "arraycategories": arrayCategory},
						url:   '../controller/loadEstablishmentAdvSearch.php',
						type:  'post',
						beforeSend: function(){
							//Lo que se hace antes de enviar el formulario
						},
						success: function(response){
							//lo que se si el destino devuelve algo
							var arraylocations = response.establishments;
							var array = arraylocations.split(";");
							var page = "";
							if(array.length == 3){
								page = '../view/establishmentMapNoResult.php';
								setTimeout(document.location.href=page,12500);
							}else{
								var page = '../view/establishmentMap.php?mlat='+array[0]+'&mlng='+array[1]+'&';
								var size = array.length;
								var i = 2;
								var t = 0;
								for(i=2;i<size-1;i=i+6){
									var name = unicode(array[i+1]);
									page += 'id'+t+'='+array[i]+'&';
									page += 'name'+t+'='+name+'&';
									page += 'latitude'+t+'='+array[i+2]+'&';
									page += 'longitude'+t+'='+array[i+3]+'&';
									page += 'sector'+t+'='+array[i+4]+'&';
									page += 'location'+t+'='+array[i+5]+'&';
									t = t+1;
								}
								page = page.slice(0,page.length-1);
								setTimeout(document.location.href=page,12500);
								//hide();
							}
							
							
						},
						error:	function(xhr,err){ 
							alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
						}
					});
				}
							
			}
		}
	}

}

function selectedCJ() {
    if (document.form.comercioJusto.checked){
    	$("#checklisttable input").each(function(){
           
            $(this).prop('checked', true);
        });
        
        $("#checklisttable label").addClass('ui-checkbox-on').removeClass('ui-checkbox-off');
        $("#checklisttable span.ui-icon").addClass('ui-icon-checkbox-on').removeClass('ui-icon-checkbox-off');
        $("#productsSection").show();
	}else{
    	$("#productsSection").hide();
	}
}


function slideCityShow() {
    $("#inputLocality").show();
}

function slideCityHide() {
    $("#inputLocality").hide();
}

function slideDistance() {
	if($("#sliderDistance").is(':visible')){
    	$("#sliderDistance").hide();
    	$("#flipDistance").val('no').flipswitch("refresh");
	}else{
    	$("#sliderDistance").show();
    	$("#flipDistance").val('si').flipswitch("refresh");
	}
}

function searchGoogle(){
	function initialize() {
        var input = document.getElementById('inputLocality');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
} 

function selectItem($sele){
	$("#listviewlocal").click(function () {
		var $data=$($sele).text();
		var elem = document.getElementById("inputLocal");
		elem.value = $dato;
	});
}

function unicode(str){
	str = str.split('á').join('a');
	str = str.split('à').join('a');
	str = str.split('é').join('e');
	str = str.split('è').join('e');
	str = str.split('í').join('i');
	str = str.split('ì').join('i');
	str = str.split('ó').join('o');
	str = str.split('ò').join('o');
	str = str.split('ú').join('u');
	str = str.split('ù').join('u');
	str = str.split('ü').join('u');

	str = str.split('Á').join('A');
	str = str.split('É').join('E');
	str = str.split('Í').join('I');
	str = str.split('Ó').join('O');
	str = str.split('Ú').join('U');
	str = str.split('Á').join('A');
	str = str.split('È').join('E');
	str = str.split('Ì').join('I');
	str = str.split('Ó').join('O');
	str = str.split('Ú').join('U');
	str = str.split('Ü').join('U');

	str = str.split('ñ').join('n');
	str = str.split('Ñ').join('N');
	
	return str;
}
