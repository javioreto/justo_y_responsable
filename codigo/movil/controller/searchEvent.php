<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

/**
 * Class responsible for communicating with the class database.
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 * 
 */
class Search{
    
    /**
     * Check the database connect.
     */
     public static function checkDBConnect(){
         $dataBase = new dataBase();
         $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
         if(!$con){
             header('Location:../view/errorBd.php');
         }  
     }
    
    /**
     * Method that returns the ten nearest establishments to the current location.
     * 
     * @param lat the current latitude
     * @param lng the current longitude
     */
    public static function searchEventNear($lat,$long){
        $array[][]=" ";
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        $establishment = $dataBase->getAllEvents($con);
        if(count($establishment)>0){
            for($i = 0 ; $i < count($establishment) ; $i ++){
                $array[$i][0]=$establishment[$i];
                
                $theta = $long - $establishment[$i]->getlongitud();
                $dist = sin(deg2rad($lat)) * sin(deg2rad($establishment[$i]->getlatitud())) +  cos(deg2rad($lat)) * cos(deg2rad($establishment[$i]->getlatitud())) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $distance = $miles * 1.609344;
                
                
                $array[$i][1]=$distance;
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
            
            
            for($h=0;$h<count($array) && $h<10 ;$h++){
					if(substr($array[$h][1],0,4)<50){
                    echo "<li>";
                        echo"<a data-ajax='false' href='informationEvent.php?idEvent=".$array[$h][0]->getidEvento()."'>
                           <table class='tablelist'>
                                <tr>
                                    <td id='content'>
                                    <div style='margin:0px 10px;'>
                                        <h1>" . $array[$h][0]->getnombre() . " - " . Search::eventType($array[$h][0]->getidTipo()) . "</h1>
                                        <p>" . $array[$h][0]->getdireccion() . ", " . $array[$h][0]->getlocalidad() . "</p>
                                        <p>Distancia de: " . substr($array[$h][1],0,4) . " Km</p>
                                     </div>
                                    </td>
                                </tr>
                            </table> 
                        </a>
                    </li>";
                    }
                
            }
        }else{
            echo "<p> No existen eventos </p>";
        }
        $dataBase->disconnectDataBase($con);
        return $establishment;
    }
    
    /**
     * Method that return the establishment for Madrid.
     * 
     * @return establishment the establishments
     */
    public static function searchEventMadrid(){
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        $events = $dataBase->getEventsInMadrid($con);
        
        $dataBase->disconnectDataBase($con);
        return $events;
    }
    
        /**
     * Method that returns the establishment by id.
     * 
     * @param id the establishment id
     * 
     * @return establishment the establishment
     */
    public static function searchEstablishmentById($id){
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        
        $establishment = $dataBase->getEstablishmentById($id, $con);
        $dataBase->disconnectDataBase($con);
        return $establishment;
    }


           /**
         * Static method that returns all events included in the database.
         * 
         * @return array of events 
         */
        public static function searchEventById($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $event = $dataBase->getEventById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $event;
        }
        
    
    /**
     * Method that returns the establishment by array of id.
     * 
     * @param arrayid the array of ids
     * 
     * @return establishment array of establishment
     */
    public static function searchEventsByArrayId($arrayid){
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        
        $event = array();
        $i = 0;
        foreach ($arrayid AS $id){
            $event[$i] = $dataBase->getEventById($id, $con);
            $i = $i + 1;
        }
        
        $dataBase->disconnectDataBase($con);
        return $event;
    }
    
    /**
     * Method that returns the nearest establishment by arrayE.
     * 
     * @param lat the current latitude
     * @param lng the current longitude
     * @param arrayE the establishments
     * 
     * @return establishment the establishment
     */
    public static function searchEventNearByArrayId($lat, $long, $arrayE){
        
        $array[][]=" ";
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        $establishment = array();
        $i = 0;
        foreach ($arrayE AS $id){
            $establishment[$i] = $dataBase->getEventById($id, $con);
            $i = $i + 1;
        }
        for($i = 0 ; $i < count($establishment) ; $i ++){
            $array[$i][0]=$establishment[$i];
            
            $theta = $long - $establishment[$i]->getlongitud();
            $dist = sin(deg2rad($lat)) * sin(deg2rad($establishment[$i]->getlatitud())) +  cos(deg2rad($lat)) * cos(deg2rad($establishment[$i]->getlatitud())) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $distance = $miles * 1.609344;
            
            
            $array[$i][1]=$distance;
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
        
        for($h=0;$h<count($array) ;$h++){
        
        echo "<li>";
                        echo"<a data-ajax='false' href='informationEvent.php?idEvent=".$array[$h][0]->getidEvento()."'>
                           <table class='tablelist'>
                                <tr>
                                    <td id='content'>
                                    <div style='margin:0px 10px;'>
                                        <h1>" . $array[$h][0]->getnombre() . " - " . Search::eventType($array[$h][0]->getidTipo()) . "</h1>
                                        <p>" . $array[$h][0]->getdireccion() . ", " . $array[$h][0]->getlocalidad() . "</p>
                                        <p>Distancia de: " . substr($array[$h][1],0,4) . " Km</p>
                                     </div>
                                    </td>
                                </tr>
                            </table> 
                        </a>
                    </li>";                            
               
        }
            
    $dataBase->disconnectDataBase($con);
    }
       
    /**
     * Method that return the correct character.
     * 
     * @return the correct string
     */
    public static function changeCharacter($str){
        $s = "";
        $s = str_replace("á","a",$str);
        $s = str_replace("é","e",$str);
        $s = str_replace("í","i",$str);
        $s = str_replace("ó","o",$str);
        $s = str_replace("ú","u",$str);
        $s = str_replace("Á","A",$str);
        $s = str_replace("É","E",$str);
        $s = str_replace("Í","I",$str);
        $s = str_replace("Ó","O",$str);
        $s = str_replace("Ú","U",$str);
        return $s;
    } 
    
    public static function eventType($id){
                       
            $array=array("","Charla/conferencia","Videoforum","Presentación de libro","Encuentro con productores","Exposición","Actividad infantil","Degustación de productos","Taller formativo","Manifestación");
                        
            return $array[$id];
        }
        
    public static function eventArray(){
                       
            $array=array("Charla/conferencia","Videoforum","Presentación de libro","Encuentro con productores","Exposición","Actividad infantil","Degustación de productos","Taller formativo","Manifestación");
                        
            return $array;
        }

}
?>