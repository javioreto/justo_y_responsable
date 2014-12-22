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
    
    if(isset($_POST['code'])){
   		$code = $_POST['code'];
    }else{
    	$code=null;
    }
    
     if(isset($_POST['img'])){
   		$img = $_POST['img'];
    }else{
    	$img="nofoto.jpg";
    }

    
    $date = date('Y/m/d H:i:s');
    
    //Connect with the database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    $html = "no;";
    //Insert products
    $id = $dataBase->insertProduct($name,$date,$description,$idCateg,$code, $img,$con);
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