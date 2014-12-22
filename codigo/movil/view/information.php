<?php
include_once ("../init.php");
if (is_file("controller/load.php")){
	include_once ("controller/load.php");
}
else {
	include_once ("../controller/load.php");
}
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
        
        <link rel="stylesheet"  href="../css/customInformation.css">
        
		<script src="../js/static/jquery.js"></script>
		<script src="../js/static/jquery.mobile-1.4.2.min.js"></script>

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		
		<script type="text/javascript" src="../js/comment.js"></script>     
        
	</head>
	
    	<div id="head" data-role="header">
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
        </div>
	
	
	<body >
		
		
		<div>
			
			<?php
                $idEstablishment = $_GET['idEstablecimiento'];
                $establishment = Search::searchEstablishmentById($idEstablishment);
                ?>
                <div id='name' data-role='header'>
                    <h1><?php echo $establishment->getName() ?></h1>
                    <?php
                        if($establishment->getSector()->getIdSector()==1){
                    ?>
                            <a data-ajax='false' href='#productPanel' class='ui-btn-right ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-eye'><?php echo _("Productos") ?></a>
                    <?php        
                        }
                    ?>
                </div>
			
		</div>
		
		<?php
		  $idEstablishment = $_GET['idEstablecimiento'];
          $establishment = Search::searchEstablishmentById($idEstablishment);
          
		?>
		<div id='information'>
            <div  id='image' align = 'center'>
            <?php
            if ($establishment->getLogo() == ""){
            ?>
                 <img id='img' src='../../images/nofoto.jpg' />
            <?php
            }else{
            ?>
                 <img id='img' src="<?php echo $establishment->getLogo() ?>" />
            <?php
            }
            ?>
            </div>
         </div>   <hr/>
         <div  id='secicons' align = 'center'>
             <?php    
             if($establishment->getCash() == 1){
             ?>
                 <a href="#popupCash" data-rel="popup" data-transition="pop" ><img id='imgcash' src='../../images/cash.png' ></img></a>
             <?php
             }else{
             ?>
                 <img style="opacity: 0.4" id='imgcash' src='../../images/cash.png' />
             <?php    
             }
             if($establishment->getCard() == 1){
             ?>
                 <a href="#popupCard" data-rel="popup" data-transition="pop" ><img id='imgcard' src='../../images/card.png' /></a>
             <?php   
             }else{
             ?>
                 <img style="opacity: 0.4" id='imgcard' src='../../images/card.png' />
             <?php    
             }
             if($establishment->getDisableAccess() == 1){
             ?>
                  <a href="#popupDisab" data-rel="popup" data-transition="pop" ><img id='imginvalid' src='../../images/invalid.png' /></a>
             <?php
             }else{
             ?>
                  <img style="opacity: 0.4" id='imginvalid' src='../../images/invalid.png' />
             <?php    
             }
             ?>
         </div><hr/>
         <div data-role="popup" id="popupCash" class="ui-content">
            <p><?php echo _("Pago con moneda social") ?></p>
         </div>
         <div data-role="popup" id="popupCard" class="ui-content">
            <p><?php echo _("Pago con tarjeta") ?></p>
         </div>
         <div data-role="popup" id="popupDisab" class="ui-content">
            <p><?php echo _("Acceso para discapacitados") ?></p>
         </div>
         <div  id='sector' >
             <div id="divsec" data-role="header">
                <h3 id='sectortitle'><?php echo _("Sector") ?></h3>
             </div>
             <div>
                 <table>
                     <tr>
                         <?php
                         if($establishment->getSector()->getName()=="Comercio justo"){
                         ?>
                         <td>
                             <img align="right" src="../../images/comerciojusto.png" />
                         </td>
                         <td>
                             <p id='sector' ><?php echo _("Comercio justo") ?></p>
                         </td>
                         <?php
                         }
                         if($establishment->getSector()->getName()=="Banca etica"){
                         ?>
                         <td>
                             <img align="right" src="../../images/bancaetica.png" />
                         </td>
                         <td>
                             <p id='sector' ><?php echo _("Banca ética") ?></p>
                         </td>
                         <?php
                         }
                         if($establishment->getSector()->getName()=="Economia solidaria"){
                         ?>
                         <td>
                             <img align="right" src="../../images/economiasolidaria.png" />
                         </td>
                         <td>
                             <p id='sector' ><?php echo _("Economía solidaria") ?></p>
                         </td>
                         <?php
                         }
                         if($establishment->getSector()->getName()=="Consumidores y usuarios organizados"){
                         ?>
                         <td>
                             <img align="right" src="../../images/consumidores.png" />
                         </td>
                         <td>
                             <p id='sector' ><?php echo _("Consumidores y usuarios organizados") ?></p>
                         </td>
                         <?php
                         }
                         ?>
                         
                     </tr>
                 </table>
             </div>
         </div>
         <div  id='location' >
             <div id="divloc" data-role="header">
                <h3 id='locationtitle'><?php echo _("Ubicación") ?></h3>
             </div>
             <div>
                 <p id='address' ><b><?php echo _("Dirección:") ?></b>&nbsp;&nbsp;<?php echo $establishment->getAddress()?></p>
             </div>
             <div>
                 <p id='postalCode' ><b><?php echo _("C.P:") ?></b>&nbsp;&nbsp;<?php echo $establishment->getPostCode() ?></p>
             </div>
             <div>
                 <p id='locality' ><b><?php echo _("Localidad:") ?></b>&nbsp;&nbsp;<?php echo $establishment->getLocation() ?></p>
             </div>
             <div>
                 <?php
                  $name = $establishment->getName();
                  $namef = Load::replace($name);
                  ?>
                 <p id='position' ><b><?php echo _("Posición:") ?></b>&nbsp;&nbsp;<a style='color:#D50000' data-ajax='false' href = 'viewMap.php?name=<?php echo $namef ?>&latitude=<?php echo  $establishment->getLatitude() ?>&longitude=<?php echo $establishment->getLongitude() ?>&sector=<?php echo $establishment->getSector()->getName() ?>' ><?php echo _("ver en mapa") ?></a></p>
             </div>
             
         </div>
         
         <div  id='contact' >
             <div id="divcont" data-role="header">
                <h3 id='contacttitle'><?php echo _("Contacto") ?></h3>
              </div>
              
                  <?php
                  if($establishment->getSchedule()!=""){
                  ?>
                  <div>
                       <p id='schedule' ><b><?php echo _("Horario:") ?></b>&nbsp;&nbsp;<?php echo $establishment->getSchedule() ?></p>
                  </div>
                  <?php
                  }
                  ?>
                  <?php
                  if($establishment->getPhone()!=""){
                  ?>
                  <div>
                       <p id='phone' ><b><?php echo _("Teléfono:") ?></b>&nbsp;&nbsp;<?php echo $establishment->getPhone() ?></p>
                  </div>
                  <?php
                  }
                  ?>
                  <?php
                  if($establishment->getMail()!=""){
                  ?>
                  <div>
                       <p id='mail' ><b><?php echo _("Email:") ?></b>&nbsp;&nbsp;<?php echo $establishment->getMail() ?></p>
                  </div>
                  <?php
                  }
                  ?>
                  <?php
                  if($establishment->getWebSite()!=""){
                  ?>
                  <div>
                         <p id="websitelink" ><b><?php echo _("Página web:") ?></b>&nbsp;&nbsp;<a style="color: #D50000" target="_blank" href="<?php echo $establishment->getWebSite() ?>"><?php echo $establishment->getWebSite() ?></a></p>
                  </div>
                  <?php
                  }
                  ?>
         </div>
         <?php
         if($establishment->getFacebook() != "" || $establishment->getTwitter() != ""){
         ?>
             <div  id='social' >
                 <div id="divsoc" data-role="header">
                    <h3 id='socialttitle'><?php echo _("Redes sociales") ?></h3>
                  </div>
                  
                  <?php
                     if($establishment->getFacebook() != ""){
                  ?>
                  <div>     
                       <p id="facelink" ><b><?php echo _("Facebook:") ?></b>&nbsp;&nbsp;<a style="color: #D50000" target="_blank" href="<?php echo $establishment->getFacebook() ?>" ><?php echo $establishment->getFacebook() ?></a></p>
                  </div>                          
                  <?php
                     }
                     if($establishment->getTwitter() != ""){
                     ?>
                      <div>     
                         <p id="twitterlink" ><b><?php echo _("Twitter:") ?> </b>&nbsp;&nbsp;<a style="color: #D50000" target="_blank" href="<?php echo $establishment->getTwitter() ?>"><?php echo $establishment->getTwitter() ?></a></p>
                      </div>     
                     <?php
                     }
                     ?>
              </div>
          <?php
          }
          ?>     
		
		<hr/>
		  <div id="comentOk" data-role="header" style="visibility:hidden; height:0px;">
                <h3><?php echo _("Su comentario se ha publicado correctamente.") ?></h3>
              </div>

		<div data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
            <h4><?php echo _("Comentarios") ?></h4>
            <ul id="newComment" data-role="listview" data-inset="false">
                <li>
                    <div>
                        <div data-role="collapsible">
                            <h4><?php echo _("Introduzca su comentario") ?></h4>
                           <div>
                            <label for="nameComment"><?php echo _("Nombre:") ?></label>
                            <input type="text" name="nameComment" id="nameComment" value="">
                            <label for="textComment"><?php echo _("Texto:") ?></label>
                            <textarea cols="40" rows="8" name="textComment" id="textComment"></textarea>
                            
                           
                            <img  id="captcha" src="../../images/captcha.php" />
                           
                            <button style="display: block" class='ui-btn ui-btn-inline ui-mini ui-shadow ui-btn-corner-all' type="submit" onclick="document.getElementById('captcha').src='../images/captcha.php?'+Math.random();"><?php echo _("recargar") ?></button>
                            
                            <label for="result" id='textCaptcha'><?php echo _("Introduzca el texto de la imagen:") ?></label>
                            <input type="text" name="result" id="result" autocomplete="off">
                           </div>
                            
                            <?php
                                $idEstablishment = $_GET['idEstablecimiento'];
                                $date = date('Y/m/d H:i:s');
                                echo "<div align='center' ><a data-ajax='false' type='submit'  onclick='addComment(".$idEstablishment.")' class='ui-btn ui-btn-inline ui-shadow ui-btn-corner-all'>"; echo _("Enviar"); echo "</a></div>";
                            ?>
                        </div>
                    </div>    
                </li>
            </ul>
            <ul id="listComment" data-role="listview" data-inset="false">
            <?php
                $idEstablishment = $_GET['idEstablecimiento'];
                $comments = Load::getComments($idEstablishment);
                if(count($comments)!=0){
                    foreach($comments as $comment){
                    ?>                
                        <li>
                            <div>
                                <p style='font-size: small' ><?php echo _("Fecha y hora: "); echo $comment->getDate(); ?></p>
                                <img style='float: left' src='../../images/bubble.png' />
                                <blockquote>
                                    <h2><?php echo $comment->getAuthor(); ?></h2>
                                </blockquote>
                                <p id="desccomment"><?php echo $comment->getDescription(); ?></p>
                            </div>
                         </li>
                    <?php
                    }
                }else{
            ?>
                <div id="divnocom">
                    <p><?php echo _("No se ha introducido ningún comentario") ?></p>
                </div>
            <?php
                }
            ?>
            </ul>
        </div>
		
	</body>
	
	<div data-role="panel" id="settingPanel" data-position="right" data-display="overlay" >
	    <h2 id="titleSettPanel" align="center"><?php echo _("Menu") ?></h2>
            <ul id="settingList" data-role="listview" data-inset="false">
                    <li>
                    <a data-ajax="false" href="index.php"><p><?php echo _("Volver a inicio") ?></p></a>
                </li>

                <li>
                    <a data-ajax="false" href="loadSearchEstablishment.php"><p><?php echo _("Nueva búsqueda") ?></p></a>
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
	     
    <div data-role="panel" id="productPanel" data-position="right" data-display="overlay" >
        <h2 id="titlePanel" align="center"><?php echo _("Productos") ?></h2>
        <ul id="newComment" data-role="listview" data-inset="false">
                <?php
                    $idEstablishment = $_GET['idEstablecimiento'];
                    $products = Load::getProducts($idEstablishment);
                    if(count($products)>0){
                        foreach($products as $product){
                        ?>
                            <li>
                                <p><b><?php echo $product->getName() ?></b></p>
                                <p id="proddesc"><?php echo $product->getDescription() ?></p>
                            </li>
                        <?php    
                        }
                    }else{
                    ?>
                       <p><?php echo _("No se conocen los productos de este establecimiento") ?></p>
                    <?php      
                    }
                ?>
            </ul>
            <div id="btnclose" align="center">
                <a href="#demo-links" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline"><?php echo _("Cerrar") ?></a>
            </div>
    </div>
    <script>
        document.getElementById('captcha').src='../images/captcha.php?'+Math.random();
    </script>

</html>
