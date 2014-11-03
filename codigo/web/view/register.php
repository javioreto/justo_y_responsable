<?php
include_once ("../init.php");
include_once ("../controller/load.php");

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

$dataBase = new dataBase();
$con = $dataBase->CheckConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());

if(isset($_SESSION["iduser"])){
    $id = $_SESSION["iduser"];
    $user = Load::loadUserById($id);
}
?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> JyR </title>
        
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet"  href="../css/customRegister.css">
        <script src="../js/static/jquery.js"></script>
        <script type="text/javascript" src="../js/loginRegister.js"></script>
        
        <script src="../js/static/bootstrap.min.js"></script>
        
    </head>
    
        <div class="bs-docs-header" id="content">
            <div class="container">
                <div class="col-md-9">
                    <a href="login.php" ><img style="float: left"  src="../../images/logojyr.png" /></a>
                    <a href="login.php"><h1 id="titleheader" ><?php echo _("Justo y Responsable") ?></h1></a>
                </div>
                <?php
                if(isset($_SESSION["iduser"])){
                    ?>
                    <div class="nav navbar-right col-md-2 col-md-offset-1">
                        <p><?php echo _("Bienvenid@: ") ?><?php echo $user->getName() ?></p>
                        <a id="textclose"  href='../controller/closeSession.php'><?php echo _("Cerrar sesión") ?></a>
                    </div>
                    <?php
                }
                ?>
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
              <p id="textnav2" class="navbar-brand"><?php echo _("Formulario de registro - Nuevo usuario") ?></p>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                <?php
                    if (isset($_SESSION["iduser"])){
                    ?>
                          <li><a href="gestionUser.php"><?php echo _("Volver") ?></a></li> 
                          <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                          <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                          <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
                    <?php    
                    }else{
                    ?>
                          <li><a href="login.php"><?php echo _("Login") ?></a></li>
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
        
        <div class="col-md-12">
            <div id="alertCampos" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertCampos').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Existen campos obligatorios (*) vacíos.") ?>
            </div>
            <div id="alertPhone" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertPhone').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("El télefono no es válido.") ?>
            </div>
            <div id="alertEmail" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertEmail').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("El correo electrónico no es válido.") ?>
            </div>
            <div id="alertTerms" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertTerms').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Debe aceptar los términos y condiciones.") ?>
            </div>
            <div id="alertPass" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertPass').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Las contraseñas no coinciden.") ?>
            </div>
            <div id="alertDniExist" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertDniExist').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Ya existe un usuario con ese DNI.") ?>
            </div>
            <div id="alertDni" class="alert alert-warning col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertDni').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("El DNI no es válido") ?>
            </div>
            <div id="alertCaptcha" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertCaptcha').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("No se a introducido correctamente el texto de la imagen.") ?>
            </div>
            <?php
                if (isset($_SESSION["iduser"])){
            ?>
            <div class="form-horizontal col-md-offset-0 col-md-6" role="form">
                <div class="form-group">
                   <label for="name" class="col-md-4  control-label"><?php echo _("*Nombre:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="text" class="form-control" id="name" placeholder="<?php echo _("Nombre") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="surname" class="col-md-4  control-label"><?php echo _("*Apellidos:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="text" class="form-control" id="surname" placeholder="<?php echo _("Apellidos") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="pass" class="col-md-4  control-label"><?php echo _("*Contraseña:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="password" class="form-control" id="pass" placeholder="<?php echo _("Contraseña") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="pass2" class="col-md-4  control-label"><?php echo _("*Confirme contraseña:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="password" class="form-control" id="pass2" placeholder="<?php echo _("Confirme contraseña") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="dni" class="col-md-4  control-label"><?php echo _("*DNI:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="dni" class="form-control" id="dni" placeholder="<?php echo _("DNI") ?>">
                   </div>
                </div>
                
                <div class="form-group">
                    <div class="checkbox">
                        <div class="col-md-offset-5 col-md-4">
                            <label>
                                <b><input id="admincheck" name="admincheck" type="checkbox"><?php echo _("Administrador") ?></input></b>
                            </label>
                        </div>                                
                    </div>
                </div>
                
            </div>
            
            <div class="form-horizontal col-md-offset-0 col-md-6" role="form">
                <div class="form-group">
                   <label for="phone" class="col-md-4  control-label"><?php echo _("Teléfono:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="number" class="form-control" id="phone" placeholder="<?php echo _("Teléfono") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="email" class="col-md-4  control-label"><?php echo _("*Correo electrónico:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="email" class="form-control" id="email" placeholder="<?php echo _("Correo electrónico") ?>">
                   </div>
                </div>
                <div class="form-group">
                    <div id="divpanelasecurity" class="form-horizontal col-md-offset-1 col-md-9" role="form">
                    <div class="panel panel-default">
                      <div id="headpanelsecurity" class="panel-heading col-md-13">
                        <h3 class="panel-title"><?php echo _("Seguridad") ?></h3>
                      </div>
                      <div id="bodypanelsecurity" class="panel-body">
                        <div class="form-horizontal" role="form">
                          <div id="imgcaptcha" class="form-group">
                            <div id="textrefresh" class="col-md-2 col-md-offset-3">
                              <a href="#" onclick="document.getElementById('captcha').src='../images/captcha.php?'+Math.random();"><?php echo _("Recargar") ?></a>
                            </div>
                            <img class="col-md-5 col-md-offset-2"  id="captcha" src="../images/captcha.php" />
                          </div>
                          <div id="textcaptcha" class="form-group">
                            <label for="result" class="col-md-7 control-label"><?php echo _("*Introduzca el texto de la imagen:") ?></label>
                            <div class="col-md-5">
                              <input type="text" class="form-control" id="result" placeholder="<?php echo _("Texto") ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                   </div>
                </div>
                
            </div>
        
        <?php    
            }else{
        ?>
        <div class="form-horizontal col-md-offset-0 col-md-6" role="form">
                <div class="form-group">
                   <label for="name" class="col-md-4  control-label"><?php echo _("*Nombre:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="text" class="form-control" id="name" placeholder="<?php echo _("Nombre") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="surname" class="col-md-4  control-label"><?php echo _("*Apellidos:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="text" class="form-control" id="surname" placeholder="<?php echo _("Apellidos") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="pass" class="col-md-4  control-label"><?php echo _("*Contraseña:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="password" class="form-control" id="pass" placeholder="<?php echo _("Contraseña") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="pass2" class="col-md-4  control-label"><?php echo _("*Confirme contraseña:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="password" class="form-control" id="pass2" placeholder="<?php echo _("Confirme contraseña") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="dni" class="col-md-4  control-label"><?php echo _("*DNI:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="dni" class="form-control" id="dni" placeholder="<?php echo _("DNI") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="phone" class="col-md-4  control-label"><?php echo _("Teléfono:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="number" class="form-control" id="phone" placeholder="<?php echo _("Teléfono") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="email" class="col-md-4  control-label"><?php echo _("*Correo electrónico:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="email" class="form-control" id="email" placeholder="<?php echo _("Correo electrónico") ?>">
                   </div>
                </div>
                
            </div>
            
            <div class="form-horizontal col-md-offset-0 col-md-6" role="form">
                <!--
                <div class="form-group">
                   <label for="email" class="col-md-4  control-label"><?php echo _("*Correo electrónico:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="email" class="form-control" id="email" placeholder="<?php echo _("Correo electrónico") ?>">
                   </div>
                </div>
                -->
                <div class="form-group">
                    <div id="divpanelasecurity" class="form-horizontal col-md-offset-1 col-md-9" role="form">
                    <div class="panel panel-default">
                      <div id="headpanelsecurity" class="panel-heading col-md-13">
                        <h3 class="panel-title"><?php echo _("Seguridad") ?></h3>
                      </div>
                      <div id="bodypanelsecurity" class="panel-body">
                        <div class="form-horizontal" role="form">
                          <div id="imgcaptcha" class="form-group">
                            <div id="textrefresh" class="col-md-2 col-md-offset-3">
                              <a href="#" onclick="document.getElementById('captcha').src='../images/captcha.php?'+Math.random();"><?php echo _("Recargar") ?></a>
                            </div>
                            <img class="col-md-5 col-md-offset-2"  id="captcha" src="../images/captcha.php" />
                          </div>
                          <div id="textcaptcha" class="form-group">
                            <label for="result" class="col-md-7 control-label"><?php echo _("*Introduzca el texto de la imagen:") ?></label>
                            <div class="col-md-5">
                              <input type="text" class="form-control" id="result" placeholder="<?php echo _("Texto") ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                   </div>
                </div>
                <div class="form-group">
                    <div id="divpanelaTerms" class="form-horizontal col-md-offset-1 col-md-9" role="form">
                    <div class="panel panel-default">
                      <div id="headpanelTerms" class="panel-heading col-md-13">
                        <h3 class="panel-title"><?php echo _("Términos y condiciones") ?></h3>
                      </div>
                      <div id="bodypanelTerms" class="panel-body">
                        <div id="scroll">
                        
                            <p> <?php   
                                echo _("La presente 'Ley Orgánica de Protección de Datos' tiene por objeto garantizar
                                y proteger, en lo que concierne al tratamiento de los
                                datos personales, las libertades públicas y los derechos
                                fundamentales de las personas físicas, y especialmente
                                de su honor e intimidad personal y familiar.");
                                ?>
                            </p>
                            <p>
                                <?php
                                echo _("Los datos personales recogidos en el presente formulario
                                únicamente serán utilizados para fines necesarios de la empresa, 
                                pudiendo, por parte del usuario, solicitar la anulación o modificación
                                de los mismos a través de la dirección de correo:  coordinadora@comerciojusto.org");
                                ?> 
                            </p>
                            
                        </div>
                        <div class="checkbox">
                            <div class="col-md-offset-0 col-md-8">
                                <label>
                                    <b><input id="terms" name="terms" type="checkbox"><?php echo _("Acepto los términos y condiciones") ?></input></b>
                                </label>
                            </div>                                
                        </div>
                      </div>
                    </div>
                   </div>
                </div>
                
            </div>
        
        <?php    
            }
        ?>
        </div>
        <div class="col-md-12">
            <div id="leyend" class="form-group">
               <p class=" col-md-offset-1"><?php echo _("Los campos marcados con (*) deben rellenarse obligatoriamente.") ?></p>
            </div>
            <div class="col-md-2 col-md-offset-9">
              <button id="btndarsedealta" type="submit" onclick="checkCamposRegister()" class="btn btn-default"><?php echo _("Registrar") ?></button>
           </div>
        </div>
        
        <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo _("Aviso") ?></h4>
              </div>
              <div class="modal-body">
                <?php echo _("Su registro se ha realizado correctamente pero no podrá acceder a esta aplicación hasta que no sea validado por un administrador") ?>
              </div>
              <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal" onclick="redir()"><?php echo _("Aceptar") ?></button>
              </div>
              
            </div>
          </div>
        </div>
      
    </body>
    
</html>