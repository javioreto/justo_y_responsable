<?php
include_once ("../init.php");
    $id =  $_SESSION["iduser"];
    $admin =  $_SESSION["admin"];
    $_SESSION["gestionestablishment"] = "si";
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
        <link rel="stylesheet"  href="../css/customGestionEstablishment.css">
        <link rel="stylesheet"  href="../css/styles.css">
        <script src="../js/static/jquery.js"></script>
        <script type="text/javascript" src="../js/indexFunctions.js"></script>
        
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
              <?php
              if($admin==1){
              ?>
              <p id="textnav2" class="navbar-brand"><?php echo _("Gestión de eventos") ?></p>
              <?php
              }else{
              ?>
              <p id="textnav2" class="navbar-brand"><?php echo _("Mis eventos") ?></p>
              <?php
              }
              ?>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                <?php
                    if($admin==1){
                    ?>
                          <li><a href="newEvent.php"><?php echo _("Nuevo") ?></a></li>
                          <li><a href="gestion.php"><?php echo _("Volver") ?></a></li>
                          <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                          <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                          <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
                    <?php
                    }else{
                    ?>
                          <li><a href="newEvent.php"><?php echo _("Nuevo") ?></a></li>
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
    
    <?php if($_REQUEST['st']==1){ ?>

        <div class="col-md-4 col-md-offset-4">
         <div class="alert alert-success alert-dismissible fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     		 <strong>Creación</strong> Se ha creado correctamente el evento. 
    		</div>
        </div>
        <?php } ?>
        
     <?php if($_REQUEST['st']==2){ ?>

        <div class="col-md-4 col-md-offset-4">
         <div class="alert alert-success alert-dismissible fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     		 <strong>Actualización</strong> Se ha actualizado correctamente el evento. 
    		</div>
        </div>
        <?php } ?>


    <?php if($_REQUEST['st']==3){ ?>

        <div class="col-md-4 col-md-offset-4">
         <div class="alert alert-danger alert-dismissible fade in" role="alert">
      		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     		 <strong>Eliminación</strong> Se ha eliminado correctamente el evento. 
    		</div>
        </div>
        <?php } ?>

        
        <div class="clearfix"></div>
        
        <?php
        $events = "";
        if($admin==0){
            $events = Load::loadAllEventsByEstablishmentId($id);
        }else{
            $events = Load::loadAllEvents();
        }
 
        if(count($events)>0){       
        ?>
       
        <div class="col-md-8 col-md-offset-2">
            <ul id="list" class="list-group col-md-12 pagination">
                
                <?php
                    
                    foreach($events AS $est){
                    ?><div class="row">
                        <a id="<?php $est->getidEvento() ?>" href='editEvent.php?id=<?php echo $est->getidEvento() ?>' class='list-group-item'>
                                <div id="listestab" class='form-group col-md-12' style="height:auto">
                                    <div id="info" class="col-md-offset-1 col-md-5">
                                        <h5><strong><?php echo substr($est->getnombre(),0,35) ?></strong></h5><small><?php echo Load::eventType($est->getidTipo()) ?></small><br>
                                        <b><?php echo _("Dirección: ") ?></b><?php echo substr($est->getdireccion(),0,35) ?> - <?php echo $est->getlocalidad() ?>
                                    </div>  
                                    <div class="col-md-offset-0 col-md-5">
                                        <p><b><?php echo _("Fecha: ") ?></b><?php echo $est->getfecha() ?> &nbsp; <b>Horario: </b> de <?php echo $est->getinicio() ?> a <?php echo $est->getfin() ?> </p>
										<p><b><?php echo _("Descripción: ") ?></b><?php echo substr($est->getdescripcion(),0,50)."..." ?></p>
                                    </div> 
                                </div>
                              </a></div>
                <?php
                  }
                ?> 
            </ul>
        </div>
        <?php
        }else{
        ?>
        <h4 class="col-md-offset-1 col-md-10"><?php echo _("No existen eventos almacenados para este usuario. Puede añadirlos pulsando sobre el botón 'Nuevo' en la barra de navegación superior.") ?></h4>
        <?php
        }
        ?>
    </body> 

</html>
