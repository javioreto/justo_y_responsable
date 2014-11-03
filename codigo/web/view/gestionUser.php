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

$user = Load::loadUserById($id);
?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> JyR </title>
        
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">        
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        
        <link rel="stylesheet"  href="../css/customGestionUser.css">
        <link rel="stylesheet"  href="../css/styles.css">
        <script src="../js/static/jquery.js"></script>
        <script type="text/javascript" src="../js/gestionUserFunctions.js"></script>
        
        
        <script src="../js/static/bootstrap.min.js"></script>
        
        <script src="../js/static/jquery.quick.pagination.min.js"></script>
        
        <script type="text/javascript">
        $(document).ready(function() {
            $("ul.pagination").quickPagination({pageSize:"10"});
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
    
    
        <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
          <div class="container">
            <div class="navbar-header">
              <button id="menunav" class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <p id="textnav2" class="navbar-brand"><?php echo _("Gestión de usuarios") ?></p>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="register.php"><?php echo _("Nuevo") ?></a></li>
                <li><a href="gestion.php"><?php echo _("Volver") ?></a></li>
                <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
              </ul>
            </nav>
          </div>
        </header>
         
        
        
    
    <body>
        <div class="col-md-12">
            <div id="divpanelvalid" class="form-horizontal col-md-offset-2 col-md-8" role="form">
                <div class="panel panel-default">
                    <div id="headpanelvalid" class="panel-heading col-md-13">
                        <h3 class="panel-title"><?php echo _("Validación de nuevos usuarios") ?></h3>
                    </div>
                    <div id="bodypanelvalid" class="panel-body col-md-13">
                    <?php
                    $users = Load::loadUserNoValid();
                    if(count($users)>0){
                    ?>
                    <div class="form-horizontal" role="form">
                        <div class="checkbox">
                          <div class="form-group">
                              <div id="alertValid" class="alert alert-danger" style="display: none">
                                   <button type="button" class="close" onclick="$('#alertValid').hide()" aria-hidden="true">&times;</button>
                                   <strong><?php echo _("Error: ") ?></strong><?php echo _("No ha seleccionado ningun usuario para validar.") ?>
                              </div>
                              <label class="col-md-2 col-md-offset-1">
                                 <input id="alluser" type="checkbox" onclick="allusercheck(this)"><strong><?php echo _("Todos") ?></strong></input>
                              </label>
                              
                          </div>
                          <?php
                          foreach($users AS $u){
                          ?>
                          <div class="form-group">
                              <label class="col-md-6 col-md-offset-1">
                                 <input id="<?php echo $u->getIdUser() ?>" type="checkbox"><?php echo $u->getSurName() ?>, &nbsp <?php echo $u->getName() ?> &nbsp (<?php echo $u->getDni() ?>)</input>
                              </label>
                          </div>
                          <?php
                          }
                          ?>     
                          <div class="col-md-offset-10 col-md-2">
                              <button id="btnval" type="submit" onclick="validUser()" class="btn btn-default"><?php echo _("Validar") ?></button>
                          </div>                          
                      </div>
                    </div>
                    <?php
                    }else{
                    ?>
                        <p> <?php echo _("No existen usuarios pendientes de validar") ?></p>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
            
        
        <div id="titlealluser" class="col-md-offset-2">
            <h3 ><?php echo _("Todos los usuarios") ?></h3>
        </div>
        
        <?php
        $userValid = Load::loadUserValid($id);
        ?>
        <div class="col-md-offset-2 col-md-8">
        <ul id="listUser" class=" list-group col-md-12 pagination">
            <?php
                foreach($userValid AS $uv){
            ?>
                    <a id="<?php echo $uv->getIdUser() ?>" href='informationUser.php?id=<?php echo $uv->getIdUser() ?>' class='list-group-item'>
                        <div class='form-inline'>
                            <?php 
                            if($uv->getAdmin()==0){
                            ?>
                                <span id='name' class="glyphicon glyphicon-user"></span> <?php echo $uv->getSurName() ?>, &nbsp <?php echo $uv->getName() ?> &nbsp (<?php echo $uv->getDni() ?>)
                            <?php
                            }else{
                            ?>
                                <span id='name' class="glyphicon glyphicon-user"></span> <?php echo $uv->getSurName() ?>, &nbsp <?php echo $uv->getName() ?> &nbsp (<?php echo $uv->getDni() ?>) &nbsp <p style="display: inline; color: red">Administrador</p>
                            <?php    
                            }
                            ?>
                        </div>
                    </a>
            <?php
                }
            ?>
          
        </ul>
        </div>
       
    </body> 

</html>
