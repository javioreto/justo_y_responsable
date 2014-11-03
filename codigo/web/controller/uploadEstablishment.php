<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}
//start session
session_start();

$idestablecimientoedit = $_SESSION["idEstablishmentEdit"];
//get params
$name = $_POST["name"];


$logo="";
$uploaddir = "../../images/";
$namexml  = basename($_FILES['uploadedfile']['name']);
$extension = pathinfo($namexml, PATHINFO_EXTENSION);
$newname       = $idestablecimientoedit.'.'.$extension;
$nameimg = $uploaddir . $newname;

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$nameimg)) {
    $logo = $nameimg;
}


if($logo==""){
    $logo = $_POST["stringlogo"];
}

$address = $_POST["adr"];

$postcode = $_POST["cp"];

$latitude = $_POST["miLat"];

$longitude = $_POST["miLng"];
   
$locality = $_POST["locality"];
   
$phone = $_POST["phone"];

$email = $_POST["email"];

$webpage = $_POST["site"];


$schedule = $_POST["schedule"];

$network=$_POST["network"];

$orgimp=$_POST["orgimp"];

$facebook = "";
if(isset($_POST["chface"])){
    if($_POST["chface"]){
        $facebook = $_POST["inputFacebook"];
    }
}

$twitter = "";
if(isset($_POST["chtwitter"])){
    if($_POST["chtwitter"]){
        $twitter = $_POST["inputTwitter"];
    }
}

$cash = 0;
if(isset($_POST["cash"])){
    if($_POST["cash"]){
        $cash = 1;
    }
}

$card = 0;
if(isset($_POST["card"])){
    if($_POST["card"]){
        $card = 1;
    }
}

$disableaccess = 0;
if(isset($_POST["disableaccess"])){
    if($_POST["disableaccess"]){
        $disableaccess = 1;
    }
}

$sector = $_POST["selectSector"];

$type = $_POST["selectType"];

$arrayids = "";
$arrayid = $_POST["idproducts"];
$arraynew = $_POST["idproductsnew"];
$arrayidnew = $arrayid . $arraynew;
if($arrayidnew!=""){
    $arrayids = split (";", $arrayidnew);
}





//connect with database
$dataBase = new dataBase();
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());

if($sector!="1"){
    //if sector is equals to 1 delete de products
    $dataBase->deleteProducts($arrayids,$con);
}

//insert establishment
$iduser = $_POST["refuser"];
$dataBase->updateEstablishment($idestablecimientoedit, $name, $phone, $email, $logo,$cash,$card,$postcode,$address, $webpage, 
    $schedule,$facebook,$twitter,$disableaccess,$latitude,$longitude,$locality,$type, $sector, $iduser, $con);

if($arrayids!=""){
    $dataBase->updateProductsEst($idestablecimientoedit, $arrayids,$con);
}

$dataBase->updateOrgPerEstablishment($idestablecimientoedit, $network,$con);

$dataBase->updateOrgImpEstablishment($idestablecimientoedit, $orgimp,$con);



//disconnect the database
$dataBase->disconnectDataBase($con);

//redirect
if($_SESSION["gestionestablishment"]=="no"){
    $id = $_SESSION["selectedUser"];
    header('Location:../view/informationUser.php?id='.$id);
}else{
    header('Location:../view/gestionEstablishment.php');
}

?>