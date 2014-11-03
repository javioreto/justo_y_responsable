<?php
session_start();
    
if(isset($_POST['language'])){
    //get param
    $language = $_POST['language'];
    //change the session param
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
    //reply with information
    $response = array("html"=>$html);
    echo json_encode($response);
    
}

?>