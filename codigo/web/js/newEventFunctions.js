function valida(){
	var name = $("#name").val();
	var address = $("#address").val();
	var latitude = $("#lat").val();
	
	var flag = false;
	
	if(name=="" || address==""){
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

function eliminar(){
	if (confirm('Esta a punto de eliminar este evento \u00BFdesea continuar?')) {
	    window.location = "../controller/deleteEvent.php";
	} 
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


