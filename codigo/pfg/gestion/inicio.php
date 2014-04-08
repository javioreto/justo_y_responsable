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
<?php $estoy="inicio"; ?>
<?php include("includes/menu.php"); ?>
<table height="100%" width="90%" class="cuerpo">
<tr>
<td valign="top">
  <p>Desde la sección de administración se puede gestionar y visualizar todos 
  los eventos de la aplicación Fair Trade</p>
  <p>El archivo de la carpeta include &quot;conexión.php&quot; está comentado y se debe 
  configurar.</p>
  <p>El archivo &quot;menu.php&quot; es un include del menú superior para centralizarlo y 
  en &quot;ejemplo.php&quot; hay objetos ya creados en CSS para poder reutilizarse.</p>
  <p>&nbsp;</p>
  
  <div class="contenedor" style="height:100px;">
 <div class="titulo_azul" style="margin-bottom:15px;">Contenido de ejemplo</div>
  
  <div class="ejecutar_recuadro">
  <div class="ejecutar">
  <div class="titulo_azul" style="margin-bottom:5px;">Obtener lista de ...</div>
  Generar un archivo excel con todos los asistentes inscritos en una quedada.</div>
    <div class="ejecutar_der">
  <div class="boton_gris" style="margin:10px; float:left; display:inline; width:100px;"><a href="javascript:abrir_popup('popup_.php','yes','680','440')" style="color:#FFFFFF;" title="Ejecutar">Generar</a></div>
    </div>
  </div>
  
  <div class="ejecutar_recuadro">
  <div class="ejecutar">
  <div class="titulo_azul" style="margin-bottom:5px;">Cambiar condiciones de 
	  ....</div>
  Modificar el precio por d&iacute;a, semana y la fianza a depositar.</div>
    <div class="ejecutar_der">
  <div class="boton_gris" style="margin:10px; float:left; display:inline; width:100px;"><a href="javascript:abrir_popup('popup_.php','yes','580','440')" style="color:#FFFFFF;" title="Cambiar">Cambiar</a></div>
    </div>
  </div>
  <p>&nbsp;</p>
  </div>
  <br />
    
  </td>
</tr>
</table>
</body>
</html>
