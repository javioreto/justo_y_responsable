<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

if (is_file("controller/mailingSystem.php")){
    include_once ("controller/mailingSystem.php");
}
else {
    include_once ("../controller/mailingSystem.php");
}
   
if(isset($_POST['dni'])){
    //get the params
    $dni = $_POST['dni'];
    
    $mailingSystem=new mailingSystem();

    //Connect with the database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $html = "no;";
    //get user by dni
    $user = $dataBase->getUserByDni($dni,$con);
    
    if($user!=""){
            $mailingSystem->restorePass($dni,$user->getEmail());         
    }

    $html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("user"=>$html);
    echo json_encode($response);
    //disconnect database
    $dataBase->disconnectDataBase($con);
}


?>