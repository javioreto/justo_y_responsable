
function getCoordLocat(){	
	geoposicionar();
	 
}

function geoposicionar(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(centrarMapa,errorPosicionar);
    }else{
        mostrarMensaje('Tu navegador no soporta geolocalización');
    }   
}
 
/***********************************************
    Control de errores en caso de que la llamada
    navigator.geolocation.getCurrentPosition(centrarMapa,errorPosicionar);
    termine generando un error
***********************************************/
 
function errorPosicionar(error) {
    switch(error.code)  
    {  
        case error.TIMEOUT:  
            alert('Request timeout');  
        break;  
        case error.POSITION_UNAVAILABLE:  
            var page = '../view/start.php?lat=0&long=0';
			setTimeout(document.location.href=page,12500);  
        break;  
        case error.PERMISSION_DENIED:  
            var page = '../view/start.php?lat=0&long=0';
			setTimeout(document.location.href=page,12500);  
        break;  
        case error.UNKNOWN_ERROR:  
            alert('Error desconocido');  
        break;  
    }  
}
 
/***********************************************
    Esta función se ejecuta si la llamada a  navigator.geolocation.getCurrentPosition
    tiene éxito. La latitud y la longitud vienen dentro del objeto coords. 
***********************************************/
 
function centrarMapa(pos){
    var page = '../view/start.php?lat='+pos.coords.latitude+'&long='+pos.coords.longitude+'';
	setTimeout(document.location.href=page,12500);
}

//otra

function getLocation(){	
	position();
	 
}

function position(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(getCoordLocation,errorGetCoordLocation);
    }else{
        mostrarMensaje('Tu navegador no soporta geolocalización');
    }   
}

function errorGetCoordLocation(error) {
    switch(error.code)  
    {  
        case error.TIMEOUT:  
            alert('Se a superado el tiempo de espera');  
        break;  
        case error.POSITION_UNAVAILABLE:  
            document.getElementById('divlocation').style.display = 'none';
        	document.getElementById('nolocation').style.display = '';
        	document.getElementById('nolocation').disabled=true;
        	$("#radioLocation").attr("checked",false);
        	$("#radioLocation").attr("disabled", true);
        	$("#radioLocation").checkboxradio("refresh");
        	$("#radioLocality").attr("checked",true);
        	$("#radioLocality").checkboxradio("refresh");
        	$("#inputLocality").show();
        break;  
        case error.PERMISSION_DENIED:  
        	document.getElementById('divlocation').style.display = 'none';
        	document.getElementById('nolocation').style.display = '';
        	document.getElementById('nolocation').disabled=true;
        	$("#radioLocation").attr("checked",false);
        	$("#radioLocation").attr("disabled", true);
        	$("#radioLocation").checkboxradio("refresh");
        	$("#radioLocality").attr("checked",true);
        	$("#radioLocality").checkboxradio("refresh");
        	$("#inputLocality").show();
        break;  
        case error.UNKNOWN_ERROR:  
            alert('Error desconocido');
            document.getElementById('divlocation').style.display = 'none';
        	document.getElementById('nolocation').style.display = '';
        	document.getElementById('nolocation').disabled=true;
        	$("#radioLocation").attr("checked",false);
        	$("#radioLocation").attr("disabled", true);
        	$("#radioLocation").checkboxradio("refresh");
        	$("#radioLocality").attr("checked",true);
        	$("#radioLocality").checkboxradio("refresh");
        	$("#inputLocality").show(); 
        break;  
    }  
}

function getCoordLocation(pos){
    	document.getElementById('miLat').value = pos.coords.latitude;
        document.getElementById('miLng').value = pos.coords.longitude;
        $("#radioLocation").attr("checked",true);
    	$("#radioLocation").checkboxradio("refresh");
    	$("#radioLocality").attr("checked",false);
    	$("#radioLocality").checkboxradio("refresh");
}