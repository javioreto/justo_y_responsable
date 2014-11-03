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
    
    $_SESSION["lang"] = $lang;
        
    $html = "";
    //Reply with information
    $response = array("html"=>$html);
    echo json_encode($response);
    
}

?>