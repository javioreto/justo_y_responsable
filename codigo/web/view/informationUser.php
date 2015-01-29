<?php
include_once ("../init.php");
    $id =  $_SESSION["iduser"];
    $admin =  $_SESSION["admin"];
    $_SESSION["gestionestablishment"] = "no";
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
        <link rel="stylesheet"  href="../css/customInformationUser.css">
        <link rel="stylesheet"  href="../css/styles.css">

        <script src="../js/static/jquery.js"></script>
        <script type="text/javascript" src="../js/gestionUserFunctions.js"></script>
       
        <script src="../js/static/bootstrap.min.js"></script>
        
        <script src="../js/static/jquery.quick.pagination.min.js"></script>
        
        <script type="text/javascript">
        $(document).ready(function() {
            $("ul.pagination").quickPagination({pageSize:"5"});
        });
        </script>
        
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
        $idUser = $_GET['id'];
        $_SESSION["selectedUser"] = $idUser;
        $user = Load::loadUserById($idUser);
        $deletefunction = "deleteUser($idUser)";
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
              <p id="textnav2" class="navbar-brand"><?php echo _("Usuario: "); echo $user->getName() ?>  <?php echo $user->getSurName() ?></p>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                <li><a href='editUser.php?id=<?php echo $idUser ?>'><?php echo _("Editar") ?></a></li>
                <li><a data-toggle="modal" data-target=".bs-example-modal-sm"><?php echo _("Borrar") ?></a></li>
                <li><a href="gestionUser.php"><?php echo _("Volver") ?></a></li>
                <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
              </ul>
            </nav>
          </div>
        </header>      
        
    
    <body>
        
        <div class="col-md-12">
            <div class="form-horizontal col-md-offset-1 col-md-10" role="form">
                
                
                <div id="divpanelsocial" class="form-horizontal  col-md-12" role="form">
                    <div class="panel panel-default">
                      <div id="headpaneldata" class="panel-heading col-md-13">
                        <h3 class="panel-title"><?php echo _("Datos personales") ?></h3>
                      </div>
                      <div id="bodypaneldata" class="panel-body">
                        <div class="form-horizontal col-md-5" role="form">
                            <div class="form-group">
                                <label for="name" class="col-md-offset-1 col-md-4"><strong><?php echo _("Nombre:") ?></strong></label>
                                <div class="col-md-7">
                                  <p for="name" ><?php echo $user->getName() ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="surname" class="col-md-offset-1 col-md-4"><strong><?php echo _("Apellidos:") ?></strong></label>
                                <div class="col-md-7">
                                  <p for="surname" ><?php echo $user->getSurName() ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dni" class="col-md-offset-1 col-md-4"><strong><?php echo _("DNI:") ?></strong></label>
                                <div class="col-md-7">
                                  <p for="dni" ><?php echo $user->getDni() ?></p>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-horizontal col-md-offset-1 col-md-5" role="form">
                            
                            <div class="form-group">
                                <label for="phone" class="col-md-offset-1 col-md-6"><strong><?php echo _("Teléfono:") ?></strong></label>
                                <div class="col-md-5">
                                    <?php
                                   if($user->getPhone()!=0){
                                   ?>
                                        <p for="phone"><?php echo $user->getPhone() ?></p>
                                   <?php
                                   }
                                   ?>
                                  
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="col-md-offset-1 col-md-6"><strong><?php echo _("Correo electrónico:") ?></strong></label>
                                <div class="col-md-5">
                                  <p for="email"><?php echo $user->getEmail() ?></p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="col-md-offset-1 col-md-6"><strong><?php echo _("Fecha de validación:") ?></strong></label>
                                <div class="col-md-5">
                                  <p for="email"><?php echo $user->getFVal() ?></p>
                                </div>
                            </div>

                        </div>
                      </div>
                    </div>
                </div>
                
                
            </div>
          </div>
          
          <div id="titleallestablishment" class="col-md-offset-1">
             <h3><?php echo _("Establecimientos asociados:") ?></h3>
          </div>
            
          <?php
            $establishment = Load::loadEstablishmentByIdUser($user->getIdUser());
            if(count($establishment)>0){
                ?>
                <div class="col-md-offset-1 col-md-10">
                <ul id="list" class="list-group col-md-12 pagination">
                <?php
                foreach($establishment AS $est){
                ?>        
                
                
                  <a id="<?php $est->getIdEstablishment() ?>" href='informationEstablishment.php?id=<?php echo $est->getIdEstablishment() ?>' class='list-group-item'>
                    <div id="listestab" class='form-group col-md-12'>
                        <div id="imgdiv" class=" col-md-1">
                        <?php
                        if($est->getLogo() == ""){
                        ?>
                            <img class='img-thumbnail  img-responsive' alt='Responsive image' src='../../images/nofoto.jpg'>
                        <?php
                        }else{
                        ?>
                            <img class='img-thumbnail  img-responsive ' alt='Responsive image' src="<?php echo $est->getLogo() ?>">
                        <?php
                        }
                        ?>
                        </div>
                        <div id="info" class="col-md-offset-1 col-md-10">
                            <p id='name'><strong><?php echo $est->getName() ?></strong></p>
                            <p><b><?php echo _("Dirección: ") ?></b><?php echo $est->getAddress() ?> , <?php echo $est->getPostCode() ?> , <?php echo $est->getLocation() ?></p>
                        </div>   
                    </div>
                  </a>
                <?php
                 }
                ?>
                </ul>
                </div>
            <?php
            }else{
            ?>
            <p class="col-md-offset-1"><?php echo _("No existen establecimientos almacenados para este usuario.") ?></p>
            <?php    
            } 
            ?>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo _("Confirmación") ?></h4>
              </div>
              <div class="modal-body">
                <?php echo _("¿Seguro que quiere eliminar el usuario?") ?>
              </div>
              <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal"><?php echo _("Cancelar") ?></button>
                
                <button type="button"  onclick="<?php echo $deletefunction ?>" class="btn btn-primary"><?php echo _("Aceptar") ?></button>
              </div>
              
            </div>
          </div>
        </div>
        
    </body> 

</html>
