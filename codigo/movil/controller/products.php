<?php
if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}
    
//Connect with database.
$id=$_REQUEST['cod'];

$dataBase = new dataBase();
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
$results = $dataBase-> getProductById($id,$con);
$categorias=$dataBase->getCategories($con);
$subcategorias=$dataBase->getAllSubCategories($con);

foreach($results as $result){
    $nombre= $result->getName();
    $descripcion= $result->getDescription();
    $img= $result->getImg();
    
    foreach($subcategorias as $subcat){
    	if($subcat->getIdCategory()==$result->getRef()){
    	    $subcategoria= $subcat->getName();
    	    $catsup=$subcat->getRefCategory();
    	}
    }


    foreach($categorias as $cat){
    	if($cat->getIdCategory()==$catsup){
    	    $categoria= $cat->getName();
    	}
    }
}

/*
foreach($results as $result){
    $html .= $result->getName();
    $html .= ";";
    $html .= $result->getDescription();
    $html .= ";";
    $html .= $result->getImg();
    $html .= ";";
}
$html = substr( $html, 0, strlen($html));
//Reply with information
$response = array("products"=>$html);

echo json_encode($response);
*/
//Disconnect database.
$dataBase->disconnectDataBase($con);

?>