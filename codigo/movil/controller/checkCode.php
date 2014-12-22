<?php
if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}
    
//Connect with database.
$barcode=$_REQUEST['barcode'];
$cod = explode(" ", $barcode);

$dataBase = new dataBase();
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
$results = $dataBase-> checkProductsByCode($cod[1],$con);

echo $results;
//Disconnect database.
$dataBase->disconnectDataBase($con);

?>