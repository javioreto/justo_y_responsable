<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}
	
	
if(isset($_POST['province']) && isset($_POST['distance'])){
    //Connect withh database.
	$dataBase = new dataBase();
	$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
	$results = $dataBase->getLocationForEstablishment($con);
    $html = "";
    foreach($results as $result){
        $html .= $result->getName();
        $html .= ";";
        $html .= $result->getLatitude();
        $html .= ";";
        $html .= $result->getLongitude();
        $html .= ";";
        $html .= $result->getOrganizationType()->getName();
        $html .= ";";
    }
    $html = substr( $html, 0, strlen($html));
    //Reply with information.
    $response = array("establishments"=>$html);
    echo json_encode($response);
    //Disconnect database.
    $dataBase->disconnectDataBase($con);
}

?>