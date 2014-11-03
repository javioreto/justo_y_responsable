<?php
include_once ("../init.php");
    $id =  $_SESSION["iduser"];
    $admin =  $_SESSION["admin"];
    if($id==""){
        header('Location: ./login.php');
    }

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

$user = Load::loadUserById($id);
?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> JyR </title>
        
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet"  href="../css/customInformationEstablishment.css">

        <script src="../js/static/jquery.js"></script>
        <script type="text/javascript" src="../js/gestionEstablishmentFunctions.js"></script>
        
        <script src="../js/static/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="../js/static/gmaps.js"></script>
       
        
    </head>
        
        <div class="bs-docs-header" id="content">
            <div class="container">
                <div class="col-md-9">
                <a href="login.php" ><img style="float: left"  src="../../images/logojyr.png" /></a>
                <a href="login.php"><h1 id="titleheader" ><?php echo _("Justo y Responsable") ?></h1></a>
            </div>
            <div class="nav navbar-right col-md-2 col-md-offset-1">
                <p><?php echo _("Bienvenid@: ") ?><?php echo $user->getName() ?></p>
                <a id="textclose"  href='../controller/closeSession.php'><?php echo _("Cerrar sesión") ?></a>
            </div>
          </div>
        </div>
             
        <?php
        $idEstablishment =$_GET['id'];
        $establishment = Load::loadEstablishmentById($idEstablishment);
        $deletefunction = "deleteEstablishment($idEstablishment)";
        ?>
        
        <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
          <div class="container">
            <div class="navbar-header">
              <button id="menunav" class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <p id="textnav2" class="navbar-brand"><?php echo _("Establecimiento: "); echo $establishment->getName() ?></p>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="editEstablishment.php?id=<?php echo $idEstablishment ?>"><?php echo _("Editar") ?></a></li>
                <li><a data-toggle="modal" data-target=".bs-example-modal-sm"><?php echo _("Borrar") ?></a></li>
                <?php
                        if($_SESSION["gestionestablishment"]=="no"){
                            $id = $_SESSION["selectedUser"];
                        ?>
                            <li><a href="informationUser.php?id=<?php echo $id ?>"><?php echo _("Volver") ?></a></li>
                            <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                            <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                        <?php
                        }else{
                        ?>
                            <li><a href="gestionEstablishment.php"><?php echo _("Volver") ?></a></li>
                            <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                            <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                            <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
                        <?php
                        }
                        ?>
              </ul>
            </nav>
          </div>
        </header>  
        
        
    
    <body>
        
        <div class="col-md-12">
            <div class="form-horizontal col-md-offset-0 col-md-4" role="form">
                <div class="form-group">
                    <label class="col-md-3"><?php echo _("Imagen:") ?></label>
                    <div class=" col-md-offset-2 col-md-6">
                        <?php
                        if($establishment->getLogo()!=""){
                        ?>
                            <img  id="imglogo" src="<?php echo $establishment->getLogo() ?>" class="img-responsive" alt="Responsive image">
                        <?php
                        }else{
                        ?>
                            <img id="imglogo" src="../../images/nofoto.jpg" class="img-responsive" alt="Responsive image">
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Teléfono:") ?></label>
                    <div class=" col-md-6">
                        <?php
                        if($establishment->getPhone()==0){
                        ?>
                            <p></p>
                        <?php    
                        }else{
                        ?>
                            <p> <?php echo $establishment->getPhone() ?> </p>
                        <?php    
                        }
                        ?>
                        
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Correo electrónico:") ?></label>
                    <div id="maildiv" class=" col-md-6">
                        <p> <?php echo $establishment->getMail() ?> </p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Página web:") ?></label>
                    <div id="websitelink" class=" col-md-6">
                        <a target="_blank" href="<?php echo $establishment->getWebSite() ?>" > <?php echo $establishment->getWebSite() ?> </a>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Horario:") ?></label>
                    <div class=" col-md-6">
                        <p> <?php echo $establishment->getSchedule() ?> </p>
                    </div>
                </div>
                
            </div>
            
            <div class="form-horizontal col-md-4 " role="form">
                
                <div class="form-group">
                    <label class="col-md-7"><?php echo _("Organización perteneciente:") ?></label>
                    <div class="col-md-5">
                        <?php
                        $allnetwork = Load::loadNetworkByEstablishment($establishment);
                        ?>
                        <p> <?php echo $allnetwork ?> </p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Organización importadora:") ?></label>
                    <div class=" col-md-6">
                        <?php
                        $allimport = Load::loadImportOrganizationByEstablishment($establishment);
                        ?>
                        <p> <?php echo $allimport ?> </p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Sector:") ?></label>
                    <div class=" col-md-6">
                        <?php
                        if($establishment->getSector()->getName()=="Comercio justo"){ 
                        ?>
                            <p> <?php echo _("Comercio justo") ?> </p>
                        <?php    
                        }
                        if($establishment->getSector()->getName()=="Banca etica"){
                        ?>
                            <p> <?php echo _("Banca ética") ?> </p>
                        <?php    
                        }
                        if($establishment->getSector()->getName()=="Economia solidaria"){
                        ?>
                            <p> <?php echo _("Economía solidaria") ?> </p>
                        <?php    
                        }
                        if($establishment->getSector()->getName()=="Consumidores y usuarios organizados"){
                        ?>
                            <p> <?php echo _("Consumidores y usuarios organizados") ?> </p>
                        <?php
                        }
                        ?>
                       <!-- <p> <?php echo $establishment->getSector()->getName() ?> </p>-->
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Tipo:") ?></label>
                    <div class=" col-md-6">
                        <p> <?php echo $establishment->getNature()->getName() ?> </p>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Forma de pago:") ?></label>
                    <div class=" col-md-6">
                        <?php
                        $pay = "";
                        if($establishment->getCash()==1){
                            $pay .= "Moneda social ,";
                        }
                        if($establishment->getCard()==1){
                            $pay .= "Tarjeta ,";
                        }
                        $pay = substr($pay, 0, -1);
                        ?>
                        <p> <?php echo $pay ?> </p>
                    </div>
                </div>
                <?php
                if($establishment->getFacebook()!=""){
                ?>
                    <div class="form-group">
                    <label class="col-md-6"><?php echo _("Facebook:") ?></label>
                    <div id="facelink" class=" col-md-6">
                        <a href="<?php echo $establishment->getFacebook() ?>" > <?php echo $establishment->getFacebook() ?> </a>
                    </div>
                </div>  
                <?php
                }
                if($establishment->getTwitter()!=""){
                ?>
                    <div class="form-group">
                        <label class="col-md-6"><?php echo _("Twitter:") ?></label>
                        <div id="twitterlink" class=" col-md-6">
                            <a href="<?php echo $establishment->getTwitter() ?>" > <?php echo $establishment->getTwitter() ?> </a>
                        </div>
                    </div>
                <?php
                }
                ?>
                
                <div class="form-group">
                    <label class="col-md-6"><?php echo _("Acceso para discapacitados:") ?></label>
                    <div class=" col-md-6">
                        <?php
                        if($establishment->getDisableAccess()==1){
                        ?>
                            <p> <?php echo _("Si") ?> </p>
                        <?php
                        }else{
                        ?>
                            <p> <?php echo _("No") ?> </p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                
             </div>
            
            <div class="form-horizontal col-md-4 " role="form">
                
                <div id="panelubication" class="panel panel-default">
                  <div id="headpanelubication" class="panel-heading col-md-13">
                    <h3 class="panel-title"><?php echo _("Ubicación") ?></h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-horizontal" role="form">
                      <div class="form-group">
                        <label for="address" class="col-md-2"><?php echo _("Dirección:") ?></label>
                        <div class="col-md-offset-1 col-md-9">
                          <p> <?php echo $establishment->getAddress() ?> </p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="cp" class="col-md-1"><?php echo _("C.P:") ?></label>
                        <div class=" col-md-3">
                          <p> <?php echo $establishment->getPostCode() ?> </p>
                        </div>
                        <label for="locality" class="col-md-2"><?php echo _("Localidad:") ?></label>
                        <div class="col-md-offset-1 col-md-5">
                          <p> <?php echo $establishment->getLocation() ?> </p>
                        </div>
                        <div class="form-group">

                              <div class="col-md-offset-1 col-md-10">
                        
                                <div class="google-map-canvas" id="map-canvas"> </div>

                              </div>
                       
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
          </div>
          <?php
          if($establishment->getSector()->getName()=="Comercio justo"){
          ?>
          <div class="col-md-12">
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div id="headpanelproducts" class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      <?php echo _("Sección de productos") ?>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div id="bodypanelproducts" class="panel-body">
                    <?php
                    $products = Load::loadProductsEstablishment($establishment->getIdEstablishment());
                    if(count($products)){
                    ?>
                        <ul class="list-group">
                        <?php
                            foreach($products AS $p){                            
                            ?>
                            <li class="list-group-item">
                                <h4 class="list-group-item-heading"><?php echo $p->getName() ?></h4>
                                <p class="list-group-item-text"><?php echo $p->getDescription() ?></p>
                            </li>
                            <?php    
                            }
                        ?>
                        </ul>
                    <?php
                    }else{
                    ?>
                    <p><?php echo _("No existen productos asociados a este establecimiento. Para añadir productos a este, pulse 'Editar' en el menu de navegación") ?></p>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        <?php
        }
        ?>
        
        <div class="col-md-12">
            <div class="panel-group" id="accordioncomments">
              <div class="panel panel-default">
                <div id="headpanelcomment" class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordioncomments" href="#collapseTwo">
                      <?php echo _("Sección de comentarios") ?>
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in">
                  <div id="bodypanelcomment" class="panel-body">
                    <?php
                    $comments = Load::loadCommentByIdEstablishment($establishment->getIdEstablishment());
                    if(count($comments)){
                    ?>
                        <ul class="list-group">
                        <?php
                            foreach($comments AS $c){                            
                            ?>
                            
                            <li id="<?php $c->getIdComment() ?>" class="list-group-item">
                                <p align="right" class="list-group-item-text"><small><?php echo $c->getDate() ?></small></p>
                                <h4 id="author" class="list-group-item-heading"><?php echo $c->getAuthor() ?></h4>
                                <p class="list-group-item-text"><?php echo $c->getDescription() ?></p>
                            </li>
                            <?php    
                            }
                        ?>
                        </ul>
                    <?php
                    }else{
                    ?>
                    <p><?php echo _("No existen comentarios sobre este establecimiento") ?></p>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo _("Confirmación") ?></h4>
              </div>
              <div class="modal-body">
                <?php echo _("¿Seguro que quiere eliminar el establecimiento?") ?>
              </div>
              <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal"><?php echo _("Cancelar") ?></button>
                
                <button type="button"  onclick="<?php echo $deletefunction ?>" class="btn btn-primary"><?php echo _("Aceptar") ?></button>
              </div>
              
            </div>
          </div>
        </div>
        
        <script>
                var lat = "<?php echo $establishment->getLatitude() ?>";
                var lng = "<?php echo $establishment->getLongitude() ?>";
                
                var map = new GMaps({
                    el: document.getElementById("map-canvas"),
                    lat: lat,
                    lng: lng,
                    zoom : 15,
                });
                map.addMarker({
                    lat: lat,
                    lng: lng,
                });
        </script>
    </body> 

</html>
