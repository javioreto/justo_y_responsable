<?php
include_once ("../init.php");
if(isset($_SESSION["iduser"]) && isset($_SESSION["admin"])){
    $id =  $_SESSION["iduser"];
    $admin =  $_SESSION["admin"];
    if($id!="" && $admin==0){
        header('Location: ./gestionEstablishment.php');
    }else{
       if($id!="" && $admin==1){
           header('Location: ./login.php');
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
$con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());

/* Security check to confirm that is the same id and email */
	$dni=$_REQUEST['id'];
	$tk=$_REQUEST['tk'];
	$security=false;
	
    $user = $dataBase->getUserByDni($dni,$con);

     if($user!=""){
            if(md5($user->getEmail())!=$tk){
            	//exit
            	header('Location: ./login.php');
			}else{
				$security=true;
			}  
    }else{
    	//exit
     	header('Location: ./login.php');
    }

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
        <script type="text/javascript" src="../js/restore.js"></script>        
        <script type="text/javascript" src="../js/language.js"></script>
        
        
      
        
        <script src="../js/static/bootstrap.min.js"></script>
       
        
    </head>
    
    <div class="bs-docs-header" id="content">
        <div class="container">
            <div class="col-md-10">
                <a href="restore.php" ><img style="float: left"  src="../../images/logojyr.png" /></a>
                <a href="restore.php"><h1 id="titleheader" ><?php echo _("Justo y Responsable") ?></h1></a>
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
            <h3 class="panel-title"><?php echo _("Crear nueva contraseña") ?></h3>
          </div>
          
          <div id="bodypanelaccess" class="panel-body">
            <div class="form-horizontal" role="form">
              <div class="form-group">
              <div class="col-md-10 col-md-offset-1">
                <div id="alertCampos" class="alert alert-danger" style="display: none">
                   <button type="button" class="close" onclick="$('#alertCampos').hide()" aria-hidden="true">&times;</button>
                   <strong><?php echo _("Error: ") ?></strong><?php echo _("No puede dejar en blanco ningún campo.") ?>
                </div>
                  <div id="alertIguales" class="alert alert-danger" style="display: none">
                   <button type="button" class="close" onclick="$('#alertIguales').hide()" aria-hidden="true">&times;</button>
                   <strong><?php echo _("Error: ") ?></strong><?php echo _("Compruebe que ha introducido correctamente la segunda contraseña.") ?>
                </div>
                <div id="alertOk" class="alert alert-success" style="display: none">
                   <button type="button" class="close" onclick="$('#alertOk').hide()" aria-hidden="true">&times;</button>
                   <strong><?php echo _("Correcto: ") ?></strong><?php echo _("Su contraseña se ha actualizado correctamente.") ?>
                </div>
                </div>
                
                <div class="col-md-8 col-md-offset-2 text-center">
                   <?php echo _("Introduzca su nueva contraseña de acceso, se solicita por duplicado para evitar errores. ") ?>
                </div>
                
             </div>
             <div class="form-group">
                <label for="pass" class="col-md-3 col-md-offset-1 control-label"><?php echo _("Nueva contraseña:") ?></label>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="pass" placeholder="<?php echo _("Contraseña") ?>">
                </div>
             </div>
              <div class="form-group">
              	<label for="pass1" class="col-md-3 col-md-offset-1 control-label"><?php echo _("Repita la contraseña:") ?></label>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="pass1" placeholder="<?php echo _("Contraseña") ?>">
                  <?php
                  if($security){
                  echo('<input  type="text" id="dni" class="hidden" value="'.$dni.'">');
                  }
                  ?>
                </div>
              </div>
              <div class="form-group form-inline">
                <div id="divent" class="col-md-offset-4 col-md-2">
                  <button id="btnentrar" type="submit" onclick="checkCamposRestore()" class="btn btn-default"><?php echo _("Crear nueva contraseña") ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
        
    </body>
</html>
