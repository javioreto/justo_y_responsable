<?php
		 	session_start();
			session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SIGC - Logging</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" />
<link href="css/objetos.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div style="margin-top:20px; margin-left:20px; background:url(img/logo_comercio.png) no-repeat; width:205px;; height:275px;">
</div>
<div id="loging">
 <div id="texto_loging">
		  <span class="titulo_azul">
		  <?php 
		  if($_REQUEST[error]==NULL){
		  echo"Acceso a Zona Privada de Usuario"; 
		  }else{
		  if($_REQUEST[error]==1){
		  echo "Usuario y/o contraseña erronea";
		  }
		  if($_REQUEST[error]==2){
		  echo "La sesión se ha cerrado correctamente";
		  }
		  }
		  ?></span> <br />
		  <br />
		<form id="acceder" name="acceder" method="post" action="logging.php">
 			<table width="250" height="105" border="0" align="center"><tr>
            <td><div align="right" class="titulo_azul">
             Usuario
            </div>              </td>
            <td><input name="usuario" type="text" class="campos" id="usuario" /></td>
          </tr>
          <tr>
            <td><div align="right" class="titulo_azul"> Contrase&ntilde;a </div></td>
            <td><input name="contrasena" type="password" class="campos" id="contrasena" /></td>
          </tr>
          <tr>
            <td></td>
            <td>		<div class="boton_azul" style="margin:10px;"><a href="#" onclick="document.acceder.submit();">Entrar</a></div></td>
          </tr>
        </table>
		</form>
		</div>
</div>
</body>
</html>
