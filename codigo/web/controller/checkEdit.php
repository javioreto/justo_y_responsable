<?php
session_start();

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

   
if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['dni']) && isset($_POST['password'])
         && isset($_POST['phone']) && isset($_POST['oldpass'])  && isset($_POST['email'])){
    //get the params
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $dni = $_POST['dni'];
    $oldpass = $_POST['oldpass'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];   
    $html = "si;";
    
    //Connect with the database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    //Update the user
    if($password!=""){
        $dataBase->updateUser($id, $name, $surname, md5($password), $dni, $phone, $email, $con);
    }else{
        $dataBase->updateUser($id, $name, $surname, $oldpass, $dni, $phone, $email, $con);
    }
    //reply with information
    $response = array("html"=>$html);
    echo json_encode($response);
    //disconnect database
    $dataBase->disconnectDataBase($con);
}


?>