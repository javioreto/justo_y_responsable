<?php
session_start();
if(!$_SESSION[usuario]) 
{
header("Location: index.php?error=3");
exit; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SIGC</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" />
<link href="css/objetos.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../js/scripts.js"></script>

</head>

<body>
<table height="100%" class="cuerpo" style="height:330px;">
<tr>
<td valign="top">

  <p><strong>Modificar</strong> ejemplo</p>
  <form action="popup_.php" name="modificar" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabla">    
    <tr class="tabla_tit">
    <td>Id</td>
    <td>Nombre</td>
    <td>Apellidos</td>
    <td>Email</td>
  </tr>
  
<tr><td><input name="id" readonly="readonly" type="text" value="" /></td>
    <td><input name="nombre" type="text" value="" /></td>
    <td><input name="apellidos" type="text" value="" /></td>
    <td><input name="email" type="text" value="" /></td>
  </tr>
  

</table>
</form>
<div class="boton_gris" style="margin:10px; float:right; display:inline; width:100px;"><a href="javascript: document.modificar.submit();" style="color:#FFFFFF;" title="Guardar">Guardar</a></div>
<div class="boton_azul" style="margin:10px; float:right; display:inline; width:100px;"><a href="popup_.php?accion=2&amp;id=" onclick="return confirm('¿Desea eliminar esta reserva?');" style="color:#FFFFFF;" title="Eliminar">Eliminar</a></div>
  </td>
</tr>
</table>
</body>
</html>

