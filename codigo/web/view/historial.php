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


    $id =  $_SESSION["iduser"];
    $admin =  $_SESSION["admin"];
    if($id=="" || $admin==0){
        header('Location: ./login.php');
    }
    $user = Load::loadUserById($id); 
    
    
?>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> JyR </title>
        
        <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
        
       <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
        
        <link rel="stylesheet"  href="../css/customGestion.css">

        <script src="../js/static/jquery.js"></script>
        
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
          <p id="textnav2" class="navbar-brand"><?php echo _("Administración") ?></p>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav navbar-right">
          		<li><a data-ajax="false" href="gestion.php"><?php echo _("Inicio") ?></a></li>
				<li><a data-ajax="false" href="gestionUser.php"><?php echo _("Usuarios") ?></a></li>
				<li><a data-ajax="false" href="gestionEstablishment.php"><?php echo _("Establecimientos") ?></a></li>
				<li><a data-ajax="false" href="gestionEventos.php"><?php echo _("Eventos") ?></a></li>
				<li><a data-ajax="false" href="gestionEstablishment.php"><?php echo _("Productos") ?></a></li>
				<li><a data-ajax="false" href="info.php"><?php echo _("Estadísticas") ?></a></li>
              <!-- <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li> -->
              <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>     
          </ul>
        </nav>
      </div>
    </header>
        
        
    <body>
    
    <div class="container">
    <div class="col-md-6">
        <h3>Historial de notificaciones</h3>  
    </div>
    <div class="col-md-2" style="text-align:right;">
    <h4>Filtrar por:</h4>
    </div>
    <div class="col-md-4">
        	
	        	<select class="form-control">
	        	<?php
	        	$cont=0;
	        	$type = Load::notifType(0); 
					foreach($type as $ty){
	        		echo('<option value="'.$cont.'">'.$ty.'</option>');
	        		$cont++;
	        		}
	        	?>
	        	</select>
        	
     </div>
        <div class="col-md-12">
        	
        	<div id="contenedor-objetos" class="contenedor_eventos_hist panel-group" role="tablist" aria-multiselectable="true" style="margin-bottom:0px;">
	        		
			<div class="panel panel-default" style=" border-radius:0px;">
				<div class="panel-heading" role="tab" id="cabecera1"><h4 class="panel-title">
				<a href="#panel1" data-toggle="collapse" aria-expanded="true" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Características</a><span class="glyphicon glyphicon-chevron-right pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse in" id="panel1" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">Texto sobre características del producto.
						<div style="text-align:right">
							<h4>
								<span class="glyphicon glyphicon-ok-sign"></span>
								<span class="glyphicon glyphicon-remove-sign"></span>	
							</h4>
						</div>
					</div>
				</div>
			</div>	
			
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="cabecera2"><h4 class="panel-title">
				<a href="#panel2" data-toggle="collapse" aria-expanded="false" aria-controls="panel2" class="collapsed" data-parent="#contenedor-objetos">Diseño</a></h4></div>
				<div class="panel-collapse collapse" id="panel2" role="tabpanel" aria-labelledby="cabecera2">
					<div class="panel-body">Texto sobre el diseño del producto.
					</div>
				</div>
			</div>
		
		        		
        	</div>
       </div>
        
       </div>
    </body> 

</html>
