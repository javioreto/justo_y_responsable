<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}


session_start();

$name = $_POST["name"];

$admin =  $_SESSION["admin"];

$address = $_POST["adr"];

$postcode = $_POST["cp"];

$latitude = $_POST["miLat"];

$longitude = $_POST["miLng"];
   
$locality = $_POST["locality"];
   
$descripcion = $_POST["descripcion"];

$fecha = $_POST["fecha"];

$inicio = $_POST["inicio"];

$fin = $_POST["fin"];

$tipo = $_POST["tipo"];

$sector = $_POST["selectSector"];

$type = $_POST["selectType"];

$id=$_SESSION["idEvent"];

$userselect = $_POST["selectUsers"];


//Connect with the database
$dataBase = new dataBase();
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());

//insert the establishment and return the id of that establishment.


$id = $dataBase->updateEvent($id,$name,$address,$postcode,$latitude,$longitude,$locality,
$descripcion,$fecha,$inicio,$inicio,$fin,$tipo,$userselect,$con);
               

//disconnect the database
$dataBase->disconnectDataBase($con);

//redirect
if($_SESSION["admin"]==1){
header('Location:../view/gestionEventos.php?st=2');
}else{
header('Location:../view/gestionEstablishment.php');
}
?>