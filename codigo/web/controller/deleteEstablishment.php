<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

   
if(isset($_POST['id'])){
    //get param
    $id = $_POST['id'];
    //Connect with the database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $html = "no;";
    //delete the establishment
    $dataBase->deleteEstablishment($id,$con);
    $html = "si;";   
    $html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("establishment"=>$html);
    echo json_encode($response);
    //disconnect database
    $dataBase->disconnectDataBase($con);
}


?>