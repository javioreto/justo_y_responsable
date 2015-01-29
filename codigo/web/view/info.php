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
          
        
        <link rel="stylesheet"  href="../css/customInfo.css">
        
        <script src="../js/static/jquery.js"></script>
        <script type="text/javascript" src="../js/language.js"></script>
        
       
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
          <p id="textnav2" class="navbar-brand"><?php echo _("Acerca de") ?></p>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav navbar-right">
              <li><a data-ajax="false" href="login.php"><?php echo _("Volver") ?></a></li>
              <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
              <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>    
              <li><a data-ajax="false" href="login.php" ><?php echo _("Inicio") ?></a></li> 
          </ul>
        </nav>
      </div>
    </header>
    
        
    <body>
        
       <div id="divinfo" align="center">
                <p style="font-size: 24px;"><b><?php echo _("Justo y Responsable")?></b></p>
                <p style="font-size: 20px;"><?php echo _("Aplicación web para el consumo responsable")?></p>
                <p><b><?php echo _("Autor v2.0:")?></b><?php echo _("&nbspJavier López Martínez")?></p>
                <p><b><?php echo _("email:")?></b><?php echo _("&nbspjlm0051@alu.ubu.es")?></p>
                <p><b><?php echo _("Tutores:")?></b><?php echo _("&nbspÁlvaro Herrero Cosio")?></p>
                <p><b><?php echo _("Autora v1.0:")?></b><?php echo _("&nbspGadea Hidalgo López")?></p>
                <p><b><?php echo _("Colaborador:")?></b><?php echo _("&nbspCoordinadora Estatal de Comercio Justo")?></p>
                <a target="_blank" href="http://www.ubu.es"><img style="margin-right: 40px;" src="../../images/ubu.png" /></a><a target="_blank" href="http://comerciojusto.org/"><img src="../../images/cecj.png" /></a>
                <p><b><?php echo _("Licencia:")?></b><?php echo _("&nbspCreative Commons")?></p>
                <p><b><?php echo _("Fecha de creación:")?></b><?php echo _("&nbspEnero de 2015")?></p>
                <p><?php echo _("Versión 2.0")?></p>
        </div>
        
    </body>
</html>
