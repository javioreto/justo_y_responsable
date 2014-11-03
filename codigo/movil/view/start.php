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
		
		<link rel="stylesheet"  href="../css/customStart.css">
		<link rel="stylesheet"  href="../css/themes/default/styles.css">
		<script src="../js/static/jquery.js"></script>
		<script src="../js/static/jquery.mobile-1.4.2.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="../js/static/gmaps.js"></script>
		<script type="text/javascript" src="../js/showMap.js"></script>
		<script type="text/javascript" src="../js/distance.js"></script>
		<script type="text/javascript" src="../js/language.js"></script>
		<script src="../js/static/jquery.quick.pagination.min.js"></script>
		
		<script type="text/javascript">
        $(document).ready(function() {
            $("ul.pagination").quickPagination({pageSize:"5"});
        });
        </script>
		
	</head>
	
	    
	<div data-role="page" id="map-page" data-url="map-page" data-theme="a" >
	
	   <div id="head" data-role="header" align="center">
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
       <div id="languages" data-role="header" class="bgimg" align="right" >
            <img src="../../images/spainflag.png" alt="logo" onclick="selectLanguage('spain')" />
            <img src="../../images/inglesflag.png" alt="logo" onclick="selectLanguage('english')" />     
        </div>
       <div data-role="header">

            <div class="segmented-control ui-bar-d">
                <fieldset data-role="controlgroup" data-type="horizontal" >
                    <div class="ui-controlgroup-controls ">
                        <div class="ui-radio">
                            <label for="list-switch" ><?php echo _("Lista") ?></label>
                            <input type="radio" name="switch" id="list-switch"  data-cacheval="false">
                        </div>

                        <div class="ui-radio">
                            <label for="map-switch" ><?php echo _("Mapa") ?></label>
                            <input type="radio" name="switch" id="map-switch" checked="true" data-cacheval="true">
                        </div>

                    </div>
                </fieldset>
            </div>

        </div>
       
            
        
        <body>
            
            <?php
                $lat=$_GET['lat'];
                $long=$_GET['long'];
                if($lat==0 && $long==0){
                ?>
                    <div align='center' id='result' data-role='header'>
                        <p>
                        <?php echo _("Los establecimientos de Madrid") ?>
                        </p>
                        <div id="divpanellegen" >
                            <a data-ajax='false' href='#legenPanel' class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-right ui-btn-icon-notext"></a>
                        </div>
                    </div>
                <?php
                }else{
                ?>
                    <div align='center' id='result' data-role='header'>
                        <p> 
                        <?php echo _("Los 10 establecimientos más cercanos") ?>
                        </p>
                        <div id="divpanellegen" >
                            <a data-ajax='false' href='#legenPanel' class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-right ui-btn-icon-notext"></a>
                        </div>
                    </div>
                <?php
                }
            ?>
                    
            
           
            <div role="main" class="ui-content ui-content-list">
                <div id="list">
                    
                    
                    <ul data-role="listview" data-inset="true" class="pagination">
                        
                        <?php
                            $lat=$_GET['lat'];
                            $long=$_GET['long'];
                            $cant = 0;
                            if($lat==0 && $long==0){
                                $establishment = Search::searchEstablishmentMadrid();
                                if(count($establishment)>0){
                                    $cant = 1;
                                    foreach($establishment as $result){
                                        if($result->getLogo()==""){
                                        ?>
                                            <li>
                                                <?php if($result->getSector()->getName()=="Comercio justo"){ ?>
                                                    <a style='background-color: #B5D6E6' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }
                                                if($result->getSector()->getName()=="Banca etica"){ ?>
                                                    <a style='background-color: #E6CCE4' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }
                                                if($result->getSector()->getName()=="Economia solidaria"){ ?>
                                                    <a style='background-color: #B5E6BF' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }
                                                if($result->getSector()->getName()=="Consumidores y usuarios organizados"){ ?>
                                                    <a style='background-color: #FAE69A' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }  ?> 
                                                
                                                    <table class="tablelist">
                                                        <tr>
                                                            <td>
                                                                <div id='imglist' >
                                                                    <img src='../../images/nofoto.jpg'>
                                                                </div>            
                                                            </td>
                                                            <td>
                                                                <h1><?php echo $result->getName() ?></h1>
                                                                <p><?php echo $result->getAddress() ?></p>
                                                                <p><?php echo _("No se conoce la distancia") ?></p>                                                                
                                                            </td>
                                                        </tr>
                                                    </table> 

                                                </a>
                                            </li>
                                        <?php    
                                        }else{
                                        ?>
                                            <li>
                                                <?php if($result->getSector()->getName()=="Comercio justo"){ ?>
                                                    <a style='background-color: #B5D6E6' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }
                                                if($result->getSector()->getName()=="Banca etica"){ ?>
                                                    <a style='background-color: #E6CCE4' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }
                                                if($result->getSector()->getName()=="Economia solidaria"){ ?>
                                                    <a style='background-color: #B5E6BF' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }
                                                if($result->getSector()->getName()=="Consumidores y usuarios organizados"){ ?>
                                                    <a style='background-color: #FAE69A' data-ajax='false' href='information.php?idEstablecimiento="<?php echo $result->getIdEstablishment() ?>"'>
                                                <?php }  ?> 
                                                    <table class="tablelist">
                                                        <tr>
                                                            <td>
                                                                <div id='imglist' >
                                                                    <img src='<?php echo $result->getLogo() ?>'>
                                                                </div>            
                                                            </td>
                                                            <td>
                                                                <div id="content">
                                                                <h1><?php echo $result->getName() ?></h1>
                                                                <p><?php echo $result->getAddress() ?></p>
                                                                <p><?php echo _("No se conoce la distancia") ?></p>
                                                                </div>                                                                
                                                            </td>
                                                        </tr>
                                                    </table>  
                                                     
                                                    
                                                </a>
                                            </li>
                                        <?php
                                        }
                                    }
                                }
                            }else{
                                $cant = 1;
                                Search::searchEstablishmentNear($lat,$long);
                                
                            }
                        ?>
                        
                    </ul>
                    <?php
                    if($cant==0){
                    ?>
                    <p><?php echo _("No existen establecimientos en Madrid") ?></p>
                    <?php
                    }
                    ?>
                    <div id="btnAceptar" align="center" >
                        <a data-ajax="false" href="advancedSearch.php" class="ui-btn ui-btn-inline ui-shadow ui-btn-corner-all"><?php echo _("Nueva búsqueda") ?></a>
                    </div>
                </div>
            </div>
            
                 
            <div id="map" ></div>
            
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
        
        <div data-role="panel" id="legenPanel" data-position="right" data-display="overlay" >
        <h2 id="titleLegenPanel" align="center"><?php echo _("Leyenda") ?></h2>
            <ul id="legenList" data-role="listview" data-inset="false">
                <li>
                    <img src="../../images/comerciojusto.png" />
                    <p><?php echo _("Comercio justo") ?></p>
                </li>
                <li>
                    <img src="../../images/bancaetica.png" />
                    <p><?php echo _("Banca ética") ?></p>
                </li>
                <li>
                    <img  src="../../images/economiasolidaria.png" />
                    <p><?php echo _("Economía solidaria") ?></p>
                </li>
                <li>
                    <img  src="../../images/consumidores.png" />
                    <p><?php echo _("Consumidores y usuarios organizados") ?></p>
                </li>
            </ul>
            <div id="btnclose" align="center">
                <a href="#demo-links" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline"><?php echo _("Cerrar") ?></a>
            </div>
        </div>
        
    </div>
</html>