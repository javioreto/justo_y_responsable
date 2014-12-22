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
        
        <script type="text/javascript" src="../js/newEventFunctions.js"></script>        
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
              <p id="textnav2" class="navbar-brand"><?php echo _("Nuevo evento") ?></p>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                  <?php
                  if($admin==1){
                      ?>
                <li><a onclick='window.history.back()' style="cursor:pointer"><?php echo _("Volver") ?></a></li>
                <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
                <?php
                  }else{
                ?>
                <li><a onclick='window.history.back()' style="cursor:pointer"><?php echo _("Volver") ?></a></li>
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
        
        <form id="addEstablishment" onsubmit="return valida()" action="../controller/addEvent.php" method="POST">
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
            <div class="form-group col-md-offset-9 col-md-2">
                <div style="margin-top: -10px; margin-bottom: 10px;" id="btndarsedealta">
                    <button id="btnalta" class="btn btn-default" type="submit" ><?php echo _("Crear evento")  ?></button>
                </div>
            </div>  
           
            
           
            
        <div class="col-md-12">
            
            <div class="form-horizontal col-md-offset-2 col-md-4" role="form">
                 <div class="form-group">
                    <label for="name" class="col-md-2 control-label"><?php echo _("*Establecimiento:") ?></label>
                    <div class="col-md-10">
						<div>
                         <select id="selectUsers" name="selectUsers" class="form-control">
                          <option value="0"><?php echo _("--  Seleccione uno --") ?></option>
                          <?php
                          if($admin==1){
                            $user = Load::loadAllEstablishment(); 
                            }else{
                            $user = Load::loadEstablishmentByUserId($id); 
                            }
                            foreach($user AS $u){
                            ?> 
                                <option value="<?php echo $u->getIdEstablishment() ?>"><?php echo $u->getName() ?>&nbsp (<?php echo $u->getLocation() ?>)</option>
                            <?php
                            }
                          ?>
                         </select>
                     </div>
                    </div>
                </div>
 		                     
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label"><?php echo _("*Nombre:") ?></label>
                    <div class="col-md-10">
                      <input  type="text" class="form-control" id="name" name="name" placeholder="<?php echo _("Nombre") ?>">
                    </div>
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
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
            
            <div class="form-horizontal col-md-4 " role="form">
                <div class="form-group">
                    <label for="descripcion" class="col-md-3 control-label"><?php echo _("*Descripción:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                    <textarea id="descripcion" name="descripcion" class="form-control" style="height:150px;"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha" class="col-md-3 control-label"><?php echo _("*Fecha:") ?></label>
                    <div class="col-md-offset-1 col-md-8">
                        <input class="form-control" type="date" name="fecha" id="fecha" placeholder="AAAA-MM-DD">
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule" class="col-md-3 control-label"><?php echo _("*Horario:") ?></label>
                    <div class="col-md-offset-1 col-md-3">
                      <label class="control-label">Comienzo: </label><input type="text" class="form-control" id="inicio" name="inicio" placeholder="00:00">
                      <label class="control-label">Fin: </label><input type="text" class="form-control" id="fin" name="fin" placeholder="23:00">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-11">
                        <label><?php echo _("*Tipo") ?></label>
                         <select id="tipo" name="tipo" class="form-control">
                          <option value="0"><?php echo _("-- Seleccione uno --") ?></option>
                          <option value="1"><?php echo _("Charla/conferencia") ?></option>
                          <option value="2"><?php echo _("Videoforum") ?></option>
                          <option value="3"><?php echo _("Presentación de libro") ?></option>
                          <option value="4"><?php echo _("Encuentro con productores") ?></option>
                          <option value="5"><?php echo _("Exposición") ?></option>
                          <option value="6"><?php echo _("Actividad infantil") ?></option>
                          <option value="7"><?php echo _("Degustación de productos") ?></option>
                          <option value="8"><?php echo _("Taller formativo") ?></option>
                          <option value="9"><?php echo _("Manifestación") ?></option>
                         </select>
                     </div>
                </div>
  
                
             </div>
   
           
          </div> 
        
        </form>
                
        <div class="col-md-10 col-md-offset-2">
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
                       
                          
        </script>
        
    </body> 

</html>
