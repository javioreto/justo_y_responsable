<?php
session_start();
if(!isset($_SESSION["lang"])){
    $_SESSION["lang"] = "es_ES";
}
$LOCALE = $_SESSION["lang"];
putenv('LANG=' . $LOCALE);
setlocale(LC_ALL, $LOCALE.'.UTF-8');
bindtextdomain('messages',dirname(__FILE__).'/locale');
textdomain('messages');
?>