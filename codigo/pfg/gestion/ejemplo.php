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
<title>Fair Trade | Sistema de administraci&oacute;n</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" />
<link href="css/objetos.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<?php $estoy="ejemplo"; ?>
<?php include("includes/menu.php"); ?>


<table height="100%" width="90%" class="cuerpo">
<tr>
<td valign="top"> 

<div class="bloque_der">
  <p><strong>Bloque derecho secundario </strong></p><br />

<li style="list-style:square;">
Objeto de una lista &nbsp;&nbsp; <a href="#"  onclick="return confirm('¿Desea eliminar este objeto?');"> <img src="img/eliminar.png" border="0" title="Eliminar"/></a>&nbsp;&nbsp;
  <a href="#">  <img src="img/editar.png" border="0" title="Modificar"/></a>
  </li><br>
  
  </div>

  <p><strong>Bloque central</strong></p>
  <form id="form1" name="form1" method="post" action="ejemplo.php">
    <table width="446" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>Ejemlo campo formulario</td>
        <td><input type="text" name="titulo" id="titulo" class="campos" value="" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="button" id="button" value="Ejemplo botón" class="campos" style="cursor:pointer;"/></td>
      </tr>
    </table>
    </form>
    <br /><br />
     <div class="contenedor" style="height:100px;">
 <div class="titulo_azul" style="margin-bottom:15px;">Ejemplo titulo</div>
  
  <div class="ejecutar_recuadro">
  <div class="ejecutar">
  <div class="titulo_azul" style="margin-bottom:5px;">Subtitulo</div>
 Texto de ejemplo de un recuadro de texto para reutilizarlo.</div>
    <div class="ejecutar_der">
  <div class="boton_gris" style="margin:10px; float:left; display:inline; width:100px;"><a href="javascript:abrir_popup('ejemplo.php','yes','580','340')" style="color:#FFFFFF;" title="Ejecutar">Popup</a></div>
    </div>
  </div>

 
  </td>
</tr>
</table>
  
</body>
</html>
