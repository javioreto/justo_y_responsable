<?php
include_once ("../init.php");
    $id =  $_SESSION["iduser"];
    $admin =  $_SESSION["admin"];
    if($id=="" || $admin==0){
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


$idUser = $_GET['id'];
$user = Load::loadUserById($idUser);
?>


<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> JyR </title>
        
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet"  href="../css/customEditUser.css">
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
                <li><a data-ajax="false" href="informationUser.php?id=<?php echo $idUser ?>" ><?php echo _("Volver") ?></a></li>
                <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
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
            <div id="alertConfirmPass" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertConfirmPass').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Debe confirmar la nueva contraseña.") ?>
            </div>
            <div id="alertPhone" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertPhone').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("El télefono no es válido.") ?>
            </div>
            <div id="alertEmail" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertEmail').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("El correo electrónico no es válido.") ?>
            </div>
            <div id="alertPass" class="alert alert-danger col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertPass').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("Las contraseñas no coinciden.") ?>
            </div>
            <div id="alertDni" class="alert alert-warning col-md-10 col-md-offset-1" style="display: none">
               <button type="button" class="close" onclick="$('#alertDni').hide()" aria-hidden="true">&times;</button>
               <strong><?php echo _("Error: ") ?></strong><?php echo _("El Dni no es válido") ?>
            </div>
            <div class="form-horizontal col-md-offset-0 col-md-6" role="form">
               
                <div class="form-group">
                   <label for="name" class="col-md-4  control-label"><?php echo _("*Nombre:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="text" class="form-control" id="name" value="<?php echo $user->getName() ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="surname" class="col-md-4  control-label"><?php echo _("*Apellidos:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="text" class="form-control" id="surname" value="<?php echo $user->getSurName() ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="pass" class="col-md-4  control-label"><?php echo _("Nueva Contraseña:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="hidden" class="form-control" id="oldpass" value="<?php echo $user->getPassword() ?>">
                      <input type="password" class="form-control" id="pass" placeholder="<?php echo _("Nueva contraseña") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="pass2" class="col-md-4  control-label"><?php echo _("Confirme contraseña:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="password" class="form-control" id="pass2" placeholder="<?php echo _("Confirme contraseña") ?>">
                   </div>
                </div>
                <div class="form-group">
                   <label for="dni" class="col-md-4  control-label"><?php echo _("*DNI:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="dni" class="form-control" id="dni" value="<?php echo $user->getDni() ?>">
                   </div>
                </div>
                
                
            </div>
            
            <div class="form-horizontal col-md-offset-0 col-md-6" role="form">
                <div class="form-group">
                   <label for="phone" class="col-md-4  control-label"><?php echo _("Teléfono:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                       <?php
                       if($user->getPhone()==0){
                       ?>
                            <input type="number" class="form-control" id="phone" value="">
                       <?php
                       }else{
                       ?>
                            <input type="number" class="form-control" id="phone" value="<?php echo $user->getPhone() ?>">
                       <?php
                       }
                       ?>
                   </div>
                </div>
                <div class="form-group">
                   <label for="email" class="col-md-4  control-label"><?php echo _("*Correo electónico:") ?></label>
                   <div class="col-md-5 col-md-offset-1">
                      <input type="email" class="form-control" id="email" value="<?php echo $user->getEmail() ?>">
                   </div>
                </div>
                
                
            </div>
            
            <div style="margin-top: 30px;" class="col-md-12">
                <div id="leyend" class="form-group">
                   <p class=" col-md-offset-1"><?php echo _("Los campos marcados con (*) deben rellenarse obligatoriamente.") ?></p>
                </div>
                <div id="divbtnregister" class="form-group">
                   <div class="col-md-2 col-md-offset-9">
                       <?php
                       $iduseredit = $user->getIdUser();
                       $function = "checkCamposEdit(".$iduseredit.")";
                       
                       ?>
                      <button id="btndarsedealta" type="submit" onclick="<?php echo $function ?>" class="btn btn-default"><?php echo _("Guardar") ?></button>
                   </div>
                </div>
            </div>
        </div>

    </body>
    
</html>