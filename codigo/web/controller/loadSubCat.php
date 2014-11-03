<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

include_once ("../init.php");

if(isset($_POST['idCateg'])){
    //get param
    $id = $_POST['idCateg'];
    //connect with database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
    //get subcategories
    $arraySubCat = $dataBase->getSubCategories($id, $con);
    $html = "no;";
    
    if(count($arraySubCat)>0){
        $html = "si;";
        
        foreach($arraySubCat AS $subCat){
            $html .= $subCat->getIdCategory();
            $html .= ";";
            $html .= $subCat->getName();
            $html .= ";";
        }
    }
       
    $html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("categ"=>$html);
    echo json_encode($response);
    //disconnect database 
    $dataBase->disconnectDataBase($con);
}


?>