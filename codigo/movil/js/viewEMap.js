var myEstablishment = getVarsUrl();
var name = myEstablishment.name;
var latitude = myEstablishment.latitude;
var longitude = myEstablishment.longitude;
var sector = myEstablishment.sector;

showInMap(name,latitude,longitude,sector);

function getVarsUrl(){
    var url= location.search.replace("?", "");
    var arrUrl = url.split("&");
    var urlObj={};   
    for(var i=0; i<arrUrl.length; i++){
        var x= arrUrl[i].split("=");
        urlObj[x[0]]=x[1];
    }
    return urlObj;
}

function showInMap(name,latitude,longitude,sector){
	$(document).ready(function(){
	  	var map = new GMaps({
		    el: '#mapE',
		    lat: latitude,
		  	lng: longitude,
		  	zoom : 13,
		});
	  	GMaps.geolocate({
	    	success: function(position){
		      	map.setCenter(latitude, longitude);
		      	map.addMarker({
		        	lat: position.coords.latitude,
		        	lng: position.coords.longitude,
		        	title: "Usted está aquí",
		        	infoWindow: {
		          		content: '<div id="contentInfo" style="width: 100px; height: 20px;"><b>Usted está aquí</b></div>'
		        	}
		      	});
		      	sec = sector.replace(/\%20/g," ");
		      	names = name.replace(/\%20/g," ");
		      	namef = unicode(names);
	      		if(sec == "Banca etica"){
	      			icon = "../../images/bancaetica.png";
	      		}else{
	      			if(sec == "Comercio justo"){
	      				icon = "../../images/comerciojusto.png";
	      			}else{
	      				if(sec == "Economia solidaria"){
	      					icon = "../../images/economiasolidaria.png";
	      				}else{
	      					if(sec == "Consumidores y usuarios organizados"){
	      						icon = "../../images/consumidores.png";
	      					}else{
	      						icon = "../../images/eventos.png";
	      					}
	      				}
	      			}
	      		}
				map.addMarker({
			        lat: latitude,
					lng: longitude,
			        title: namef,
			        icon: icon,
			        infoWindow: {
			          content: '<div id="contentInfo"><b>'+sec+'</b></br><p>'+names+'</p></div>'
			        }
		    	});
	    	},
	    	error: function(error){
	    		noLocation(name,latitude,longitude,sector);
	      		
	      		
	    	},
	    	not_supported: function(){
	    		noLocation(name,latitude,longitude,sector);
	      		//alert("Tu navegador no soporta geolocalización");
	      		
	    	}
	  	});
	});
}

function noLocation(name,latitude,longitude,sector){
	var map = new GMaps({
		    el: '#mapE',
		    lat: latitude,
		  	lng: longitude,
		  	zoom : 13,
	});
	sec = sector.replace(/\%20/g," ");
	names = name.replace(/\%20/g," ");
	namef = unicode(names);
	if(sec == "Banca etica"){
		icon = "../../images/bancaetica.png";
	}else{
		if(sec == "Comercio justo"){
			icon = "../../images/comerciojusto.png";
		}else{
			if(sec == "Economia solidaria"){
				icon = "../../images/economiasolidaria.png";
			}else{
				if(sec == "Consumidores y usuarios organizados"){
					icon = "../../images/consumidores.png";
				}else{
	      			icon = "../../images/eventos.png";
	      		}
			}
		}
	}
	map.addMarker({
        lat: latitude,
		lng: longitude,
        title: namef,
        icon: icon,
        infoWindow: {
          content: '<div id="contentInfo"><b>'+sec+'</b></br><p>'+names+'</p></div>'
        }
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


