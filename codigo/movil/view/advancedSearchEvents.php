<?php
include_once ("../init.php");
if (is_file("controller/searchEvent.php")){
	include_once ("controller/searchEvent.php");
}
else {
	include_once ("../controller/searchEvent.php");
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

		<script type="text/javascript" src="../js/searchFunctionsEvents.js"></script>
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
                <h1><?php echo _("Rango de fechas") ?></h1>
            </div>    
                <form name="rango">
                    <fieldset data-role="controlgroup">
                       Desde: <input type="date" name="desde" id="desde">
                       Hasta: <input type="date" name="hasta" id="hasta">
                       Horario:
                       
                       <fieldset class="ui-grid-a">
					<div class="ui-block-a">
						<select name="inicio" id="inicio">
	                       <?php
	                       for($i=0;$i<=23;$i++){
	                       		echo('<option value="'.$i.':00">'.$i.':00</option>');
	                       }
	                       ?>
	                       </select>
					</div>
					<div class="ui-block-b">
							 <select name="fin" id="fin">
		                       <?php
		                       for($i=0;$i<=23;$i++){
		                       		echo('<option value="'.$i.':00"');
		                       		if($i==23){
		                       		echo "selected";
		                       		}
		                       		echo('>'.$i.':00</option>');
		                       }
		                       ?>
		                       </select>
					</div>	   
					</fieldset>
                        
                    </fieldset>
                </form>
        </div> 

		<div>
    		<div id="sector" data-role="header">
                <h1><?php echo _("Categoría") ?></h1>
            </div>    
                <form name="categoria" id="categoria">
                    <fieldset data-role="controlgroup">
                        <?php
                        $sectors = Search::eventArray();
                        $cont=1;
                        foreach($sectors as $sector){
                         echo("<input type='checkbox' name='sector".$cont."' id='sector".$cont."' value='".$cont."'><label for='sector".$cont."'>".$sector."</label>
                                    <br>");
                           $cont++;
                              }   
                        
                        ?>
                    </fieldset>
                </form>
        </div>        
		
		
		<div id="productsSection">
		
    		<div id="productos" data-role="header">
                <h1><?php echo _("Establecimiento") ?></h1>
            
            </div>
            <form id="checklisttable">
            <fieldset data-role="controlgroup">
                
            <form name="formCat">
                <input type="text" name="establecimiento" id="establecimiento" placeholder="Nombre del establecimiento" />
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
                    <a data-ajax="false" href="advancedSearchEvents.php"><p><?php echo _("Nueva búsqueda") ?></p></a>
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
            
            for (i=0;i<document.categoria.elements.length;i++){ 
                if(document.categoria.elements[i].type == "checkbox"){    
                   document.categoria.elements[i].checked=1;
                }
            }

            
            $("#sliderDistance").hide();
            $("#flipDistance").val("no");
            $("#inputLocality").hide();
            $("#radioLocality").on("change",slideCityShow);
            $("#radioLocation").on("change",slideCityHide);
            $("#flipDistance").on("change",slideDistance);
            
            
            
            
            
        </script>   

</html>