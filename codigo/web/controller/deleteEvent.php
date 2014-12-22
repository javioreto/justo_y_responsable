<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}


session_start();

$id = $_SESSION["idEvent"];


//Connect with the database
$dataBase = new dataBase();
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());

//insert the establishment and return the id of that establishment.


$id = $dataBase->deleteEvent($id,$con);
               

//disconnect the database
$dataBase->disconnectDataBase($con);

//redirect
if($_SESSION["admin"]==1){
header('Location:../view/gestionEventos.php?st=3');
}else{
header('Location:../view/gestionEstablishment.php');
}

?>