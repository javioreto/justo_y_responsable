<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

   
if(isset($_POST['dni']) && isset($_POST['password'])){
    //get the params
    $dni = $_POST['dni'];
    $password = $_POST['password'];
    
    //Connect with the database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $html = "no;";
    //get user by dni
    $user = $dataBase->getUserByDni($dni,$con);
    
    if($user!=""){
        if((md5($password))==$user->getPassword()){   
            if($user->getValid()!=0){
                session_start();
                $_SESSION["iduser"] = $user->getIdUser();
                $_SESSION["admin"] = $user->getAdmin();
            }
            $html = "si;";
            $html .= $user->getAdmin();
            $html .= ";";
            $html .= $user->getValid();
            $html .= ";";
            $html .= $user->getIdUser();
            $html .= ";";
        }
    }

       
    $html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("user"=>$html);
    echo json_encode($response);
    //disconnect database
    $dataBase->disconnectDataBase($con);
}


?>