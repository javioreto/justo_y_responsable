<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

   
if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['idCateg'])){
    //get the params
    $name = $_POST['name'];
    $description = $_POST['description'];
    $idCateg = $_POST['idCateg'];
    $date = date('Y/m/d H:i:s');
    
    //Connect with the database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $html = "no;";
    //Insert products
    $id = $dataBase->insertProduct($name,$date,$description,$idCateg,$con);
    $html = "si;";
    
    $html .= $id;
    $html .= ";";       
    $html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("product"=>$html);
    echo json_encode($response);
    //disconnect the database
    $dataBase->disconnectDataBase($con);
}


?>