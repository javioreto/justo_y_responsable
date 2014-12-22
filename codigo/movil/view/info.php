<?php
include_once ("../init.php");
if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

$dataBase = new dataBase();
$con = $dataBase->CheckConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
?>

<!DOCTYPE html>
<html>
	<head>
	    
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo _("Justo y Responsable") ?></title>
		
		<link rel="stylesheet" href="../css/themes/default/jyrtheme.min.css" />
        <link rel="stylesheet" href="../css/themes/default/jquery.mobile.icons.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
		
		<link rel="stylesheet"  href="../css/customInfo.css">
		
		<script src="../js/static/jquery.js"></script>
		<script src="../js/static/jquery.mobile-1.4.2.min.js"></script>
		
	</head>
	
	   <div id="head" data-role="header" align="center">
	    <a href="start.php"
        data-ajax="false"
        data-rel="back"
        class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext"></a>
	       <table id="tablehead">
	           <tr>
	               <td>
	                   <img src="../../images/logojyrm.png" />
	               </td>
	               <td>
	                   <h1> <?php echo _("JyR") ?></h1>
	               </td>
	           </tr>
	       </table>
	       
          <a data-ajax='false' href='#settingPanel' class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-right ui-btn-icon-notext"></a>
       </div>
            
        
        <body>
            
            <div id="divinfo" align="center">
                <p style="font-size: 24px;"><b><?php echo _("Justo y Responsable")?></b></p>
                <p style="font-size: 20px;"><?php echo _("Aplicación web para el consumo responsable")?></p>
                <p><b><?php echo _("Autor v2.0:")?></b><?php echo _("&nbspJavier López Martínez")?></p>
                <p><b><?php echo _("email:")?></b><?php echo _("&nbspjlm0051@alu.ubu.es")?></p>
                <p><b><?php echo _("Tutores:")?></b><?php echo _("&nbspÁlvaro Herrero Cosio")?></p>
                <p><b><?php echo _("Autora v1.0:")?></b><?php echo _("&nbspGadea Hidalgo López")?></p>
                <p><b><?php echo _("Colaborador:")?></b><?php echo _("&nbspCoordinadora Estatal de Comercio Justo")?></p>
                <a target="_blank" href="http://www.ubu.es"><img style="margin-right: 40px;" src="../../images/ubu.png" /></a><a target="_blank" href="http://comerciojusto.org/"><img src="../../images/cecj.png" /></a>
                <p><b><?php echo _("Licencia:")?></b><?php echo _("&nbspCreative Commons")?></p>
                <p><b><?php echo _("Fecha de creación:")?></b><?php echo _("&nbspDiciembre de 2014")?></p>
                <p><?php echo _("Versión 2.0")?></p>
            </div>
            
        </body>    
            
          <div data-role="panel" id="settingPanel" data-position="right" data-display="overlay" >
        <h2 id="titleSettPanel" align="center"><?php echo _("Menu") ?></h2>
            <ul id="settingList" data-role="listview" data-inset="false">
                <li>
                    <a data-ajax="false" href="index.php"><p><?php echo _("Volver a inicio") ?></p></a>
                </li>
                <li>
                    <a data-ajax="false" href="info.php" ><p><?php echo _("Acerca de") ?></p></a>
                </li>
                <li>
                    <a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><p><?php echo _("Ayuda") ?></p></a>
                </li>
            </ul>
            <div id="btnclose" align="center">
                <a href="#demo-links" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline"><?php echo _("Cerrar") ?></a>
            </div>
        </div>

    
</html>