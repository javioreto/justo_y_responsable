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


session_start();


//get params
$name = $_POST["name"];
$admin =  $_SESSION["admin"];

$logo = "";


$address = $_POST["adr"];

$postcode = $_POST["cp"];

$latitude = $_POST["miLat"];

$longitude = $_POST["miLng"];
   
$locality = $_POST["locality"];
   
$phone = $_POST["phone"];

$email = $_POST["email"];

$webpage = $_POST["site"];


$schedule = $_POST["schedule"];

if(isset($_POST["network"])){
    $network=$_POST["network"];    
}else{
    $network="";
}

if(isset($_POST["orgimp"])){
    $orgimp=$_POST["orgimp"];    
}else{
    $orgimp="";
}

if(isset($_POST["chface"])){
    $chface = $_POST["chface"];
    if($_POST["chface"]){
        $facebook = $_POST["inputFacebook"];
    }
}else{
    $chface = "";
    $facebook = "";
}

if(isset($_POST["chtwitter"])){
    $chtwitter = $_POST["chtwitter"];
    if($_POST["chtwitter"]){
        $twitter = $_POST["inputTwitter"];
    }
}else{
    $chtwitter = "";
    $twitter = "";
}

if(isset($_POST["cash"])){
    $chcash = $_POST["cash"];
    if($_POST["cash"]){
        $cash = 1;
    }
}else{
    $cash = 0;
    $chcash = "";
}

if(isset($_POST["card"])){
    $chcard = $_POST["card"];
    if($_POST["card"]){
        $card = 1;
    }
}else{
    $card = 0;
    $chcard = "";
}

if(isset($_POST["disableaccess"])){
    $chdisableaccess = $_POST["disableaccess"];
    if($_POST["disableaccess"]){
        $disableaccess = 1;
    }
}else{
    $disableaccess = 0;
    $chdisableaccess = "";
}

if(isset($_POST["online"])){
    $online=$_POST["online"];    
}else{
    $online=0;
}


$sector = $_POST["selectSector"];

$type = $_POST["selectType"];

$userselect = "";
if(isset($_POST["selectUsers"])){
    $userselect = $_POST["selectUsers"];
}

$arrayids = "";
$arrayid = $_POST["idproducts"];
if($arrayid!=""){
    $arrayids = split (";", $arrayid);
}

$refiduser = $_SESSION["iduser"];

//Connect with the database
$dataBase = new dataBase();
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
$mailingSystem=new mailingSystem();

//insert the establishment and return the id of that establishment.
if($userselect!=""){
$id = $dataBase->insertEstablishment($name, $phone, $email, $logo,$cash,$card,$postcode,$address, $webpage, 
        $schedule,$facebook,$twitter,$disableaccess,$latitude,$longitude,$locality,$type, $sector, $userselect, $online, $con);
        $mailingSystem->newEstablishment($name,$locality);
}else{
$id = $dataBase->insertEstablishment($name, $phone, $email, $logo,$cash,$card,$postcode,$address, $webpage, 
    $schedule,$facebook,$twitter,$disableaccess,$latitude,$longitude,$locality,$type, $sector, $refiduser, $online ,$con);
    $mailingSystem->newEstablishment($name,$locality);
}

//if the array of products are different of empty string insert the products.
if($arrayids!=""){
    $dataBase->insertProductsEstablishment($id, $arrayids,$con);   
}

//insert the network of establishment.
$dataBase->insertOrgPerEstablishment($id, $network,$con);

//insert the import organizations of establishment.
$dataBase->insertOrgImpEstablishment($id, $orgimp,$con);

$uploaddir = "../../images/";
$namexml  = basename($_FILES['uploadedfile']['name']);
if($namexml!=""){
    $extension = pathinfo($namexml, PATHINFO_EXTENSION);
    $newname       = $id.'.'.$extension;
    
    $logo = $uploaddir . $newname;
    move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $logo);
    
    
    if($userselect!=""){
    $dataBase->updateEstablishment($id, $name, $phone, $email, $logo,$cash,$card,$postcode,$address, $webpage, 
        $schedule,$facebook,$twitter,$disableaccess,$latitude,$longitude,$locality,$type, $sector, $userselect, $online, $con);
    }else{
    $dataBase->updateEstablishment($id, $name, $phone, $email, $logo,$cash,$card,$postcode,$address, $webpage, 
        $schedule,$facebook,$twitter,$disableaccess,$latitude,$longitude,$locality,$type, $sector, $refiduser, $online, $con);
    }
}

//disconnect the database
$dataBase->disconnectDataBase($con);

//redirect
header('Location:../view/gestionEstablishment.php');
?>