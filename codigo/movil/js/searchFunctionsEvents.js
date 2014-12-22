function collectParameters(){

	var inicio = document.getElementById('inicio').value;
	var fin = document.getElementById('fin').value;
	var desde = document.getElementById('desde').value;
	var hasta = document.getElementById('hasta').value;
	var establecimiento = document.getElementById('establecimiento').value;
	

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
	var i=0;
     			
 			for (i=0;i<document.categoria.elements.length;i++){ 
                if(document.categoria.elements[i].checked==1){  
                  arrayCategory.push(document.categoria.elements[i].value);
                }
            }

    
	 if(province=="" && radio=="locality"){
		alert("Debe rellenar el campo localidad");
	 }else{
		if(lat=="" || lng==""){
			alert("Dirección incorrecta, debe seleccionar una de la lista");
		}else{
			if(arrayCategory.length==0){
				alert("Debe seleccionar al menos una categoria.");
			}else{
					$.ajax({
						dataType: "json",
						data: {"radio": radio, "distance": distance, "lat": lat, "lng": lng, "province": province, 
						"arraycategories": arrayCategory, "inicio": inicio, "fin": fin, "desde": desde, 
						"hasta":hasta, "establecimiento": establecimiento},
						url:   '../controller/loadEventAdvSearch.php',
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
								page = '../view/eventMapNoResult.php';
								setTimeout(document.location.href=page,12500);
							}else{
								var page = '../view/eventMap.php?mlat='+array[0]+'&mlng='+array[1]+'&';
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
