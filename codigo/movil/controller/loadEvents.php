<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}
    
//Connect with database.
$dataBase = new dataBase();
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
$results = $dataBase->getAllEvents($con);
$html = "";
foreach($results as $result){
    $html .= $result->getnombre();
    $html .= ";";
    $html .= $result->getlatitud();
    $html .= ";";
    $html .= $result->getlongitud();
    $html .= ";";
    $html .= eventType($result->getidTipo());
    $html .= ";";
    $html .= $result->getlocalidad();
    $html .= ";";
}
$html = substr( $html, 0, strlen($html));
//Reply with information
$response = array("establishments"=>$html);
echo json_encode($response);
//Disconnect database.
$dataBase->disconnectDataBase($con);

		function eventType($id){
                       
            $array=array("","Charla/conferencia","Videoforum","Presentación de libro","Encuentro con productores","Exposición","Actividad infantil","Degustación de productos","Taller formativo","Manifestación");
                        
            return $array[$id];
        }


?>