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
        
        <link rel="stylesheet"  href="../css/customSearch.css">
        
        <script src="../js/static/jquery.js"></script>
        <script src="../js/static/jquery.mobile-1.4.2.min.js"></script>

		<script type="text/javascript" src="../js/searchFunctions.js"></script>
		<script type="text/javascript" src="../js/establishmentMap.js"></script>
		<script type="text/javascript" src="../js/load.js"></script>
		<script type="text/javascript" src="../js/location.js"></script>
		
		
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
		
        
	</head>
	
	<div id="head" data-role="header" data-theme="a">
	    <a href="start.php"
        data-ajax="false"
        data-rel="back"
        class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext"></a>
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
	</div
	
	<body >
	    <div>
    		<div  id="ubicacion" data-role="header">
                <h1 ><?php echo _("Ubicación") ?></h1>
            </div>
    		<form id="radiogroup">
                <fieldset id="field" data-role="controlgroup">
                    <div id="divlocation" style="display:">
                        <input type="radio" name="radio" id="radioLocation" value="location">
                        <label id="labelradiolocation"  for="radioLocation"><?php echo _("Mi ubicación") ?></label>
                    </div>
                    <div id="nolocation" style="display:none">
                        <input type="radio" name="radion" id="radioLocationn" value="location" disabled="false">
                        <label id="labelradiolocationn"  for="radioLocationn"><?php echo _("Mi ubicación (solo disponible compartiendo la ubicación)") ?></label>
                    </div>
                    <input type="hidden" id="miLat" name="miLat" />
                    <input type="hidden" id="miLng" name="miLng" />
                    <input type="radio" name="radio" id="radioLocality" value="locality" >
                    <label for="radioLocality"><?php echo _("Localidad") ?></label>
                    <input type="text" id="inputLocality" placeholder="<?php echo _("Introduce una localidad") ?>" autocomplete="on" runat="server" />
                    <input type="hidden" id="cityLat" name="cityLat" />
                    <input type="hidden" id="cityLng" name="cityLng" />
                </fieldset>
            </form>
    
       
            <form id="formDistance">
                <label id="labeldistance" for="flipDistance"><?php echo _("Distancia(km):") ?></label>
                    <select name="flipswitch" id="flipDistance" data-role="slider">
                        <option value="si"><?php echo _("Si") ?></option>
                        <option value="no"><?php echo _("No") ?></option>
                    </select>
                <div id="sliderDistance" >
                    <input type="range" name="slider" id="slider" data-highlight="true" min="0" max="20" step=".1" value="2">
                </div>
            </form>
            
        </div>

		<div>
    		<div id="sector" data-role="header">
                <h1><?php echo _("Sector") ?></h1>
            </div>    
                <form name="form">
                    <fieldset data-role="controlgroup">
                        <?php
                        $sectors = Load::loadSector();
                        foreach($sectors as $sector){
                            if($sector->getName()=="Comercio justo"){
                            ?>
                                <input type='checkbox' name='comercioJusto' id="<?php echo $sector->getIdSector() ?>" onclick='selectedCJ()'>
                                    <label for="<?php echo $sector->getIdSector() ?>"><?php echo _("Comercio justo") ?></label>
                            <?php
                            }else{
                                if($sector->getName()=="Banca etica"){
                                ?>
                                    <input type='checkbox' name='bancaEtica' id="<?php echo $sector->getIdSector() ?>" >
                                    <label for="<?php echo $sector->getIdSector() ?>"><?php echo _("Banca ética") ?></label>
                                <?php
                                }else{
                                    if($sector->getName()=="Economia solidaria"){
                                    ?>
                                        <input type='checkbox' name='economiaSolidaria' id="<?php echo $sector->getIdSector() ?>">
                                        <label for="<?php echo $sector->getIdSector() ?>"><?php echo _("Economía solidaria") ?></label>
                                    <?php
                                    }else{
                                        if($sector->getName()=="Consumidores y usuarios organizados"){
                                        ?>
                                            <input type='checkbox' name='consumidores' id="<?php echo $sector->getIdSector() ?>" >
                                            <label for="<?php echo $sector->getIdSector() ?>"><?php echo _("Consumidores y usuarios organizados") ?></label>
                                        <?php
                                        }
                                    }
                                }
                            }   
                        }
                        ?>
                    </fieldset>
                </form>
        </div>        
		
		
		<div id="productsSection">
		
    		<div id="productos" data-role="header">
                <h1><?php echo _("Productos") ?></h1>
            
            </div>
            <form id="checklisttable">
            <fieldset data-role="controlgroup">
                
            <form name="formCat">
                <input type='checkbox' name='check' id="unCheck" />
                <label id="checkalllabel" for="unCheck"><b><?php echo _("Todas") ?></b></label>
               
                <input id="ma" type="hidden" value="si"/>
                <div id='allcheck'>
                
                <?php
                    $allc = Load::loadAllCategories();
                    
                    for($i=0;$i<count($allc);$i=$i+1){
                        $first = preg_split("/;/", $allc[$i]);
                        $second = preg_split("/;/", $allc[$i+1]);
                        if($first[0]<$second[0]){
                        ?>
                            <fieldset data-role='collapsible' data-collapsed='true'>
                              <legend><?php echo $first[2] ?></legend>
                            
                        <?php
                        }else{
                            if($first[0]>$second[0]){
                            ?>
                                <input type='checkbox' name='check' id="<?php echo $first[1] ?>" />
                                <label for="<?php echo $first[1] ?>"><?php echo $first[2] ?></label>
                                </fieldset>
                            <?php
                            }else{
                            ?>
                                <input type='checkbox' name='check' id="<?php echo $first[1] ?>" />
                                <label for="<?php echo $first[1] ?>"><?php echo $first[2] ?></label>
                            <?php
                            }
                        }
                    }
                ?>
                </div>
            </form>   
            </fieldset>
        </form>   
        </div>
		
		<div id="btnAceptar" align="center" >
            <a data-ajax="false" onclick="collectParameters()"type="submit" class="ui-btn ui-btn-inline ui-shadow ui-btn-corner-all"><?php echo _("Buscar") ?></a>
        </div>
		
		
		
	</body>
	
	<div data-role="panel" id="settingPanel" data-position="right" data-display="overlay" >
        <h2 id="titleSettPanel" align="center"><?php echo _("Menu") ?></h2>
            <ul id="settingList" data-role="listview" data-inset="false">
                <li>
                    <a data-ajax="false" href="index.php"><p><?php echo _("Volver a inicio") ?></p></a>
                </li>

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
        
        <script>
              
            searchGoogle();
            getLocation();
            
            for (i=0;i<document.form.elements.length;i++){ 
                if(document.form.elements[i].type == "checkbox"){    
                   document.form.elements[i].checked=1;
                }
            }

            
            $("#sliderDistance").hide();
            $("#flipDistance").val("no");
            $("#inputLocality").hide();
            $("#radioLocality").on("change",slideCityShow);
            $("#radioLocation").on("change",slideCityHide);
            $("#flipDistance").on("change",slideDistance);
            
            
            $(document).ready(function(){
    
                $("#checklisttable input").each(function(){
                    
                    $(this).prop('checked', true);
                });
                
                $("#checklisttable label").addClass('ui-checkbox-on').removeClass('ui-checkbox-off');
                $("#checklisttable span.ui-icon").addClass('ui-icon-checkbox-on').removeClass('ui-icon-checkbox-off');
                
                // un check
                $("#unCheck").click(function () {
                 
                    if(document.getElementById('ma').value=="si"){
                        $('input[type="checkbox"]').each(function(){
                           $("#checklisttable input").each(function(){
                                $(this).prop('checked', false);
                            }); 
                            $("#checklisttable label").addClass('ui-checkbox-off').removeClass('ui-checkbox-on');    
                            $("#checklisttable span.ui-icon").addClass('ui-icon-checkbox-off').removeClass('ui-icon-checkbox-on');
                        });
                        document.getElementById('ma').value="no";
                    }else{
                        $('input[type="checkbox"]').each(function(){
                           $("#checklisttable input").each(function(){
                                $(this).prop('checked', true);
                            }); 
                            $("#checklisttable label").addClass('ui-checkbox-on').removeClass('ui-checkbox-off');    
                            $("#checklisttable span.ui-icon").addClass('ui-icon-checkbox-on').removeClass('ui-icon-checkbox-off');
                        });
                        document.getElementById('ma').value="si";
                    }
                });
                
               
            });  
            
            
        </script>   

</html>