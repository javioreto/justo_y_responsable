<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

if (is_file("controller/load.php")){
    include_once ("controller/load.php");
}
else {
    include_once ("../controller/load.php");
}

if (is_file("controller/mailingSystem.php")){
    include_once ("controller/mailingSystem.php");
}
else {
    include_once ("../controller/mailingSystem.php");
}


   
if(isset($_POST['arrayUsers'])){
    
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $mailingSystem = new mailingSystem();
    $html = "no;";
    
    $arrayUsers = $_POST['arrayUsers'];    
    
    if($arrayUsers[0] == "alluser"){
        $html = "si;";
        $dataBase->updateValidAllUser($con);
    }else{
        foreach($arrayUsers AS $us){
            $html = "si;";
            $mailingSystem->userAcepted($dataBase->updateValidUser($us,$con));
        }
    }
           
    $html = substr( $html, 0, strlen($html));
    $response = array("uservalid"=>$html);
    echo json_encode($response);
    $dataBase->disconnectDataBase($con);
}


?>