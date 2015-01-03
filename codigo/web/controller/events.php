<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

include_once ("../init.php");

if(isset($_POST['id'])){

	$id=$_POST['id'];
	$type=$_POST['type'];
	$action=$_POST['action'];
	
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
 

	if($action==1){
   	//aceptar
   		switch($type){	
   		case 1: if($dataBase->userOk($id, $con)){
	    	     $html = "OK";
	            }
	            break; 

   		case 2: if($dataBase->estOk($id, $con)){
	    	     $html = "OK";
	            }
	            break; 
	            
	   	case 3: if($dataBase->prodOk($id, $con)){
	    	     $html = "OK";
	            }
	            break; 

   		case 4: if($dataBase->eventOk($id, $con)){
	    	     $html = "OK";
	            }
	            break;  
	    case 5: if($dataBase->commentOk($id, $con)){
	    	     $html = "OK";
	            }
	            break;      
	    }    
    }else{
    //cancelar
       	switch($type){	
	    case 5: if($dataBase->commentCancel($id, $con)){
	    	     $html = "OK";
	            }
	            break;      
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