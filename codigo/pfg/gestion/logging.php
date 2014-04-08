<?php
/* usuario= admin
 contraseña=123456 */
if($_REQUEST[usuario]=="admin" && md5($_REQUEST[contrasena])=="e10adc3949ba59abbe56e057f20f883e"){
 session_start();
 $_SESSION[usuario] = true;
 $_SESSION[dni] = $_REQUEST[usuario];
 $_SESSION[nombre] = "Administrador";
 $_SESSION[clave] = $_REQUEST[contrasena];    
     
header("location:inicio.php");
}else{
header("location:index.php?error=1");
}
?>