<?php
//Get session.
session_start();
    
if(isset($_POST['language'])){
    //Get params
    $language = $_POST['language'];
    $lang = "";
    if($language=="english"){
        $lang = "en_US";
    }else{
        if($language=="spain"){
            $lang = "es_ES";
        }
    }
    
    switch($language){
	    case "spain":	$lang = "es_ES";
	    				break;
	
	    case "english":	$lang = "en_US";
	    				break;
	    				
	    case "eus":		$lang = "es_ES";
	    				break;
	
	    case "cat":		$lang = "es_ES";
	    				break;
	    				
	    case "gal":		$lang = "es_ES";
	    				break;  
	    				
	    default: 		$lang = "es_ES";
    }
    
    $_SESSION["lang"] = $lang;
        
    $html = "";
    //Reply with information
    $response = array("html"=>$html);
    echo json_encode($response);   
}

?>