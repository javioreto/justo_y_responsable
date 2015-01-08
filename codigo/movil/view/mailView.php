<?php
	
$newComment=('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="es" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Justo y Responsable - Nuevo comentario</title>
<style type="text/css">
body{
	font-family:Arial, Helvetica, sans-serif;
}

a{
	text-decoration:none;
}

a:hover{
	text-decoration:underline;
}

</style>
</head>

<body>
<div style="margin-left:auto; margin-right:auto; width:70%;">
<table style="width: 100%;" cellpadding="0" cellspacing="0">
	<tr>
		<td style="background-color:#d50000; color:#FFFFFF; border:solid 1px #d50000;">
			<img alt="Logo CNCJ" height="70" src="'.$this->getURL().'/images/logojyr.png" width="80" style="margin:5px 20px 5px 10px; float:left;" />
			<div style="font-size:26px; margin-top:25px;">Justo y Responsable</div>
		</td>
	</tr>
	<tr>
		<td style="border-right:solid 1px #d50000; border-left:solid 1px #d50000;">
			<div style="width:80%; margin-left:auto; margin-right:auto; padding:15px 0px 25px 0px;">
				<h2>Nuevo comentario en el '.$tipo.' <b>'.$nombre.'</b></h2>
				<p>Un usuario ha introducido un nuevo comentario en su '.$tipo.', acceda a su zona de administración para visualizarlo.</p>
				<a href="'.$this->getURL().'/view/login.php" target="_blank" alt="visualizar">Ir a zona de administración</a>
			</div>
		</td>
	</tr>
	<tr>
		<td style="background-color:#d50000; border:solid 1px #d50000; color:#ffffff; padding:10px 0px;">
			<center>Justo y Responsable - <a href="'.$this->getURL().'/view/login.php" target="_blank" style="color:#ffffff;">Zona de administración</a></center>
		</td>
	</tr>
</table>
</div>
</body>

</html>');

?>
