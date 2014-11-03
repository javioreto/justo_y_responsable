changeMapList();

//Function to load locals.
function getEstablishmentForMap(){
	
		$.ajax({
			dataType: "json",
			url:   '../controller/loadEstablishment.php',
			type:  'post',
			beforeSend: function(){
				//Lo que se hace antes de enviar el formulario
			},
			success: function(response){
				//lo que se si el destino devuelve algo
				var arrayEstablishment = response.establishments;
				var array = arrayEstablishment.split(";");			
				showInitialMap(array);
				
				
			},
			error:	function(xhr,err){ 
				alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status+"\n \n responseText: "+xhr.responseText);
			}
		});
}

//Function that changes the content of the page to move from one tab to another.

function getEstablishmentsNear(array,position){
	var matriz=new Array();
	
	for(var k=0,j = 0; j<array.length; j=j+5,k=k+1){
		matriz[k] = new Array();
		matriz[k][0] = array[j];
		matriz[k][1] = array[j+1];
		matriz[k][2] = array[j+2];
		matriz[k][3] = array[j+3];
		matriz[k][4] = array[j+4];
		var distancia = Dist(position.coords.latitude, position.coords.longitude, array[j+1], array[j+2]);
		matriz[k][5] = distancia;
	}
	var aux=new Array();
	for(var j = 0; j<array.length-1 ; j=j+1){ 
		for(var k = j+1; k<array.length-1; k=k+1){
			if(matriz[k]==null){
				k=array.length; 
			}else{
				var s = parseFloat(matriz[j][5]);
				var t = parseFloat(matriz[k][5]);
				if(s>t){
					aux = matriz[j];
					matriz[j] = matriz[k];
					matriz[k] = aux;
				}
				var kkk = matriz[k][0];
			}
		}
		if(matriz[j][0]==""){
			j=array.length;
		}
	}
	var arrayFinal=new Array();
	var i=0;
	for(var h=0;h<10 && h<matriz.length;h=h+1){
		if(matriz[h][0]==""){
			h=matriz.length;
		}else{
			for(var p=0; p<5; p=p+1){
				arrayFinal[i] = matriz[h][p];
				i=i+1;
			}
		}
	}
	return arrayFinal;
}


function changeMapList(){
	$(document).on("pagecreate", "#map-page", function() {
		
		var $mapSwitch = $("#map-switch");
		var $listSwitch = $("#list-switch");
	
		var $map = $("#map");
		var $list = $("#list");

		$list.hide();
		$("#divpanellegen").show();
		$map.show();
		getEstablishmentForMap();
		
		
		$mapSwitch.click(function() {
			$list.hide();
			$map.show();
			$("#divpanellegen").show();
			$footer.show();
			
			
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
		    el: '#map',
		    lat: array[1],
		  	lng: array[2],
		  	zoom : 13,
		});
	  	GMaps.geolocate({
	    	success: function(position){
	    		var arrayE = new Array();
	    		arrayE = getEstablishmentsNear(array,position);
	    		correct = true;
		      	map.setCenter(position.coords.latitude, position.coords.longitude);
		      	map.addMarker({
		        	lat: position.coords.latitude,
		        	lng: position.coords.longitude,
		        	title: "Usted está aquí",
		        	infoWindow: {
		          		content: '<div id="contentInfo"><b>Usted está aquí</b></div>'
		        	}
		      	});
		      	for(var i = 0; i<arrayE.length; i=i+5){
		      		if(arrayE[i+3] == "Banca etica"){
		      			icon = "../../images/bancaetica.png";
		      		}else{
		      			if(arrayE[i+3] == "Comercio justo"){
		      				icon = "../../images/comerciojusto.png";
		      			}else{
		      				if(arrayE[i+3] == "Economia solidaria"){
		      					icon = "../../images/economiasolidaria.png";
		      				}else{
		      					if(arrayE[i+3] == "Consumidores y usuarios organizados"){
		      						icon = "../../images/consumidores.png";
		      					}
		      				}
		      			}
		      		}
					map.addMarker({
				        lat: arrayE[i+1],
						lng: arrayE[i+2],
				        title: arrayE[i],
				        icon: icon,
				        infoWindow: {
				          content: '<div id="contentInfo"><b>'+arrayE[i+3]+'</b></br><p>'+arrayE[i]+'</p></div>'
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
	for(var h = 0, k=0; h<arrayMadrid.length; h=h+5){
		if(arrayMadrid[h+4]=='Madrid'){
			array[k]=arrayMadrid[h];
			array[k+1]=arrayMadrid[h+1];
			array[k+2]=arrayMadrid[h+2];
			array[k+3]=arrayMadrid[h+3];
			k=k+4;
		}
	}
	var map = new GMaps({
		    el: '#map',
		    lat: array[1],
		  	lng: array[2],
		  	zoom : 13,
		});
  	for(var i = 0; i<array.length; i=i+4){
  		
  		if(array[i+3] == "Banca etica"){
  			icon = "../../images/bancaetica.png";
  		}else{
  			if(array[i+3] == "Comercio justo"){
  				icon = "../../images/comerciojusto.png";
  			}else{
  				if(array[i+3] == "Economia solidaria"){
  					icon = "../../images/economiasolidaria.png";
  				}else{
  					if(array[i+3] == "Consumidores y usuarios organizados"){
  						icon = "../../images/consumidores.png";
  					}
  				}
  			}
  		}
		map.addMarker({
	        lat: array[i+1],
			lng: array[i+2],
	        title: array[i],
	        icon: icon,
	        infoWindow: {
	          content: '<div id="contentInfo" style="width: 150px; height: 80px;"><b>'+array[i+3]+'</b></br><p>'+array[i]+'</p></div>'
	        }
    	});
    }
}

