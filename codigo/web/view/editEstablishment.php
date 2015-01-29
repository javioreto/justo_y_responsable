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

$idEstablishment = $_GET['id'];
$_SESSION["idEstablishmentEdit"] = $idEstablishment;
$establishment = Load::loadEstablishmentById($idEstablishment);
$refUser = Load::loadUserEstablishment($idEstablishment);
$user = Load::loadUserById($id);
?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> JyR </title>
        
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
        
        
        <link rel="stylesheet"  href="../css/customEditEstablishment.css">

        <script src="../js/static/jquery.js"></script>
        <script src="../js/static/AjaxUpload.2.0.min.js"></script>

        <script type="text/javascript" src="../js/editEstablishmentFunctions.js"></script>
        
        <script src="../js/static/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="../js/static/gmaps.js"></script>
        
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
        
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
    
    
        <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
          <div class="container">
            <div class="navbar-header">
              <button id="menunav" class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <p id="textnav2" class="navbar-brand"><?php echo _("Formulario de edición") ?></p>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                <?php
                $funvolver = "volverInformation($idEstablishment)"; 
                $funinicio = "volverInicio($idEstablishment)";
                if($admin==1){
                ?>
                <li><a href="#" onclick='<?php echo $funvolver ?>'><?php echo _("Volver") ?></a></li>
                <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                <li><a data-ajax="false" href="#" onclick='<?php echo $funinicio ?>' ><?php echo _("Inicio") ?></a></li>
                <?php
                }else{
                ?>
                <li><a href="#" onclick='<?php echo $funvolver ?>'><?php echo _("Volver") ?></a></li>
                <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                <?php    
                }
                ?>
              </ul>
            </nav>
          </div>
        </header>
     
    <body>
        
        <form id="uploadEstablishment" onsubmit="return valida()" enctype="multipart/form-data" action="../controller/uploadEstablishment.php" method="POST">
            <div style="margin-top: -10px; margin-bottom: 10px;" id="btndarsedealta" class="col-md-offset-10 col-md-2">
                    <button id="btnalta" class="btn btn-default" type="submit" ><?php echo _("Guardar") ?></button>
                </div>
            <input type="hidden" id="refuser" name="refuser" value="<?php echo $refUser ?>"/>
        <div class="col-md-12">
            <div id="alertCampos" class="alert alert-danger" style="display: none">
               <button type="button" class="close" onclick="$('#alertCampos').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Debe completar todos los campos marcados con (*).") ?>
            </div>
            <div id="alertCamposImp" class="alert alert-danger" style="display: none">
               <button type="button" class="close" onclick="$('#alertCamposImp').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Si el establecimiento no pertenece a la CECJ, debe indicar la organización importadora.") ?>
            </div>
            <div id="alertAddress" class="alert alert-danger" style="display: none">
               <button type="button" class="close" onclick="$('#alertAddress').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("La dirección no es correcta, debe seleccionar una de la lista.") ?>
            </div>
            

            <div class="form-horizontal col-md-offset-0 col-md-4" role="form">
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label"><?php echo _("*Nombre:") ?></label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo _("Nombre") ?>" value="<?php echo $establishment->getName() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2" for="exampleInputFile" ><?php echo _("Imagen") ?></label>
                    <?php
                    if($establishment->getLogo()==""){
                    ?>
                        <img id="imglo" src="../../images/nofoto.jpg" />
                    <?php
                    }else{
                    ?>
                        <img id="imglo" src="<?php echo $establishment->getLogo() ?>" />
                    <?php
                    }
                    ?>
                    <input type="file" id="file" accept=".png,.jpg,.gif" name="uploadedfile" class="col-md-10">
                    <input type="hidden" id="stringlogo" name="stringlogo" value="<?php echo $establishment->getLogo() ?>" />
                </div>
                <div id="panelubication" class="panel panel-default">
                  <div id="headpanelubication" class="panel-heading col-md-13">
                    <h3 class="panel-title"><?php echo _("Ubicación") ?></h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-horizontal" role="form">
                      <div class="form-group">         
                        <label for="address" class="col-md-2"><?php echo _("*Dirección:") ?></label>
                        <div class="col-md-offset-1 col-md-9">
                            <input type="hidden" id="adr" name="adr" />
                            <input type="hidden" id="lat" name="miLat" />
                            <input type="hidden" id="lng" name="miLng" />
                            <input type="hidden" id="cp" name="cp" />
                            <input type="hidden" id="locality" name="locality" />
                            <input type="text" class="form-control" id="address" name="address" autocomplete="on" runat="server" value="<?php echo $establishment->getAddress() ?>">
                        </div>
                      </div>
                      <div class="form-group">
                          
                        <div class="form-group">

                              <div class="col-md-offset-1 col-md-10">
                        
                                <div class="google-map-canvas" id="map-canvas"> </div>

                              </div>
                       
                        </div>
                      </div>
                      <div class="form-group">
                          <div style="margin-top: -20px; margin-bottom: -20px;" class="col-md-12">
                            <p><?php echo _("Pulsa sobre el mapa para localizar manualmente.") ?></p>
                          </div>
                   <div class="col-md-12">
                       <label >
                         <input id="online" type="checkbox" name="online" value="1" <?php if($establishment->getOnline()==1){ echo('checked="checked"'); } ?> > <?php echo "Soy un establecimiento online." ?></input>
                       </label>
                   </div>

                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
            
            <div class="form-horizontal col-md-4 " role="form">
                <div class="form-group">
                    <label for="phone" class="col-md-3 control-label"><?php echo _("Teléfono:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                        
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="<?php echo _("Teléfono") ?>" value="<?php echo $establishment->getPhone() ?>">
                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label"><?php echo _("Email:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                        
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo _("Email") ?>" value="<?php echo $establishment->getMail() ?>">
                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="site" class="col-md-3 control-label"><?php echo _("Página web:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                        
                            <input type="url" class="form-control" id="site" name="site" placeholder="Ej:http://comerciojusto.org/" value="<?php echo $establishment->getWebSite() ?>">
                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule" class="col-md-3 control-label"><?php echo _("Horario:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                            <input type="text" class="form-control" id="schedule" name="schedule" placeholder="<?php echo _("Horario") ?>" value="<?php echo $establishment->getSchedule() ?>">
                    </div>
                </div>
                
                <div id="orgPerSection" class="col-md-offset-1">
                    <label class="control-label"><?php echo _("*Organización perteneciente:") ?></label>
                    <div class="form-horizontal" role="form">
                        <div class="form-group">
                         <div id="chnetwork" class="checkbox">
                        <?php
                            $network = Load::loadNetwork(); 
                            foreach($network AS $net){
                                $entra = false;
                                $array = $establishment->getReds();
                                if($net->getName()=="CECJ"){
                                    foreach($array AS $a){
                                        if($a==$net->getIdNetwork()){
                                            $entra = true;   
                                        }
                                    }
                                
                                    if($entra){
                                    ?>
                                    <div class="col-md-12">
                                        <label >
                                          <input id="<?php echo $net->getIdNetwork() ?>" type="checkbox" name="network[]" checked = "true" value="<?php echo $net->getIdNetwork() ?>"><?php echo "Coordinadora Estatal de Comercio Justo (CECJ)" ?></input>
                                        </label>
                                    </div>
                                    <?php
                                    $entra = false;
                                    }else{
                                    ?>
                                    <div class="col-md-12">
                                        <label>
                                          <input id="<?php echo $net->getIdNetwork() ?>" type="checkbox" name="network[]" value="<?php echo $net->getIdNetwork() ?>" ><?php echo "Coordinadora Estatal de Comercio Justo (CECJ)" ?></input>
                                        </label>
                                    </div>
                                    <?php    
                                    }
                                }
                          }
                          
                          foreach($network AS $net){
                                $entra = false;
                                $array = $establishment->getReds();
                                if($net->getName()!="CECJ"){
                                    foreach($array AS $a){
                                        if($a==$net->getIdNetwork()){
                                            $entra = true;   
                                        }
                                    }
                                
                                    if($entra){
                                    ?>
                                    <div class="col-md-6">
                                        <label >
                                          <input id="<?php echo $net->getIdNetwork() ?>" type="checkbox" name="network[]" checked = "true" value="<?php echo $net->getIdNetwork() ?>"><?php echo $net->getName() ?></input>
                                        </label>
                                    </div>
                                    <?php
                                    $entra = false;
                                    }else{
                                    ?>
                                    <div class="col-md-6">
                                        <label>
                                          <input id="<?php echo $net->getIdNetwork() ?>" type="checkbox" name="network[]" value="<?php echo $net->getIdNetwork() ?>" ><?php echo $net->getName() ?></input>
                                        </label>
                                    </div>
                                    <?php    
                                    }
                                }
                          }
                          ?>
                       </div>
                      </div>
                    </div>
                </div>
                
                
                <div id="redSection" class="col-md-offset-1">
                    <label class="control-label"><?php echo _("Organización importadora:") ?></label>
                    <div class="form-horizontal" role="form">
                        <div class="form-group">
                         <div id="chorgimp" class="checkbox">
                                                  
                          <?php
                            $importOrganization = Load::loadImportOrganization(); 
                            foreach($importOrganization AS $imp){
                                $entra = false;
                                $array = $establishment->getImportOrganizations();
                                foreach($array AS $a){
                                    if($a==$imp->getIdImportOrganization()){
                                        $entra = true;   
                                    }
                                }
                                if($entra){
                                ?>
                                    <div class="col-md-6">
                                        <label>
                                          <input id="<?php echo $imp->getIdImportOrganization() ?>" type="checkbox" checked="true" name="orgimp[]" value="<?php echo $imp->getIdImportOrganization() ?>" ><?php echo $imp->getName() ?></input>
                                        </label>
                                    </div>
                                <?php
                                    $entra = false;
                                }else{
                                ?>
                                <div class="col-md-6">
                                    <label>
                                    <input id="<?php echo $imp->getIdImportOrganization() ?>" type="checkbox" name="orgimp[]" value="<?php echo $imp->getIdImportOrganization() ?>" ><?php echo $imp->getName() ?></input>
                                    </label>
                                </div>
                                <?php    
                                }
                          ?>
                                                                   
                          <?php
                          }
                          ?>
                       </div>
                      </div>
                    </div>
                </div>
                
                
             </div>
            
            <div class="form-horizontal col-md-4 " role="form">
                <div id="divpanelsocial" class="form-horizontal  col-md-12" role="form">
                    <div class="panel panel-default">
                      <div id="headpanelsocial" class="panel-heading col-md-13">
                        <h3 class="panel-title"><?php echo _("Redes sociales") ?></h3>
                      </div>
                      <div id="bodypanelsocial" class="panel-body">
                        <div class="form-horizontal" role="form">
                          <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-2">
                                <label >
                                    <?php
                                    if($establishment->getFacebook()==""){
                                    ?>
                                  <input id="chface" name="chface" onclick="showurlFace()" type="checkbox">Facebook</input>
                                  <?php
                                    }else{
                                  ?>
                                  <input id="chface" checked="true" name="chface" onclick="showurlFace()" type="checkbox">Facebook</input>
                                  <?php
                                    }
                                  ?>
                                </label>
                                </div>
                                <div class=" col-md-offset-1 col-md-8">
                                 <input id="inputFacebook" name="inputFacebook" type="url" class="form-control" value="<?php echo $establishment->getFacebook() ?>">
                                </div>
                                
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-2">
                                <label >
                                    <?php
                                    if($establishment->getTwitter()==""){
                                    ?>
                                  <input id="chtwitter" name="chtwitter" onclick="showurlTwitter()" type="checkbox">Twitter</input>
                                  <?php
                                    }else{
                                  ?>
                                  <input id="chtwitter" checked="true" name="chtwitter" onclick="showurlTwitter()" type="checkbox">Twitter</input>
                                  <?php
                                    }
                                  ?>
                                </label>
                                </div>
                                <div class=" col-md-offset-1 col-md-8">
                                 <input id="inputTwitter" name="inputTwitter" type="url" class="form-control" value="<?php echo $establishment->getTwitter() ?>">
                                </div>
                                
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            
                <div id="divpanelpay" class="form-horizontal  col-md-12" role="form">
                    <div class="panel panel-default">
                      <div id="headpanelpay" class="panel-heading col-md-13">
                        <h3 class="panel-title"><?php echo _("Formas de pago y acceso") ?></h3>
                      </div>
                      <div id="bodypanelpay" class="panel-body">
                        <div class="form-horizontal" role="form">
                          <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-6">
                                <label>
                                    <?php
                                    if($establishment->getCash()==1){
                                    ?>
                                        <input id="cash" type="checkbox" name="cash" checked="true"><?php echo _("Moneda social") ?></input>
                                    <?php
                                    }else{
                                    ?>
                                        <input id="cash" type="checkbox" name="cash"><?php echo _("Moneda social") ?></input>
                                    <?php
                                    }
                                    ?>
                                </label>
                                </div>
                                
                                    <div  class="col-md-offset-2 col-md-2">
                                    <label>
                                      <?php
                                        if($establishment->getCard()==1){
                                        ?>
                                            <input id="card" type="checkbox" checked="true" name="card"><?php echo _("Tarjeta") ?></input>
                                        <?php
                                        }else{
                                        ?>
                                            <input id="card" type="checkbox" name="card"><?php echo _("Tarjeta") ?></input>
                                        <?php
                                        }
                                        ?>
                                    </label>
                                    </div>
                                                               
                            </div>
                          </div>
                          <div class="form-group">
                              <div class="checkbox">
                                <div class="col-md-8">
                                    <label>
                                        <?php
                                        if($establishment->getDisableAccess()==1){
                                        ?>
                                            <input id="disableaccess" type="checkbox" checked="true" name="disableaccess" ><?php echo _("Acceso para discapacitados") ?></input>
                                        <?php
                                        }else{
                                        ?>
                                            <input id="disableaccess" type="checkbox" name="disableaccess" ><?php echo _("Acceso para discapacitados") ?></input>
                                        <?php
                                        }
                                        ?>
                                    </label>                                
                                </div>
                               </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-11">
                        <label><?php echo _("*Sector") ?></label>
                         <select id="selectSector" name="selectSector" class="form-control">
                          <option value="sector"><?php echo _("-- Seleccione uno --") ?></option>
                          <option value="1"><?php echo _("Comercio justo") ?></option>
                          <option value="2"><?php echo _("Banca ética") ?></option>
                          <option value="3"><?php echo _("Economía solidaria") ?></option>
                          <option value="4"><?php echo _("Consumidores y usuarios organizados") ?></option>
                          
                          
                         </select>
                     </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-11">
                        <label><?php echo _("*Tipo") ?></label>
                        <select id="selectType" name="selectType" class="form-control">
                          <option value="type"><?php echo _("-- Seleccione uno --") ?></option>
                          <?php
                            $type = Load::loadType(); 
                            foreach($type AS $t){
                                echo "<option value=".$t->getIdType().">"; 
                                echo _($t->getName());
                                echo "</option>";
                            }
                          ?>
                         </select>
                     </div>
                </div>
                
                <input type="hidden" id="idproducts" name="idproducts" />
                <input type="hidden" id="idproductsnew" name="idproductsnew" />
                
                <input type="hidden" id="idcomments" name="idcomments" />
                <input type="hidden" id="idcommentsnew" name="idcommentsnew" />
            </div>
          </div> 
        
        </form>
        
        <div id="productSection" class="col-md-12">
        <a name="editar"></a>
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
                    
                    <?php if($_REQUEST['idprod']=="") {?>
                    
                    <div id="divpanelnewproduct" class="form-horizontal  col-md-12" role="form">
                        <div class="panel panel-default">
                          <div id="headpanelnewproduct" class="panel-heading col-md-13">
                            <h3 class="panel-title"><?php echo _("Nuevo producto") ?></h3>
                          </div>
                          <div id="bodypanelnewproduct" class="panel-body">
                            <div id="alertCampos" class="alert alert-danger" style="display: none">
                               <button type="button" class="close" onclick="$('#alertCampos').hide()" aria-hidden="true">&times;</button>
                               <strong><?php echo _("Error: ") ?></strong><?php echo _("Debe completar todos los campos.") ?>
                            </div>
                            <div class="form-horizontal col-md-offset-0 col-md-5" role="form">
                                  <div class="form-group">
                                    <label for="codedata" class="col-md-3 control-label"><?php echo _("Código:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                      <input type="text" class="form-control" id="codedata" placeholder="<?php echo _("Código de barras") ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="namedata" class="col-md-3 control-label"><?php echo _("*Nombre:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                      <input type="text" class="form-control" id="namedata" placeholder="<?php echo _("Nombre") ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descriptiondata" class="col-md-3 control-label"><?php echo _("Descripción:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                        <textarea class="form-control" id="descriptiondata" placeholder="<?php echo _("Descripción") ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-horizontal col-md-offset-0 col-md-7" role="form">
                             <div class="form-group">
                                    <label for="imgdata" class="col-md-3 control-label"><?php echo _("Imagen:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                         <button id="upload_button" class="btn btn-default"><?php echo _("Seleccionar imagen") ?></button>
                                         <input type="text" value="" id="nameimg" style="visibility:hidden">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label for="catdata" class="col-md-3 control-label"><?php echo _("Categoría:") ?></label>
                                    <div id="divSelect" class="col-md-offset-1 col-md-8">
                                        <input type="hidden" id="cat" name="cat" />
                                        <input type="hidden" id="num" name="num" />
                                        <select id="cat0" class="paramCateg form-control" onchange="addSubCat(this.id)">
                                            <option value="0"><?php echo _("-- *Seleccionar Categoría --") ?></option>
                                            <?php
                                            $categories = Load::loadCategories(); 
                                            foreach($categories AS $cat){
                                                echo "<option value=".$cat->getIdCategory().">"; 
                                                echo _($cat->getName());
                                                echo "</option>";
                                            }
                                            ?>
                                         </select>
                                     </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-10 col-md-2">
                                        <button id="btnadd" class="btn btn-default" onclick="addProducts()"><?php echo _("Añadir") ?></button>
                                     </div>
                                </div>
                            </div>
                            </div>
                          
                          </div> </div>
                          <?php }else{ 
                          
                         $products = Load::loadProductById($_REQUEST['idprod']);
                          
                          ?>
                                      <div id="alertOK" class="alert alert-success" style="display: none">
               <button type="button" class="close" onclick="$('#alertOK').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Correcto: ") ?></strong><?php echo _("Se ha actualizado el producto satisfactóriamente.") ?>
            </div>

                           <div id="divpanelnewproduct" class="form-horizontal  col-md-12" role="form">
                        <div class="panel panel-default">
                          <div id="headpanelnewproduct" class="panel-heading col-md-13">
                            <h3 class="panel-title"><?php echo _("Editar producto") ?></h3>
                            <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['idprod']; ?>">
                          </div>
                          <div id="bodypanelnewproduct" class="panel-body">
                            <div id="alertCampos" class="alert alert-danger" style="display: none">
                               <button type="button" class="close" onclick="$('#alertCampos').hide()" aria-hidden="true">&times;</button>
                               <strong><?php echo _("Error: ") ?></strong><?php echo _("Debe completar todos los campos.") ?>
                            </div>
                            <div class="form-horizontal col-md-offset-0 col-md-5" role="form">
                                  <div class="form-group">
                                    <label for="codedata" class="col-md-3 control-label"><?php echo _("Código:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                      <input type="text" class="form-control" id="codedata" value="<?php echo $products->getCod(); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="namedata" class="col-md-3 control-label"><?php echo _("*Nombre:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                      <input type="text" class="form-control" id="namedata" value="<?php echo $products->getName(); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descriptiondata" class="col-md-3 control-label"><?php echo _("Descripción:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                        <textarea class="form-control" id="descriptiondata"><?php echo $products->getDescription(); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-horizontal col-md-offset-0 col-md-7" role="form">
                             <div class="form-group">
                                    <label for="imgdata" class="col-md-3 control-label"><?php echo _("Imagen:") ?></label>
                                    <div class="col-md-offset-1 col-md-8">
                                         <button id="upload_button" class="btn btn-default"><?php echo _("Seleccionar imagen") ?></button>
                                         <input type="text" value="<?php echo $products->getImg(); ?>" id="nameimg" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label for="catdata" class="col-md-3 control-label"><?php echo _("Categoría:") ?></label>
                                    <div id="divSelect" class="col-md-offset-1 col-md-8">
                                        <input type="hidden" id="cat" name="cat" />
                                        <input type="hidden" id="num" name="num" />
                                                     <?php
                                            $catsuperior=1;
                                            $cats = Load::loadAllCat();
                                            foreach($cats AS $cat){
                                                if($products->getRef()==$cat->getIdCategory()){
                                               	 $catsuperior=$cat->getRefCategory();
                                                }
                                            } 
                                            
                                            ?>
                                     
                                        <select id="cat0" class="paramCateg form-control" onchange="addSubCat(this.id)">
                                            <option value="0"><?php echo _("-- *Seleccionar Categoría --") ?></option>
                               

                                            <?php
                                            $categories = Load::loadCategories(); 
                                            foreach($categories AS $cat){
                                            
                                                echo '<option value="'.$cat->getIdCategory().'"';
                                                if($catsuperior==$cat->getIdCategory()){
                                               	 echo ' selected="selected"';
                                                }
                                                echo">"; 
                                                echo _($cat->getName());
                                                echo "</option>";
                                            }
                                            
                                            ?>
                                         </select>
                                     </div>
                                </div>
                                  <script type="text/javascript">
                                  addSubCats(document.getElementById('cat0').value, <?php echo $products->getRef(); ?>);
                                  document.getElementById('cat').value=<?php echo $products->getRef(); ?>;
                                  document.getElementById('num').value=2;
                                  </script>
                                <div class="form-group">
                                    <div class="col-md-offset-10 col-md-2">
                                        <button id="btnadd" class="btn btn-default" onclick="editProduct(<?php echo $_REQUEST['id']; ?>)"><?php echo _("Modificar") ?></button>
                                     </div>
                                </div>
                            </div>
                            </div>
                          
                          </div> </div>
                   <?php } ?>
                   
                    <div id="titleallproduct">
                        <h3><?php echo _("Todos los productos") ?></h3>
                    </div>
                    <ul id="listProduct" class="list-group">
                    <?php
                    $products = Load::loadProductsEstablishment($establishment->getIdEstablishment());
                    if(count($products)){
                    
                        foreach($products AS $p){ 
                        ?>                      
                        
                        <li id="<?php echo $p->getIdProduct() ?>" class="list-group-item">
                            <?php $funcdelete = "deleteProduct(".$p->getIdProduct().")"?>
                            <h4 class="list-group-item-heading"><?php echo $p->getName() ?></h4>
                            <button id="btdelp" style='float:right; margin-top:-30px;' class='btn btn-default' onclick='<?php echo $funcdelete ?>' >Borrar</button>
                            <a id="btdedit" style='float:right; margin-top:-30px; margin-right:10px;' class='btn btn-default' href="editEstablishment.php?id=<?php echo $_REQUEST['id'].'&idprod='.$p->getIdProduct(); ?>#editar">Editar</a>            
                            <p class="list-group-item-text"><?php echo $p->getDescription() ?></p>
                        </li>
                        <?php    
                        }
                    }
                    ?>
                    </ul>
                  </div>
                </div>
              </div>
              
            </div>
        </div>
        
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
                                <ul id="listcom" class="list-group">
                                <?php
                                    foreach($comments AS $c){                            
                                    ?>
                                    
                                    <li id="<?php echo $c->getIdComment() ?>" class="list-group-item">
                                        <p align="right" class="list-group-item-text"><small><?php echo $c->getDate() ?></small></p>
                                        <?php
                                        if($admin==1){
                                            $func = "deleteComment(".$c->getIdComment().")";
                                        ?>
                                            <button id="btndletecomment" class='btn btn-default' onclick="<?php echo $func ?>">Borrar</button>
                                        <?php    
                                        }
                                        ?>
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
        
            <div class="col-md-10">
                <small><?php echo _("Los campos marcados con (*) deben rellenarse obligatoriamente.") ?></small>
            </div>
          
        <script>
        
        
            document.getElementById('cp').value = "<?php echo $establishment->getPostCode() ?>";
            document.getElementById('selectSector').value = "<?php echo $establishment->getSector()->getIdSector() ?>";
            document.getElementById('selectType').value = "<?php echo $establishment->getNature()->getIdType() ?>";
            getArrayIdsProducts("<?php echo $establishment->getIdEstablishment() ?>");
            
            var lat = "<?php echo $establishment->getLatitude() ?>";
            var lng = "<?php echo $establishment->getLongitude() ?>";
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            
            var locality = "<?php echo $establishment->getLocation() ?>";
            document.getElementById('locality').value = locality;
            var adr = "<?php echo $establishment->getAddress() ?>";
            document.getElementById('adr').value = adr;
           
            searchGoogle();
            var markers = [];
           
            var map = new GMaps({
                el: document.getElementById("map-canvas"),
                lat: lat,
                lng: lng,
                zoom : 15,
                click: function(e) {
                    lat= e.latLng.lat();
                    lng = e.latLng.lng();
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                    
                    var geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(lat, lng);
                    geocoder.geocode({"latLng":latlng},function(data,status){
                        if(status == google.maps.GeocoderStatus.OK){
                            var dir = data[0].address_components;
                            document.getElementById('address').value = data[0].formatted_address;
                            var address = dir[1].long_name +","+ dir[0].long_name;
                            var locality = dir[2].long_name;
                            var cp = dir[6].long_name;
                            document.getElementById('adr').value = address;
                            document.getElementById('locality').value = locality;
                            document.getElementById('cp').value = cp;
                            a.setMap(null);
                            a = map.addMarker({
                                lat: lat,
                                lng: lng
                            });
                        }
                    });
                    
                },
            });
            
            var a = map.addMarker({
                lat: lat,
                lng: lng
            });
            
            if($('#selectSector').val()=="1"){     
                $("#productSection").show();
                $("#redSection").show();
            }else{
                $("#productSection").hide();
                $("#redSection").hide();
                
            }
            $('#selectSector').on("change",showhideproducts);
            
            if(document.getElementById("chface").checked){
                $("#inputFacebook").show();
            }else{
                $("#inputFacebook").hide();
            }
            
            if(document.getElementById("chtwitter").checked){
                $("#inputTwitter").show();
            }else{
                $("#inputTwitter").hide();
            }
            
            
        </script>
        
    </body> 

</html>
