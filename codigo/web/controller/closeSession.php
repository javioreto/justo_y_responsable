<?php 
  //close session
  session_start();
  session_unset();
  session_destroy();
  //redirect
  header("Location:../view/login.php");
?>