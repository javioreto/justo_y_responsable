<?php
session_start();

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

   
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['dni']) && isset($_POST['password'])
         && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['captcha']) && isset($_POST['adminch'])){
    //get the params
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $dni = $_POST['dni'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $admin = $_POST['adminch'];   
    $html = "si;";
    
    //Connect with the database
    $dataBase = new dataBase();
    $exist = false;
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    
    //get user by dni
    $user = $dataBase->getUserByDni($dni,$con);
    if($user != ""){
        $exist = true;
    }
    //Check that the captcha is correct and insert the user
    if (empty($_SESSION['captcha']) || strtolower(trim($_POST['captcha'])) != $_SESSION['captcha']) {
        $html = "no;";
    }else{
        if($exist){
            $html = "exist;";
        }else{
            if(isset($_SESSION["admin"])){
                if($_SESSION["admin"]==1){
                    $dataBase->insertUserValid($name, $surname, $dni, md5($password), $phone, $email,$admin,$con);
                }else{
                    $dataBase->insertUser($name, $surname, $dni, md5($password), $phone, $email,$admin,$con);
                }
            }else{
                $dataBase->insertUser($name, $surname, $dni, md5($password), $phone, $email,$admin,$con);
            }
        }
        
    }
    
    if(isset($_SESSION['iduser'])){
        $html .= "session";
    }else{
        $html .= "nosession";
    }
    //reply with information
    $response = array("html"=>$html);
    echo json_encode($response);
    //disconnect database 
    $dataBase->disconnectDataBase($con);
}


?>