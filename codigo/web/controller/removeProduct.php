<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

   
if(isset($_POST['arrayProducts'])){
    //get param
    $arrayProducts = $_POST['arrayProducts'];
    //connect with database        
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $html = "no;";
    foreach ($arrayProducts AS $ap){
        $dataBase->deleteProduct($ap,$con);
        $html = "si;";
    }       
    $html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("deleteProduct"=>$html);
    echo json_encode($response);
    //disconnect database 
    $dataBase->disconnectDataBase($con);
}


?>