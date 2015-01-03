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
        <link rel="stylesheet"  href="../css/customNewEstablishment.css">

        <script src="../js/static/jquery.js"></script>
        
        <script type="text/javascript" src="../js/newEstablishmentFunctions.js"></script>        
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
              <p id="textnav2" class="navbar-brand"><?php echo _("Nuevo establecimiento") ?></p>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                  <?php
                  if($admin==1){
                      ?>
                <li><a onclick='volver()'><?php echo _("Volver") ?></a></li>
                <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
                <?php
                  }else{
                ?>
                <li><a onclick='volver()'><?php echo _("Volver") ?></a></li>
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
        
        <form id="addEstablishment" onsubmit="return valida()" enctype="multipart/form-data" action="../controller/addEstablishment.php" method="POST">
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
            <div class="form-group col-md-offset-10 col-md-2">
                <div style="margin-top: -10px; margin-bottom: 10px;" id="btndarsedealta">
                    <button id="btnalta" class="btn btn-default" type="submit" ><?php echo _("Dar de alta")  ?></button>
                </div>
            </div>  
            <?php
            if($admin==1){
            ?>
            <div class="form-inline">
                <div class="form-group col-md-offset-0 col-md-2">
                    <div>
                        <label>*Usuario asociado:</label>
                    </div>
                </div>
                <div id="selectuser" class="form-group col-md-offset-0 col-md-3">
                    <div >
                         <select id="selectUsers" name="selectUsers" class="form-control">
                          <option value="0"><?php echo _("--  Seleccione uno --") ?></option>
                          <?php
                            $user = Load::loadUserValidNoAdmin(); 
                            foreach($user AS $u){
                            ?> 
                                <option value="<?php echo $u->getIduser() ?>"><?php echo $u->getSurName() ?>, &nbsp <?php echo $u->getName() ?> &nbsp (<?php echo $u->getDni() ?>)</option>
                            <?php
                            }
                          ?>
                         </select>
                     </div>
                </div>
                        
            </div>
            <?php
            }
            ?>
            
        <div class="col-md-12">
            
            <div class="form-horizontal col-md-offset-0 col-md-4" role="form">
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label"><?php echo _("*Nombre:") ?></label>
                    <div class="col-md-10">
                      <input  type="text" class="form-control" id="name" name="name" placeholder="<?php echo _("Nombre") ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2" for="file"><?php echo _("Imagen:") ?></label>
                        <input type="file" id="file" accept=".jpg,.png,.gif" name="uploadedfile" class="col-md-10">
                        
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
                          <input  type="text" class="form-control" id="address" name="address" autocomplete="on" runat="server" placeholder="<?php echo _("Dirección:") ?>">
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
                            <p><?php echo _("Pulse sobre el mapa para localizar manualmente.") ?></p>
                          </div>
                   <div class="col-md-12">
                       <label >
                         <input id="online" type="checkbox" name="online" value="1"> <?php echo "Soy un establecimiento online." ?></input>
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
                      <input type="number" class="form-control" id="phone" name="phone" placeholder="<?php echo _("Teléfono") ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-3 control-label"><?php echo _("Email:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                      <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo _("Email") ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="site" class="col-md-3 control-label"><?php echo _("Página web:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                      <input type="url" class="form-control" id="site" name="site" placeholder="Ej:http://comerciojusto.org/">
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule" class="col-md-3 control-label"><?php echo _("Horario:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                      <input type="text" class="form-control" id="schedule" name="schedule" placeholder="<?php echo _("Horario") ?>">
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
                                if($net->getName()=="CECJ"){
                                    ?>
                                    <div class="col-md-12">
                                        <label >
                                          <input id="<?php echo $net->getIdNetwork() ?>" type="checkbox" name="network[]" value="<?php echo $net->getIdNetwork() ?>"><?php echo "Coordinadora Estatal de Comercio Justo (CECJ)" ?></input>
                                        </label>
                                    </div>
                                    <?php
                                }
                            } 
                            foreach($network AS $net){
                                if($net->getName()!="CECJ"){
                                    ?>
                                  <div class="col-md-6">
                                        <label >
                                          <input id="<?php echo $net->getIdNetwork() ?>" type="checkbox" name="network[]" value="<?php echo $net->getIdNetwork() ?>"><?php echo $net->getName() ?></input>
                                        </label>
                                  </div>                                   
                            <?php
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
                          ?>
                          <div class="col-md-6">
                                <label >
                                  <input id="<?php echo $imp->getIdImportOrganization() ?>" type="checkbox" name="orgimp[]" value="<?php echo $imp->getIdImportOrganization() ?>"><?php echo $imp->getName() ?></input>
                                </label>
                                </div>                                   
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
                                <label class="col-md-2">
                                  <input id="chface" name="chface" onclick="showurlFace()" type="checkbox">Facebook</input>
                                </label>
                                <div class=" col-md-offset-1 col-md-8">
                                 <input id="inputFacebook" type="url" class="form-control" name="inputFacebook" placeholder="<?php echo _("Ej:https://www.facebook.com/CEComercioJusto") ?>">
                                </div>
                                
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="checkbox">
                                <label class="col-md-2">
                                  <input id="chtwitter" name="chtwitter"  onclick="showurlTwitter()" type="checkbox">Twitter</input>
                                </label>
                                <div class=" col-md-offset-1 col-md-8">
                                 <input id="inputTwitter" name="inputTwitter" type="url" class="form-control" placeholder="<?php echo _("Ej:https://twitter.com/CEComercioJusto") ?>">
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
                                  <input id="cash" name ="cash" type="checkbox"><?php echo _("Moneda social") ?></input>
                                </label>
                                </div>
                                <div class="col-md-offset-2 col-md-2">
                                <label>
                                  <input id="card" name="card" type="checkbox"><?php echo _("Tarjeta") ?></input>
                                </label>
                                </div>                                
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="checkbox">
                                <div class="col-md-8">
                                    <label>
                                        <input id="disableaccess" name="disableaccess" type="checkbox"><?php echo _("Acceso para discapacitados") ?></input>
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
                          <option value="0"><?php echo _("-- Seleccione uno --") ?></option>
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
                          <option value="0"><?php echo _("-- Seleccione uno --") ?></option>
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
            </div>
          </div> 
        
        </form>
        <div id="productSection" class="col-md-12">
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
                    
                    <div id="divpanelnewproduct" class="form-horizontal  col-md-12" role="form">
                        <div class="panel panel-default">
                          <div id="headpanelnewproduct" class="panel-heading col-md-13">
                            <h3 class="panel-title"><?php echo _("Nuevo producto") ?></h3>
                          </div>
                          <div id="bodypanelnewproduct" class="panel-body">
                            <div id="alertCamposPr" class="alert alert-danger" style="display: none">
                               <button type="button" class="close" onclick="$('#alertCamposPr').hide()" aria-hidden="true">&times;</button>
                               <strong><?php echo _("Error: ") ?></strong><?php echo _("Debe completar todos los campos.") ?>
                            </div>
                            <div class="form-horizontal col-md-offset-0 col-md-5" role="form">
                                <div class="form-group">
                                    <label for="namedata" class="col-md-3 control-label"><?php echo _("Nombre:") ?></label>
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
                                    <div id="divSelect" class="col-md-offset-1 col-md-11">
                                        <input type="hidden" id="cat" name="cat" />
                                        <input type="hidden" id="num" name="num" />
                                        <select id="cat0" class="paramCateg form-control" onchange="addSubCat(this.id)">
                                            <option value="0"><?php echo _("-- *Categoría --") ?></option>
                                            <?php
                                            $categories = Load::loadCategories(); 
                                            foreach($categories AS $cat){
                                                echo "<option value='".$cat->getIdCategory()."'>"; 
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
                        </div>
                    </div>
                    <div id="titleallproduct">
                        <h3><?php echo _("Todos los productos") ?></h3>
                    </div>
                    <ul id="listProduct" class="list-group">
                        
                    </ul>
                    
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        <div class="col-md-10">
            <small><?php echo _("Los campos marcados con (*) deben rellenarse obligatoriamente.") ?></small>
        </div>
        
     
        <script>
        
            searchGoogle();
            
            var markers = 0;
            var lat = 40.4178271;
            var lng = -3.6995367;
            var map = new GMaps({
                el: document.getElementById("map-canvas"),
                lat: lat,
                lng: lng,
                zoom : 12,
                
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
                            if(markers>0){
                                a.setMap(null);
                            }
                            a = map.addMarker({
                                lat: lat,
                                lng: lng
                            });
                            markers = markers+1; 
                        }
                    });
                    
                },
            });
            var a = map.addMarker({
                lat: 0,
                lng: 0
            });
            a.setMap(null);
            
            
            $("#productSection").hide();
            $("#redSection").hide();
            $('#selectSector').on("change",showhideproducts);
            $("#inputFacebook").hide();
            $("#inputTwitter").hide();
            
                          
        </script>
        
    </body> 

</html>
