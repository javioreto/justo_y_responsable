<?php

include_once ("load.php");

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}
	
	$system_mail="info@factoria76.com";
	
	$admin_mail="javioreto@gmail.com";
	
    $meses = array('','enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
	
	switch(date("m")){
		case 01: $mes=$meses[1];
				break;
	}
	
	$cuerpoEmail=('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="es" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Justo y Responsable - Resumen estadístico mensual</title>
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

td{
padding:4px 8px;
}
</style>
</head>

<body>
<div style="margin-left:auto; margin-right:auto; width:70%;">
<table style="width: 100%;" cellpadding="0" cellspacing="0">
	<tr>
		<td style="background-color:#d50000; color:#FFFFFF; border:solid 1px #d50000;">
			<img alt="Logo CNCJ" height="70" src="'.getURL().'/images/logojyr.png" width="80" style="margin:5px 20px 5px 10px; float:left;" />
			<div style="font-size:26px; margin-top:25px;">Justo y Responsable</div>
		</td>
	</tr>
	<tr>
		<td style="border-right:solid 1px #d50000; border-left:solid 1px #d50000;">
			<div style="width:80%; margin-left:auto; margin-right:auto; padding:15px 0px 25px 0px;">
	
						<h2>Resumen estadístico correspondiente al mes de '.$meses[(int) date("m")].' de '.date("Y").'</h2>
	
	<center>
	<br><br>
		<table>
			<thead>
			<tr>
				<th style="width:240px;">Concepto</th>
				<th style="width:80px;">Este mes</th>
				<th style="width:80px;">Último mes</th>
				<th style="width:80px;">Histórico</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>Usuarios dados de alta</td>
				<td>
				');
					$coments = Load::loadUserStats(date("m"),date("Y"));
					$cuerpoEmail.=sizeOf($coments).'
					
				</td>
				<td>';
					
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadUserStats($mes,$ano);
					$cuerpoEmail.=sizeOf($coments).'
					
				</td>
				<td>';
					
					$coments = Load::loadUserValidNoAdmin();
					$cuerpoEmail.=sizeOf($coments).'
					
				</td>
			</tr>
			<tr>
				<td>Establecimiento dados de alta</td>
				<td>';
				
					$coments = Load::loadEstStats(date("m"),date("Y"));
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadEstStats($mes,$ano);
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
				$coments = Load::loadAllEstablishment();
				$cuerpoEmail.=sizeOf($coments).'
				
				</td>
			</tr>
			<tr>
				<td>Eventos dados de alta</td>
				<td>';
				
					$coments = Load::loadEventsStats(date("m"),date("Y"));
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadEventsStats($mes,$ano);
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				 
				$coments = Load::loadAllEvents();
				$cuerpoEmail.=sizeOf($coments).'
				
				</td>
			</tr>
			<tr>
				<td>Productos dados de alta</td>
				<td>';
				
					$coments = Load::loadProdStats(date("m"),date("Y"));
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadProdStats($mes,$ano);
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				 
				$coments = Load::loadProductsStats();
				$cuerpoEmail.=sizeOf($coments).'
				
				</td>
			</tr>
			<tr>
				<td>Busquedas de establecimientos</td>
				<td>';
				
					$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'
				

				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
					$cuerpoEmail.= $cont.'

				
				</td>
				<td>';
				
				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'

				
				</td>
			</tr>		
					
			<tr>
				<td>Busquedas de eventos</td>
				<td>';
				 
					$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'
				

				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'

				
				</td>
				<td>';
				 
				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'

				
				</td>

			</tr>
			<tr>
				<td>Busquedas de productos</td>
				<td>';
				 
					$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'
				

				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'

				
				</td>
				<td>';
				
				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'

				
				</td>

			</tr>
			<tr>
				<td>Número de comentarios</td>
				<td>';
				
					$coments = Load::loadComentStats(date("m"),date("Y"));
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadComentStats($mes,$ano);
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
				$coments = Load::loadComentsStats();
				$cuerpoEmail.=sizeOf($coments).'
				
				</td>
			</tr>
			<tr>
				<td>Número de accesos a la aplicación</td>
				<td>';
				
					$coments = Load::loadAccesoStats(date("m"),date("Y"));
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadAccesoStats($mes,$ano);
					$cuerpoEmail.=sizeOf($coments).'
				
				</td>
				<td>';
				
				$coments = Load::loadAccesosStats();
				$cuerpoEmail.=sizeOf($coments).'
				
				</td>
			</tr>
			</tbody>
		</table></center><br><br>
		<a href="'.getURL().'/view/estadisticas.php" target="_blank" alt="visualizar">Haga click aquí para visualizarla las estadísticas completas</a>';
		
		
		$cuerpoEmail.='<br><br><h2>Notificaciones que precisan atención</h2>
	
	<center>
	<br>
		<table>
			<thead>
			<tr>
				<th style="width:240px;">Concepto</th>
				<th style="width:80px;">Este mes</th>
				<th style="width:80px;">Último mes</th>
				<th style="width:80px;">Histórico</th>
			</tr>
			</thead>
			<tbody>

					<tr>
				<td>Número de usuarios pendiendes de validación</td>
				<td>';
				
					$coments = Load::loadUserStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->getValid()==0){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'
				
				</td>
				<td>';
				
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadUserStats($mes,$ano);
					$cont=0;
						foreach($coments as $com){
						if($com->getValid()==0){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'
				
				</td>
				<td>';
				
				$coments = Load::getAllUsers();
				$cont=0;
					foreach($coments as $com){
						if($com->getValid()==0){
							$cont++;
						}
					}
					$cuerpoEmail.=$cont.'
				
				</td>
			</tr>
			</tbody>
		</table>
		
		</center><br><br>';

				$cuerpoEmail.=('<a href="'.getURL().'/view/gestionUser.php" target="_blank" alt="visualizar">Haga click aquí para visualizarla los usuarios</a>
			</div>
		</td>
	</tr>
	<tr>
		<td style="background-color:#d50000; border:solid 1px #d50000; color:#ffffff; padding:10px 0px;">
			<center>Justo y Responsable - <a href="'.getURL().'/view/login.php" target="_blank" style="color:#ffffff;">Zona de administración</a></center>
		</td>
	</tr>
</table>
</div>
</body>

</html>');
	
	
	
		/* Send first mail to admin */
	
		$ssubject="Resumen mensual ".$meses[(int) date("m")]." de ".date("Y");
		$sheader="From: Justo y Responsable <".$system_mail.">\nReply-To:".$system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html";
	
		mail($admin_mail,$ssubject,$cuerpoEmail,$sheader);
		
	function getURL(){
		$url="http://www.factoria76.com/jyr/web";
		return $url;
	}


?>
