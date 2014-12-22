<?php
include_once ("../init.php");
if (is_file("controller/products.php")){
	include_once ("controller/products.php");
}
else {
	include_once ("../controller/products.php");
}



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
        
        <link rel="stylesheet"  href="../css/products.css">
        
        <script src="../js/static/jquery.js"></script>
        <script src="../js/static/jquery.mobile-1.4.2.min.js"></script>
      
	</head>
  <body>
			<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&appId=373994508049&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>	
		
  <div id="head" data-role="header" data-theme="a">
	    <a href="../views/capturar.php" data-ajax="false" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext"></a>
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
	<div style="background-color:white">
		<div class="prod_titulo">
			<?php echo $nombre; ?>
		</div>
		<center>
			<?php
			if (is_file("../../images/".$img)){
				echo('<img src="../../images/'.$img.'" class="prod_img">');
			}else{
				echo('<img src="../../images/nofoto.jpg" class="prod_img">');
			}
			?>
		</center>
	<div class="prod_contenedor">
		<div class="prod_descrip">
			<p><?php echo $descripcion; ?></p>
		</div>
	</div>
    <div class="footer">
    	<div class="redes">
    	<div class="redes-contenido">
			<div class="fb-like" data-href="<?php echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>   
		</div>	
		<div class="redes-contenido">
		<a href="https://twitter.com/share" class="twitter-share-button" data-text="Encuentra cientos de productos de comercio justo como este:" data-via="CEComercioJusto">Tweet</a></div>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
	</div>
    
    
    
            	<div data-role="panel" id="settingPanel" data-position="right" data-display="overlay" >
        <h2 id="titleSettPanel" align="center"><?php echo _("Menu") ?></h2>
            <ul id="settingList" data-role="listview" data-inset="false">
		                      <li>
                    <a data-ajax="false" href="index.php"><p><?php echo _("Volver a inicio") ?></p></a>
                </li>

                <li>
                    <a data-ajax="false" href="../views/capturar.php"><p><?php echo _("Nueva búsqueda") ?></p></a>
                </li>
                <li>
                    <a data-ajax="false" href="info.php" ><p><?php echo _("Acerca de") ?></p></a>
                </li>
                <li>
                    <a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><p><?php echo _("Ayuda") ?></p></a>
                </li>

		                </ul>
            <br>
            <div id="btnclose" align="center">
                <a href="#demo-links" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline"><?php echo _("Cerrar") ?></a>
            </div>
        </div>

  </body>
</html>
