<?php
include_once ("../init.php");
if(isset($_SESSION["iduser"]) && isset($_SESSION["admin"])){
    $id =  $_SESSION["iduser"];
    $admin =  $_SESSION["admin"];
    if($id!="" && $admin==0){
        header('Location: ./gestionEstablishment.php');
    }else{
       if($id!="" && $admin==1){
           header('Location: ./gestion.php');
       } 
    }
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
        <title> JyR </title>
        
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
          
        
        <link rel="stylesheet"  href="../css/customLogin.css">

        <script src="../js/static/jquery.js"></script>
        <script type="text/javascript" src="../js/loginRegister.js"></script>
        <script type="text/javascript" src="../js/language.js"></script>
        
        
      
        
        <script src="../js/static/bootstrap.min.js"></script>
       
        
    </head>
    
    <div class="bs-docs-header" id="content">
        <div class="container">
            <div class="col-md-10">
                <a href="login.php" ><img style="float: left"  src="../../images/logojyr.png" /></a>
                <a href="login.php"><h1 id="titleheader" ><?php echo _("Justo y Responsable") ?></h1></a>
            </div>
            <div class="col-md-2" >
                <?php
                if($_SESSION["lang"]=='es_ES'){
                ?>
                    <img style="float: left; margin-right: 10px; " src="../../images/spainflag.png" />
                <?php   
                }else{
                ?>
                    <img style="float: left; margin-right: 10px;" src="../../images/inglesflag.png" />
                <?php    
                }
                ?>
                <ul id="dropLanguage" class="nav">
                    <li class="dropdown">
                        <a id="linkidiom" href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo _("Idioma") ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a onclick="selectLanguage('spain')">Castellano</a>
                            </li>
                            <li>
                                <a onclick="selectLanguage('english')">English</a>
                            </li>
                        </ul>
                    </li>
                </ul>
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
          <p id="textnav2" class="navbar-brand"></p>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav navbar-right">
              <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
              <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>     
          </ul>
        </nav>
      </div>
    </header>
    
        
    <body>
        
       <div id="divpanelaccess" class="form-horizontal col-md-offset-3 col-md-6" role="form">
        <div class="panel panel-default">
          <div id="headpanelaccess" class="panel-heading col-md-13">
            <h3 class="panel-title"><?php echo _("Acceso") ?></h3>
          </div>
          
          <div id="bodypanelaccess" class="panel-body">
            <div class="form-horizontal" role="form">
              <div class="form-group">
                <div id="alertCampos" class="alert alert-danger" style="display: none">
                   <button type="button" class="close" onclick="$('#alertCampos').hide()" aria-hidden="true">&times;</button>
                   <strong><?php echo _("Error: ") ?></strong><?php echo _("Debe rellenar todos los campos.") ?>
                </div>
                <div id="alertDatos" class="alert alert-danger" style="display: none">
                   <button type="button" class="close" onclick="$('#alertDatos').hide()" aria-hidden="true">&times;</button>
                   <strong><?php echo _("Error: ") ?></strong><?php echo _("Usuario o contraseña incorrecta.") ?>
                </div>
                <div id="alertCorrect" class="alert alert-info" style="display: none">
                   <button type="button" class="close" onclick="$('#alertCorrect').hide()" aria-hidden="true">&times;</button>
                   <strong><?php echo _("Datos correctos-") ?></strong><?php echo _("no puede acceder con esta cuenta hasta que no sea validado por un administrador.") ?>
                </div>
                <div id="alertDni" class="alert alert-warning" style="display: none">
                   <button type="button" class="close" onclick="$('#alertDni').hide()" aria-hidden="true">&times;</button>
                   <strong><?php echo _("Error: ") ?></strong><?php echo _("El dni no es válido") ?>
                </div>
                <label for="dni" class="col-md-3 col-md-offset-1 control-label"><?php echo _("DNI:") ?></label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="dni" placeholder="<?php echo _("DNI") ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="pass" class="col-md-3 col-md-offset-1 control-label"><?php echo _("Contraseña:") ?></label>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="pass" placeholder="<?php echo _("Contraseña") ?>">
                </div>
              </div>
              <div class="form-group form-inline">
                <div id="divent" class="col-md-offset-4 col-md-2">
                  <button id="btnentrar" type="submit" onclick="checkCamposLogin()" class="btn btn-default"><?php echo _("Entrar") ?></button>
                </div>
                <div class="col-md-offset-1 col-md-2">
                  <a id="btnreg" href="register.php" class="btn btn-default"><?php echo _("Registrarse") ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
        
    </body>
</html>
