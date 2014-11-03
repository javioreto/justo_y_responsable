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
    //connect with database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $dataBase->deleteComment($id,$con);
    $html = "";   
    $html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("idproduct"=>$html);
    echo json_encode($response);
    //disconnect database 
    $dataBase->disconnectDataBase($con);
}


?>