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
    public static function searchEstablishmentNear($lat,$long){
        $array[][]=" ";
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        $establishment = $dataBase->getEstablishment($con);
        if(count($establishment)>0){
            for($i = 0 ; $i < count($establishment) ; $i ++){
                $array[$i][0]=$establishment[$i];
                
                $theta = $long - $establishment[$i]->getLongitude();
                $dist = sin(deg2rad($lat)) * sin(deg2rad($establishment[$i]->getLatitude())) +  cos(deg2rad($lat)) * cos(deg2rad($establishment[$i]->getLatitude())) * cos(deg2rad($theta));
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
                if($array[$h][0]->getLogo()==""){
                    echo "<li>";
                    if($array[$h][0]->getSector()->getName()=="Comercio justo"){
                        echo"<a style='background-color: #B5D6E6' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Banca etica"){
                        echo"<a style='background-color: #E6CCE4' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Economia solidaria"){
                        echo"<a style='background-color: #B5E6BF' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Consumidores y usuarios organizados"){
                        echo"<a style='background-color: #FAE69A' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }   
                        echo"<table class='tablelist'>
                                <tr>
                                    <td style='width:100px;'>
                                        <div id='imglist' >
                                            <img src=../../images/nofoto.jpg>
                                        </div>
                                    </td>
                                    <td id='content'>
                                        <h1>" . $array[$h][0]->getName() . "</h1>
                                        <p>" . $array[$h][0]->getAddress() . ", " . $array[$h][0]->getLocation() . "</p>
                                        <p>Distancia de: " . substr($array[$h][1],0,4) . " Km</p>
                                    </td>
                                </tr>
                            </table> 
                        </a>
                    </li>";
                }else{
                    echo "
                        <li>";
                            if($array[$h][0]->getSector()->getName()=="Comercio justo"){
                                echo"<a style='background-color: #B5D6E6' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                            }
                            if($array[$h][0]->getSector()->getName()=="Banca etica"){
                                echo"<a style='background-color: #E6CCE4' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                            }
                            if($array[$h][0]->getSector()->getName()=="Economia solidaria"){
                                echo"<a style='background-color: #B5E6BF' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                            }
                            if($array[$h][0]->getSector()->getName()=="Consumidores y usuarios organizados"){
                                echo"<a style='background-color: #FAE69A' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                            }
                            echo "<table class='tablelist'>
                                <tr>
                                    <td style='width:100px;'>
                                        <div id='imglist' >
                                        <img src='" . $array[$h][0]->getLogo(). "'>
                                        </div>
                                    </td>
                                    <td id='content'>
                                        <h1>" . $array[$h][0]->getName() . "</h1>
                                        <p>" . $array[$h][0]->getAddress() . ", " . $array[$h][0]->getLocation() . "</p>
                                        <p>Distancia de: " . substr($array[$h][1],0,4) . " Km</p>
                                    </td>
                                </tr>
                            </table>
                            </a>
                        </li>";
                }
            }
        }else{
            echo "<p> No existen establecimientos </p>";
        }
        $dataBase->disconnectDataBase($con);
        return $establishment;
    }
    
    /**
     * Method that return the establishment for Madrid.
     * 
     * @return establishment the establishments
     */
    public static function searchEstablishmentMadrid(){
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        $establishment = $dataBase->getEstablishmentInMadrid($con);
        
        $dataBase->disconnectDataBase($con);
        return $establishment;
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
     * Method that returns the establishment by array of id.
     * 
     * @param arrayid the array of ids
     * 
     * @return establishment array of establishment
     */
    public static function searchEstablishmentByArrayId($arrayid){
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        
        $establishment = array();
        $i = 0;
        foreach ($arrayid AS $id){
            $establishment[$i] = $dataBase->getEstablishmentById($id, $con);
            $i = $i + 1;
        }
        
        $dataBase->disconnectDataBase($con);
        return $establishment;
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
    public static function searchEstablishmentNearByArrayId($lat, $long, $arrayE){
        
        $array[][]=" ";
        $dataBase = new dataBase();
        $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
        $establishment = array();
        $i = 0;
        foreach ($arrayE AS $id){
            $establishment[$i] = $dataBase->getEstablishmentById($id, $con);
            $i = $i + 1;
        }
        for($i = 0 ; $i < count($establishment) ; $i ++){
            $array[$i][0]=$establishment[$i];
            
            $theta = $long - $establishment[$i]->getLongitude();
            $dist = sin(deg2rad($lat)) * sin(deg2rad($establishment[$i]->getLatitude())) +  cos(deg2rad($lat)) * cos(deg2rad($establishment[$i]->getLatitude())) * cos(deg2rad($theta));
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
            if($array[$h][0]->getLogo()==""){
                echo "
                <li>";
                    if($array[$h][0]->getSector()->getName()=="Comercio justo"){
                        echo"<a style='background-color: #B5D6E6' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Banca etica"){
                        echo"<a style='background-color: #E6CCE4' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Economia solidaria"){
                        echo"<a style='background-color: #B5E6BF' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Consumidores y usuarios organizados"){
                        echo"<a style='background-color: #FAE69A' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                echo "<table class='tablelist'>
                                <tr>
                                    <td style='width:100px;'>
                                        <div id='imglist' >
                                            <img src='../../images/nofoto.jpg'>
                                        </div>
                                    </td>
                                    <td id='content'>
                                        <h1>" . $array[$h][0]->getName() . "</h1>
                                        <p>" . $array[$h][0]->getAddress() . ", " . $array[$h][0]->getLocation() . "</p>
                                        <p>Distancia de: " . substr($array[$h][1],0,4) . " Km</p>
                                    </td>
                                </tr>
                            </table>
                            </a>
                        </li>";
            }else{
                echo "
                <li>";
                if($array[$h][0]->getSector()->getName()=="Comercio justo"){
                        echo"<a style='background-color: #B5D6E6' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Banca etica"){
                        echo"<a style='background-color: #E6CCE4' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Economia solidaria"){
                        echo"<a style='background-color: #B5E6BF' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    if($array[$h][0]->getSector()->getName()=="Consumidores y usuarios organizados"){
                        echo"<a style='background-color: #FAE69A' data-ajax='false' href='information.php?idEstablecimiento=".$array[$h][0]->getIdEstablishment()."'>";
                    }
                    
                      echo "<table class='tablelist'>
                                <tr>
                                    <td style='width:100px;'>
                                        <div id='imglist' >
                                            <img src='" . $array[$h][0]->getLogo(). "'>
                                        </div>
                                    </td>
                                    <td id='content'>
                                        <h1>" . $array[$h][0]->getName() . "</h1>
                                        <p>" . $array[$h][0]->getAddress() . ", " . $array[$h][0]->getLocation() . "</p>
                                        <p>Distancia de: " . substr($array[$h][1],0,4) . " Km</p>
                                        
                                    </td>
                                </tr>
                            </table>
                            </a>
                        </li>";
            }
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
}
?>