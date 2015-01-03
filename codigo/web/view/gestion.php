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
        
        <script src="../js/eventos.js"></script>

        
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
				<li><a data-ajax="false" href="gestionUser.php"><?php echo _("Usuarios") ?></a></li>
				<li><a data-ajax="false" href="gestionEstablishment.php"><?php echo _("Establecimientos") ?></a></li>
				<li><a data-ajax="false" href="gestionEventos.php"><?php echo _("Eventos") ?></a></li>
				<li><a data-ajax="false" href="gestionEstablishment.php"><?php echo _("Productos") ?></a></li>
				<li><a data-ajax="false" href="estadisticas.php"><?php echo _("Estadísticas") ?></a></li>
				<li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
              <!-- <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li> -->
              <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>     
          </ul>
        </nav>
      </div>
    </header>
        
        
    <body>
        <div class="container">
        <div class="col-md-4">
            <div align="center" style="margin-bottom:0px;">
                <a id="btngestionuser" type="button" href="gestionUser.php" class="btn btn-default btn-lg btn_ancho">
                  <span class="glyphicon glyphicon-user pull-left"></span> <?php echo _("Gestión de usuarios") ?>
                </a>    
            </div>
            <div align="center" style="margin-top:10px;">
                <a id="btngestionestablishment" type="button" href="gestionEstablishment.php" class="btn btn-default btn-lg btn_ancho">
                  <span class="glyphicon glyphicon-home pull-left"></span> <?php echo _("Gestión de establecimientos") ?>
                </a>
            </div>
            <div align="center" style="margin-top:10px;">
                <a id="btngestionestablishment"  type="button" href="gestionEventos.php" class="btn btn-default btn-lg btn_ancho">
                  <span class="glyphicon glyphicon-bullhorn pull-left"></span> <?php echo _("Gestión de eventos") ?>
                </a>
            </div>
            <div align="center" style="margin-top:10px;">
                <a id="btngestionestablishment"  type="button" href="configuracion.php" class="btn btn-default btn-lg btn_ancho">
                  <span class="glyphicon glyphicon-cog pull-left"></span> <?php echo _("Configuración") ?>
                </a>
            </div>

        </div>
        <div class="col-md-8">
        	<h3>Centro de notificaciones</h3>
        	
      <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alertOk">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      Notificación supervisada.
      </div>
      
     	<div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="alertOk">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      Notificación descartada.
      </div>

        	<div id="contenedor-objetos" class="contenedor_eventos panel-group" role="tablist" aria-multiselectable="true" style="margin-bottom:0px;">
	        		<?php
	        		// COMENTARIOS
	        		
	        		$comment = Load::loadCommentNew(); 
	        		$cont=0;
	        		
	        		if(sizeof($comment)>0){
					foreach($comment as $co){
					
						if($co->getrefidestablecimiento()==0){
							$donde="evento";
						}else{
							$donde="establecimiento";
						}
					
			echo('<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo comentario en '.$donde.'</a><span class="glyphicon glyphicon-chevron-right pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.$co->getDescription().'
						<div style="text-align:right">
							<h4>
								<span class="glyphicon glyphicon-ok-sign ok" onclick="eventOk('.$co->getIdComment().', 5, \'#panelex'.$cont.'\');" title="Aceptar"></span>
								<span class="glyphicon glyphicon-remove-sign cancel" onclick="eventCancel('.$co->getIdComment().', 5, \'#panelex'.$cont.'\');" title="Eliminar"></span>	
							</h4>
						</div>
					</div>
				</div>
			</div>');	
			$cont++;
					}}
					
					
			$comment = Load::loadEventsNew(); 
		
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			echo('<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo evento en '.$co->getlocalidad().'</a><span class="glyphicon glyphicon-chevron-right pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.substr($co->getdescripcion(),0,250).'...<br> <a href="informationEstablishment.php?id='.$co->getidEvento().'">Click aquí para ver descripción completa.</a>
						<div style="text-align:right">
							<h4>
								<span class="glyphicon glyphicon-ok-sign ok" onclick="eventOk('.$co->getidEvento().', 4, \'#panelex'.$cont.'\');" title="Aceptar"></span>
							</h4>
						</div>
					</div>
				</div>
			</div>');	
			$cont++;
					}}
					
					
			$comment = Load::loadUserNew(); 
			
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			echo('<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo usuario</a><span class="glyphicon glyphicon-chevron-right pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.$co->getSurName().', '.$co->getName().'<br> <a href="informationUser.php?id='.$co->getIdUser().'">Click aquí para ver perfil completo.</a>
						<div style="text-align:right">
							<h4>
								<span class="glyphicon glyphicon-ok-sign ok" onclick="eventOk('.$co->getIdUser().', 1, \'#panelex'.$cont.'\');" title="Aceptar"></span>
							</h4>
						</div>
					</div>
				</div>
			</div>');	
			$cont++;
					}}

					
			
			$comment = Load::loadEstNew(); 
		
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			echo('<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo establecimiento en '.$co->getLocation().'</a><span class="glyphicon glyphicon-chevron-right pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.$co->getName().'<br> <a href="informationEstablishment.php?id='.$co->getIdEstablishment().'">Click aquí para ver descripción completa.</a>
						<div style="text-align:right">
							<h4>
								<span class="glyphicon glyphicon-ok-sign ok" onclick="eventOk('.$co->getIdEstablishment().', 2, \'#panelex'.$cont.'\');" title="Aceptar"></span>
							</h4>
						</div>
					</div>
				</div>
			</div>');	
			$cont++;
					}}

				
			$comment = Load::loadProdNew(); 
		
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			echo('<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo producto</a><span class="glyphicon glyphicon-chevron-right pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body"><strong>'.$co->getName().'</strong> '.substr($co->getDescription(),0,110).'
						<div style="text-align:right">
							<h4>
								<span class="glyphicon glyphicon-ok-sign ok" onclick="eventOk('.$co->getIdProduct().', 3, \'#panelex'.$cont.'\');" title="Aceptar"></span>
							</h4>
						</div>
					</div>
				</div>
			</div>');	
			$cont++;
					}}
				
			?>
		
		        		
        	</div>
        		<div class="contenedor_eventos_footer">
        		<a href="historial.php">Ver historial de notificaciones</a>
        		</div>
        </div>
        
       </div>
    </body> 

</html>
