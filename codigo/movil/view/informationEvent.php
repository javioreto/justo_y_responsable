<?php
include_once ("../init.php");
if (is_file("controller/load.php")){
	include_once ("controller/load.php");
}
else {
	include_once ("../controller/load.php");
}
if (is_file("controller/search.php")){
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
                $idEvent = $_GET['idEvent'];
                $establishment = Search::searchEventById($idEvent);
                ?>
                <div id='name' data-role='header'>
                    <h1><?php echo $establishment->getnombre() ?></h1>
                </div>
			
		</div>
		
		<table>
                     <tr>
                                             
                         <td>
                         <img src="../../images/calendar.png" style="margin:0px 10px;">
                         </td>
                         <td>
                             <p id='sector' ><?php echo date("d/m/Y",strtotime($establishment->getfecha())) ?><br>
                             <?php
                             $inicio = explode(":", $establishment->getinicio());
                             $fin = explode(":", $establishment->getfin());

                             ?>
                             De <?php echo $inicio[0].":".$inicio[1]; ?> a <?php echo $fin[0].":".$fin[1]; ?></p>
                         </td>
                                                                          
                     </tr>
                     <tr>
                     <td><img src="../../images/maps.png" style="margin:0px 10px;">	</td>
                     <td><p id='sector' ><?php echo $establishment->getdireccion() ?> <?php echo $establishment->getlocalidad() ?><br>
                     <a style='color:#D50000' data-ajax='false' href = 'viewMap.php?name=<?php echo $establishment->getnombre() ?>&latitude=<?php echo  $establishment->getlatitud() ?>&longitude=<?php echo $establishment->getlongitud() ?>&sector=<?php echo Search::eventType($establishment->getidTipo()) ?>' ><?php echo _("Ver en mapa") ?></a>
                     </p></td>
                     </tr>
                 </table>

	         <div  id='sector' >
             <div id="divsec" data-role="header">
                <h3 id='sectortitle'><?php echo _("Descripción") ?></h3>
             </div>
             <div style="margin:0px 10px;">
                 <table>
                     <tr>
                                             
                         <td>
                         <p id='sector' ><b>Categoría:</b>&nbsp; <?php echo Search::eventType($establishment->getidTipo()) ?></p>
                         </td>
                                                                          
                     </tr>
                     <tr>
                     <td><?php echo $establishment->getdescripcion() ?><br><br></td>
                     </tr>
                 </table>
             </div>
         </div>
         <div  id='location' >
             <div id="divloc" data-role="header">
                <h3 id='locationtitle'><?php echo _("Organizador") ?></h3>
             </div>
                 <?php
                  $establec = Search::searchEstablishmentById($establishment->getidEstablecimiento());
                  ?>
			<table>
                     <tr>
                                             
                         <td>
                         <img src="../../images/tienda.png" style="margin:0px 10px;">
                         </td>
                         <td>
                             <p id='sector' ><?php echo $establec->getName() ?><br>
                             <a href="information.php?idEstablecimiento=<?php echo $establishment->getidestablecimiento() ?>"  data-ajax='false'> Ver perfil del establecimiento</a></p>
                         </td>
                                                                          
                     </tr>
                     
                 </table>
                
         </div>
         
   

		
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
                                $idEstablishment = $_GET['idEvent'];
                                $date = date('Y/m/d H:i:s');
                                echo "<div align='center' ><a data-ajax='false' type='submit'  onclick='addCommentEvent(".$idEstablishment.")' class='ui-btn ui-btn-inline ui-shadow ui-btn-corner-all'>"; echo _("Enviar"); echo "</a></div>";
                            ?>
                        </div>
                    </div>    
                </li>
            </ul>
            <ul id="listComment" data-role="listview" data-inset="false">
            <?php
                $idEstablishment = $_GET['idEvent'];
                $comments = Load::getEventsComments($idEstablishment);
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
                    <p> <?php echo _("No se ha introducido ningún comentario") ?></p>
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
                    <a data-ajax="false" href="loadSearchEvent.php"><p><?php echo _("Nueva búsqueda") ?></p></a>
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
        document.getElementById('captcha').src='../images/captcha.php?'+Math.random();
    </script>

</html>
