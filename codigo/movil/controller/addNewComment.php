<?php
session_start();

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


//get params and check.
if(isset($_POST['name']) && isset($_POST['text']) && isset($_POST['refE']) && ($_POST['captcha'])){
    //Connect with the DataBase.
    $mail = new mailingSystem();
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $date = date('Y/m/d H:i:s');
    $html = "si;";
    //Check if the captcha is correct.
    if (empty($_SESSION['captcha']) || strtolower(trim($_POST['captcha'])) != $_SESSION['captcha']) {
        $html = "no;";
    }else{
        //Insert comment.
        $dataBase->insertComment($_POST['name'],$date,$_POST['text'],$_POST['refE'],$con);  
        if($_POST['email']!=""){  
        	$mail->newComment($_POST['nombre'],"establecimiento ".$_POST['email'],"javioreto@gmail.com");
        }
    }
    $html .= $date;
    //Reply with information.
    $response = array("html"=>$html);
    echo json_encode($response);
    //Disconnect DataBase.
    $dataBase->disconnectDataBase($con);
}

?>