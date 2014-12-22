<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

if(isset($_POST['radio']) && isset($_POST['distance']) && isset($_POST['lat']) && isset($_POST['lng']) 
        && isset($_POST['province']) && isset($_POST['arraycategories'])){
    //Get params.
    $radio = $_POST['radio'];
    $distance = $_POST['distance'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $province = $_POST['province']; 
    $arrayProvince =  split(",", $province);
    $province = $arrayProvince[0]; 

    $arrayCategories = "";
    $arrayCategories = $_POST['arraycategories'];
    $establishment = array();
    $establishmentAux = array();
    $establishmentFinal = array();
    $resultsSector = array();
    $totalSector = array();
    
    
    $inicio=$_POST['inicio'];
    $fin=$_POST['fin'];
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $establecimiento=$_POST['establecimiento'];
    
    
    //Connect with database.
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $html = "0;0;";
    
    $option = "no";
    $enter=false;
    if($radio == "locality"){
        
        if($distance == 0){
        
            $results = $dataBase->getEventsByLocality($province, $con);
            foreach ($results AS $result){
                if($result->getlocalidad()==$province){
                    $establishment[] = $result;
                }
            }
            $establishmentFinal = $establishment;
            
            $establishment = array();
        }else{
            $option = "si";
        
        }
    }else{
        $html = "$lat;$lng;";
        if($distance == 0){
            $option = "si";
        }else{
            $option = "si";
        
        }
    }
    
    if($option == "si"){
     
        $results = $dataBase->getAllEvents($con);
        
        
        $array[][]=" ";
        $resltF = array();
        $cont = 0;
        foreach ($results AS $result){
            $theta = $lng - $result->getlongitud();
            $dist = sin(deg2rad($lat)) * sin(deg2rad($result->getlatitud())) +  cos(deg2rad($lat)) * cos(deg2rad($result->getlatitud())) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $distan = $miles * 1.609344;
            
            $array[$cont][0]=$result;
            $array[$cont][1]=$distan;
            $cont = $cont+1;
        }
        if(count($array)>1){
            $arrayAux = array();
            $j="";
            $k="";
            for($j=1;$j<count($array);$j++){
                for($k=0;$k<count($array)-1;$k++){
                    if($array[$k][1]>$array[$k+1][1]){
                        $arrayAux = $array[$k];
                        $array[$k] = $array[$k+1];
                        $array[$k+1] = $arrayAux;      
                    }
                }    
            }
        }
        for($i=0;$i<count($array);$i<$i++){
            $resltF[] = $array[$i][0];
        }
        
        
        
        //All establishment.
        foreach ($resltF AS $result){
            $theta = $lng - $result->getlongitud();
            $dist = sin(deg2rad($lat)) * sin(deg2rad($result->getlatitud())) +  cos(deg2rad($lat)) * cos(deg2rad($result->getlatitud())) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $distan = $miles * 1.609344;
            
            
            if($distance==0){
                $establishment[] = $result;
            }else{
                if($distan<=$distance){
                    
                    $establishment[] = $result;                
                }
            }
        }
        $establishmentFinal = $establishment;
        $establishment = Array();
           
        
    }
    
   $idEstablecimiento="";
    //obtener id de establecimiento
   if($establecimiento!=""){
	    $datos=$dataBase->getEstablishmentByName($establecimiento, $con);
	    if($datos!=null){
	    	    $idEstablecimiento=$datos->getIdEstablishment();
	    }    
    }
    //Filter by sector.
    $resultsSector = $dataBase->getEventByData($arrayCategories,$inicio,$fin,$desde,$hasta,$idEstablecimiento,$con);
             $totalSector = $resultsSector;

    
       
    $aux = Array();
    if(count($establishmentFinal)==0){
        $establishmentFinal = $totalSector;
    }else{
        
        if(count($totalSector)==0){
            $establishmentFinal = Array();
        }else{
            
            foreach($establishmentFinal AS $f){
                foreach ($totalSector AS $r){
                    
                    if($f->getidEvento() == $r->getidEvento()){
                        
                        $aux[] = $r;
                    }
                }
            }
        }
    }  
    
    $establishmentFinal =  $aux;
    $esta = array();
    $establecimiento = array();
    $c = 0;
    $find=false;
    if(count($establishmentFinal)>0){
        
        foreach($establishmentFinal AS $estab){
            if(count($esta)>0){
               foreach($esta AS $e){
                   if($estab->getidEvento()==$e->getidEvento()){
                       $find = true;
                   }
               }
               if(!$find){
                   $esta[] = $estab;
               }
               $find = false;
            }else{
                $esta[] = $estab;
            }
        }
        
        foreach($esta as $e){
            if($c<30){
                $establecimiento[] = $e;
            }
            $c=$c+1;
        }
        
        //foreach($establishmentFinal as $est){
          foreach($establecimiento as $est){
            $html .= $est->getidEvento();
            $html .= ";";
            $html .= $dataBase->getEventById($est->getidEvento(), $con)->getnombre();
            $html .= ";";
            $html .= $est->getlatitud();
            $html .= ";";
            $html .= $est->getlongitud();
            $html .= ";";
            $html .= eventType($est->getidTipo());
            $html .= ";";
            $html .= $est->getlocalidad();
            $html .= ";";
        }
    }
    $html = substr( $html, 0, strlen($html));
    //Reply with information.
    $response = array("establishments"=>$html);
    echo json_encode($response);
    //Disconnect database.
    $dataBase->disconnectDataBase($con);
}

    function eventType($id){
                       
            $array=array("","Charla/conferencia","Videoforum","Presentación de libro","Encuentro con productores","Exposición","Actividad infantil","Degustación de productos","Taller formativo","Manifestación");
                        
            return $array[$id];
        }



?>