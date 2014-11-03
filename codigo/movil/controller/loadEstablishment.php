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
$results = $dataBase->getEstablishment($con);
$html = "";
foreach($results as $result){
    $html .= $result->getName();
    $html .= ";";
    $html .= $result->getLatitude();
    $html .= ";";
    $html .= $result->getLongitude();
    $html .= ";";
    $html .= $result->getSector()->getName();
    $html .= ";";
    $html .= $result->getLocation();
    $html .= ";";
}
$html = substr( $html, 0, strlen($html));
//Reply with information
$response = array("establishments"=>$html);
echo json_encode($response);
//Disconnect database.
$dataBase->disconnectDataBase($con);

?>