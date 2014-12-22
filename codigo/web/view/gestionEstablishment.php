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
              <p id="textnav2" class="navbar-brand"><?php echo _("Gestión de establecimientos") ?></p>
              <?php
              }else{
              ?>
              <p id="textnav2" class="navbar-brand"><?php echo _("Mis establecimientos") ?></p>
              <?php
              }
              ?>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav navbar-right">
                <?php
                    if($admin==1){
                    ?>
                          <li><a href="newEstablishment.php"><?php echo _("Nuevo") ?></a></li>
                          <li><a href="gestion.php"><?php echo _("Volver") ?></a></li>
                          <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
                          <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>
                          <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li>
                    <?php
                    }else{
                    ?>
                          <li><a href="newEstablishment.php"><?php echo _("Nuevo establecimiento") ?></a></li>
                          <?php
              			if($admin!=1){
              				?>
                          <li><a href="newEvent.php"><?php echo _("Nuevo evento") ?></a></li>
						<?php
              			}
              				?>

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
        
        <?php
        $establishment = "";
        if($admin==0){
            $establishment = Load::loadEstablishmentByIdUser($id);
        }else{
            $establishment = Load::loadAllEstablishment();
        }
        
        if(count($establishment)>0){
        ?>
       
        
                
                <?php
                    
                    foreach($establishment AS $est){
                    ?><div class="col-md-8 col-md-offset-2">
            <ul id="list" class="list-group col-md-12 pagination">
                        <a id="<?php echo $est->getIdEstablishment() ?>" href='informationEstablishment.php?id=<?php echo $est->getIdEstablishment() ?>' class='list-group-item'>
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
        $events = "";
        if($admin==0){
            $events = Load::loadAllEventsByEstablishmentId($est->getIdEstablishment());
        
        if(count($events)>0){       
        ?>
                                     <div class="clearfix"></div>
<h3>Eventos asociados a este establecimiento:</h3>
        <div class="col-md-12">
            <ul id="list" class="list-group col-md-12 pagination">
                
                <?php
                    
                    foreach($events AS $est){
                    ?>
                        <a id="<?php $est->getidEvento() ?>" href='editEvent.php?id=<?php echo $est->getidEvento() ?>' class='list-group-item'>
                                <div id="listestab" class='form-group col-md-12'>
                                    <div id="info" class="col-md-offset-1 col-md-4">
                                        <p id='name'><strong><?php echo $est->getnombre() ?></strong> - <small><?php echo Load::eventType($est->getidTipo()) ?></small></p>
                                        <p><b><?php echo _("Dirección: ") ?></b><?php echo $est->getdireccion() ?> - <?php echo $est->getlocalidad() ?></p>
                                    </div>  
                                    <div class="col-md-offset-1 col-md-4">
                                        <p><b><?php echo _("Fecha: ") ?></b><?php echo $est->getfecha() ?> &nbsp; <b>Horario: </b> de <?php echo $est->getinicio() ?> a <?php echo $est->getfin() ?> </p>
										<p><b><?php echo _("Descripción: ") ?></b><?php echo substr($est->getdescripcion(),0,110)."..." ?></p>
                                    </div> 
                                </div>
                              </a>
                <?php
                  } }
                ?> 
            </ul>
        </div>
        <?php
        } ?>
                              
                              
                    </ul>
        </div>           
                <?php
                    }
                ?> 
           
        <?php
        }else{
        ?>
        <h4 class="col-md-offset-1 col-md-10"><?php echo _("No existen establecimientos almacenados para este usuario. Puede añadirlos pulsando sobre el botón 'Nuevo establecimiento' en la barra de navegación superior.") ?></h4>
        <?php
        }
        ?>
        

    </body> 

</html>
