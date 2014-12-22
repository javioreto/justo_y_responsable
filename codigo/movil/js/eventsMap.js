changeMapList();

//Function to load locals.
function getEstablishmentForMap(){
	
	var Url = location.href;
	Url = Url.replace(/.*\?(.*?)/,"$1");
	Variables = Url.split ("&");
	var milat = Variables[0];
	var milng = Variables[1];
	var array=new Array();
	for (i = 2,j=0; i < Variables.length; i++) {
       Separ = Variables[i].split("=");
       if(Separ[0]!="id"){
       	array[j] = Separ[1];
       	j++;
       }
	}
	showInitialMap(array);
	
		
}



function changeMapList(){
	$(document).on("pagecreate", "#map-page", function() {
		var $mapSwitch = $("#map-switch");
		var $listSwitch = $("#list-switch");
		
		
		var $map = $("#map-search");
		var $list = $("#list-search");
		$("#divpanellegen").hide();

		$list.hide();
		
		$map.show();
		getEstablishmentForMap();
		
		$mapSwitch.click(function() {
			$list.hide();
			$map.show();
		
			$("#divpanellegen").show();
			
			getEstablishmentForMap();
			
		});
		
		

		$listSwitch.on("click", function(e) {
			$map.hide();
			$list.show();
			$("#divpanellegen").hide();
			$footer.hide();
		});
	});
}


//Funcion to show the map with locals.	
function showInitialMap(array){
	var correct = false;
	$(document).ready(function(){
	  	var map = new GMaps({
		    el: '#map-search',
		    //lat: array[1],
		  	//lng: array[2],
		  	lat: array[2],
		  	lng: array[3],
		  	zoom : 13,
		});
	  	GMaps.geolocate({
	    	success: function(position){
	    		
		      	map.setCenter(array[2], array[3]);
		      	map.addMarker({
		        	lat: position.coords.latitude,
		        	lng: position.coords.longitude,
		        	title: "Usted está aquí­",
		        	infoWindow: {
		          		content: '<div id="contentInfo" style="width: 100px; height: 20px;"><b>Usted está aquí­</b></div>'
		        	}
		      	});
		      	
		      	for(var i = 0; i<array.length; i=i+6){
		      		sec = array[i+4].replace(/\%20/g," ");
		      		name = array[i+1].replace(/\%20/g," ");
		      		
					map.addMarker({
				        lat: array[i+2],
						lng: array[i+3],
				        title: name,
				        icon: "../../images/eventos.png",
				        infoWindow: {
				          content: '<div id="contentInfo"><b>'+sec+'</b></br><p>'+name+'</p></div>'
				        }
			    	});
			    	
			    }
	    	},
	    	error: function(error){
	    		failLocation(array);
	      		
	      		
	    	},
	    	not_supported: function(){
	    		failLocation(array);
	      		
	      		
	    	}
	  	});
	});
}


function failLocation(array){
		
	var arrayMadrid = new Array();
	arrayMadrid = array;
	array = new Array();
	for(var h = 0, k=0; h<arrayMadrid.length; h=h+6){
			array[k]=arrayMadrid[h+1];
			array[k+1]=arrayMadrid[h+2];
			array[k+2]=arrayMadrid[h+3];
			array[k+3]=arrayMadrid[h+4];
			k=k+4;
	}
	var map = new GMaps({
		    el: '#map-search',
		    lat: array[1],
		  	lng: array[2],
		  	zoom : 13,
		});
  	for(var i = 0; i<array.length; i=i+4){
  		sec = array[i+3].replace(/\%20/g," ");
		name = array[i].replace(/\%20/g," ");
  		
		map.addMarker({
	        lat: array[i+1],
			lng: array[i+2],
	        title: name,
	        icon: "../../images/eventos.png",
	        infoWindow: {
	          content: '<div id="contentInfo"><b>'+sec+'</b></br><p>'+name+'</p></div>'
	        }
    	});
    }
}
