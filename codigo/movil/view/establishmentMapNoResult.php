<?php
include_once ("../init.php");
if (is_file("controller/search.php")){
	include_once ("controller/search.php");
}
else {
	include_once ("../controller/search.php");
}
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
        
		<link rel="stylesheet"  href="../css/customEstablishmentMap.css">
		<script src="../js/static/jquery.js"></script>
		<script src="../js/static/jquery.mobile-1.4.2.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		
	
	</head>
	<div data-role="page" id="map-page" data-url="map-page" data-theme="a" >
		
		<div id="head" data-role="header">
            <a href="start.php"
            data-ajax="false"
            data-rel="back"
            class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext"></a>
            <div id="tablehead" align="center">
            <table>
                   <tr>
                       <td>
                           <img src="../../images/logojyrm.png" alt="logo JyR" />
                       </td>
                       <td>
                           <h1> <?php echo _("JyR") ?></h1>
                       </td>
                   </tr>
               </table>
            </div>
            
            <a data-ajax='false' href='#settingPanel' class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-right ui-btn-icon-notext"></a>
        </div>

        
    <body>
        <div style="margin-left: 10px; margin-right: 10px;">
            <p><img src="../../images/warning.png" /><b>&nbsp;&nbsp;<?php echo _("No hay resultados") ?></b></p>
            <p><?php echo _("No se ha encontrado ningún establecimiento que cumpla los criterios indicados para la búsqueda. Puede realizar una nueva búsqueda, modificando los distintos valores") ?></p>
        </div>
        <div id="btnNewSearch" align="center" >
            <a data-ajax="false" href="advancedSearch.php" class="ui-btn ui-btn-inline ui-shadow ui-btn-corner-all"><?php echo _("Nueva búsqueda") ?></a>
        </div>
        
    </body>
    
    <div data-role="panel" id="settingPanel" data-position="right" data-display="overlay" >
        <h2 id="titleSettPanel" align="center"><?php echo _("Menu") ?></h2>
            <ul id="settingList" data-role="listview" data-inset="false">
                <li>
                    <a data-ajax="false" href="advancedSearch.php"><p><?php echo _("Nueva búsqueda") ?></p></a>
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