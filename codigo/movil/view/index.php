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
        
        <link rel="stylesheet"  href="../css/customMenu.css">
        
        <script src="../js/static/jquery.js"></script>
        <script src="../js/static/jquery.mobile-1.4.2.min.js"></script>

		<script type="text/javascript" src="../js/language.js"></script>

		
		
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
		
        
	</head>
	<body>
	<div id="head" data-role="header" data-theme="a">
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
	</div>
	   
    		<div  id="ubicacion" data-role="header">
                <h1 ><?php echo _("Menú") ?></h1>
            </div>
         
            	<div class="menu_block">
		            <ul id="settingList" data-role="listview" data-inset="false">
		                <li>
		                    <a data-ajax="false" href="loadSearchEstablishment.php"><p><?php echo _("Buscar establecimientos") ?></p></a>
		                </li>
		                <li>
		                    <a data-ajax="false" href="loadSearchEvent.php" ><p><?php echo _("Buscar eventos") ?></p></a>
		                </li>
		                <li>
		                    <a data-ajax="false" href="../views/capturar.php" ><p><?php echo _("Información de producto") ?></p></a>
		                </li>
						<li>
		                    <a data-ajax="false" href="info.php" ><p><?php echo _("Acerca de") ?></p></a>
		                </li>

		                <li>
		                    <a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><p><?php echo _("Ayuda") ?></p></a>
		                </li>
		            </ul>
            </div>
            
            <div class="language_list ui-grid-d">
            	<div class="ui-block-a"><img src="../../images/spainflag.png" alt="logo" onclick="selectLanguage('spain')" /></div>
            	<div class="ui-block-b"><img src="../../images/inglesflag.png" alt="logo" onclick="selectLanguage('english')" /></div> 
            	<div class="ui-block-c"><img src="../../images/eus.png" alt="logo" onclick="selectLanguage('eus')" /></div>           	  
          	  	<div class="ui-block-d"><img src="../../images/cat.png" alt="logo" onclick="selectLanguage('cat')" /></div>
            	<div class="ui-block-e"><img src="../../images/gal.png" alt="logo" onclick="selectLanguage('gal')" /></div> 
            </div>
		
	</body>
	        
</html>