<?php
include_once ("../init.php");
if (is_file("controller/load.php")){
	include_once ("controller/load.php");
}
else {
	include_once ("../controller/load.php");
}

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

if (is_file("controller/checkNav.php")){
    include_once ("controller/checkNav.php");
}
else {
    include_once ("../controller/checkNav.php");
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
        
        <link rel="stylesheet"  href="../css/cameraScan.css">
        
        <script src="../js/static/jquery.js"></script>
        <script src="../js/static/jquery.mobile-1.4.2.min.js"></script>
      
	</head>
  <body>
  <div id="head" data-role="header" data-theme="a">
	    <a href="index.php" data-ajax="false" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext"></a>
	    <div id="tablehead" align="center">
	    <table>
               <tr>
                   <td>
                       <img src="../../images/logojyrm.png" />
                   </td>
                   <td>
                       <h1> <?php echo _("JyR") ?></h1>
                   </td>
               </tr>
           </table>
		</div>
		
		<a data-ajax='false' href='#settingPanel' class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-right ui-btn-icon-notext"></a>
	</div>	
	<div id="resultado" class="ver hidden">Se ha obtenido el código <p id="result"></p></div>
	
	<div id="introducir" class="ver hidden">
	No se ha podido acceder a la camara para escanear los códigos de barras.
	<br>
		<div style="width:60%; margin-left:auto; margin-right:auto;">
			<input type="text" id="codText" name="cod" placeholder="Intro. Cód. de barras">
			<a href="#" id="buscar" data-role="button" data-icon="search">Buscar</a>
			
			<div data-role="popup" id="popupBasic" data-theme="a" class="ui-content">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Cerrar</a>
				<p>El codigo de barras introducido no esta en nuestra <br>base de datos, introduzca otro codigo.<p>
			</div>
		</div>
	</div>
	
    <video id="video" style="width:100%; margin-left:auto; margin-right:auto; max-height:800px; z-index:3;">
    </video>	
    

    	<div class="banner_over_scan" id="txt1">
		Escanee el código de barras del producto
		</div>

   	<div style="background-color:gray; min-height:60px; text-align:center;" id="txt2">
		<button id="startbutton" class="ui-btn ui-btn-inline ui-shadow ui-btn-corner-all">Escanear</button>
		<button id="lanzartexto" class="ui-btn ui-btn-inline ui-shadow ui-btn-corner-all">Introducción manual</button>
	</div>
	
    <canvas id="canvas" style="visibility:hidden"></canvas>
    <p id="results"  style="visibility:hidden"></p>
    <img src="" id="barcode" alt="barcode" style="visibility:hidden">  
    
       
    <script type="text/javascript" src="barcode.js"></script>
    <script type="text/javascript" src="main.js"></script>
    
    <div data-role="panel" id="settingPanel" data-position="right" data-display="overlay" >
        <h2 id="titleSettPanel" align="center"><?php echo _("Menu") ?></h2>
            <ul id="settingList" data-role="listview" data-inset="false">
                <li>
                    <a data-ajax="false" href="../view/index.php"><p><?php echo _("Volver a inicio") ?></p></a>
                </li>

                <li>
                    <a data-ajax="false" href="capturar.php"><p><?php echo _("Nueva búsqueda") ?></p></a>
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

  </body>
</html>
