<?php

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

   
if(isset($_POST['dni']) && isset($_POST['pass'])){
    //get the params
    $dni = $_POST['dni'];
	$pass = $_POST['pass']; 
	
    //Connect with the database
    $dataBase = new dataBase();
    $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
   
   //change pass
    $dataBase->updatePassword($dni,$pass,$con);
      
        $html = "no;";
 		$html = substr( $html, 0, strlen($html));
    	//reply with information
   	 	$response = array("user"=>$html);
    	echo json_encode($response);
    
    //disconnect database
    $dataBase->disconnectDataBase($con);
}


?>