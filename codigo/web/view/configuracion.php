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
          <p id="textnav2" class="navbar-brand"><?php echo _("Configuración") ?></p>
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
       <?php
       $ty=$_REQUEST['ty'];
       $a=$_REQUEST['a'];
       $id=$_REQUEST['id'];
       $form=$_REQUEST['form'];
       $nombre=$_REQUEST['nombre'];
       $refcategoria=$_REQUEST['refcategoria'];
       $flag=false;
       
       
              if($form){
       	$flag=true;
	    $txt1="alert-success";
		if($a==1){
			if($ty==1){
				Load::insertTipo($nombre);
			}
			if($ty==2){
				Load::insertImportador($nombre);
			}
			if($ty==3){
				Load::insertCat($nombre,$refcategoria);
			}

		$txt2="<strong>Creación</strong> Se ha realizado correctamente.";
		}
		
		if($a==2){
			if($ty==1){
				Load::updateTipo($id,$nombre);
			}
			if($ty==2){
				Load::updateImportador($id,$nombre);
			}
			if($ty==3){
				Load::updateCat($id,$nombre,$refcategoria);
			}

		$txt2="<strong>Modificación</strong> Se ha realizado correctamente.";
		}
       }      
    

       
       
       
       switch($a){
       case 1: 	$txt="Nuevo ";
       			break;
       case 2: 	$txt="Modificar ";
       			break;
       case 3:  $txt="Nuevo ";
       			$flag=true;
	       		$txt1="alert-danger";
	       		$txt2="<strong>Eliminación</strong> Se ha efectuado correctamente.";
	       			if($ty==1){
	       				Load::deleteTipo($id);
       				}
       				if($ty==2){
       					Load::deleteImportador($id);
       				}
       				if($ty==3){
       					Load::deleteCat($id);
       				}

       			$a="";
       			break;
       default: $txt="Nuevo ";
       }
       
       switch($ty){
       case 1: 	$txt.="tipo";
       			if($a!="") {
       			$datos=load::loadType();
	       			foreach($datos as $dat){
		       			if($dat->getIdType()==$id){
		       				$nombre=$dat->getName();
		       			}
	       			}
       			}
       			break;
       case 2: 	$txt.="importador";
       			if($a!="") {
       			$datos=load::loadImportOrganization();
	       			foreach($datos as $dat){
			       			if($dat->getIdImportOrganization()==$id){
			       				$nombre=$dat->getName();
			       			}
		       			}
       			}
       			break;
		case 3: $txt.="categoría o subcategoría";
       			if($a!="") {
       			$datos=load::loadAllCat();
	       			foreach($datos as $dat){
			       			if($dat->getIdCategory()==$id){
				       				$nombre=$dat->getName();
			       				}
		       			}
       			}
       			break;

       default: $txt.="tipo";
       			$nombre="";
       }
          ?>
       
       <?php
       if($flag){
              
      echo('<div class="alert '.$txt1.' alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      '.$txt2.'</div>');
       
        } ?>
        
		<h3><?php echo $txt; ?></h3>
		<form action="configuracion.php" method="get" name="tipo">
		<?php if($ty==3) {?>
		<div class="col-md-2"><h4>*Categoría:</h4></div>
		<div class="col-md-8" style="text-align:right;">
			<select class="form-control" name="refcategoria">
			<?php if($_REQUEST['idref']) {?>
				<option value="<?php echo $_REQUEST['idref']; ?>" selected="selected"><?php echo $_REQUEST['nombreref']; ?></option>
				<?php } ?>
				<option value="NULL">SOY UNA CATEGORÍA</option>
				<?php				
				$tipos=load::loadCategories();
				foreach($tipos as $tip){
					echo('<option value="'.$tip->getIdCategory().'">'.$tip->getName().'</option>
					');
				}
				?>
			</select>
			<small>Seleccione la categoría de la que depende o si soy una categoría.</small>
			<br><br>
		</div>
		<?php } ?>
		<div class="clearfix"></div>
		<div class="col-md-2"><h4>*Nombre:</h4></div>
		<div class="col-md-8" style="text-align:right;">
			<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
			<input type="hidden" name="ty" value="<?php if($ty!=""){echo $ty;}else{ echo "1";} ?>">
			<input type="hidden" name="a" value="<?php if($a!=""){echo $a;}else{ echo "1";} ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="form" value="true">
			<input type="hidden" name="idref" value="<?php echo $_REQUEST['idref']; ?>">
			<input type="hidden" name="nombreref" value="<?php echo $_REQUEST['nombreref']; ?>">
			<input type="submit" class="btn btn-default btn-lg" value="<?php echo $txt; ?>" style="margin-top:15px;">
		</div>

		</form>
		
	<div class="col-md-12" style="margin-top:35px;">
		<small>Los campos marcados con (*) deben rellenarse obligatoriamente.</small>
	</div>
       </div>
       
       <div class="col-md-6">
		<h3>Tipos de establecimientos</h3>
		<div class="cont-tipo">
		<?php
		$tipos=load::loadType();
		foreach($tipos as $ty){
			echo('<div style="margin-left:15px; font-size:20px">			
			<a href="configuracion.php?id='.$ty->getIdType().'&ty=1&a=2" alt="Editar"><span class="glyphicon glyphicon-pencil"></span></a> <a href="configuracion.php?id='.$ty->getIdType().'&ty=1&a=3" onclick="return confirm(\'¿Desea eliminar este tipo de establecimiento?\');" alt="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
			'.$ty->getName().' </div>
			');		
		}
		?>
		</div>
		<a href="configuracion.php?ty=1&a=1" class="btn btn-default btn-lg" style="margin:8px 15px;">Nuevo tipo</a>
		<h3>Importadores</h3>
		<div class="cont-tipo">
		<?php
		$tipos=load::loadImportOrganization();
		foreach($tipos as $ty){
			echo('<div style="margin-left:15px; font-size:20px"><a href="configuracion.php?id='.$ty->getIdImportOrganization().'&ty=2&a=2" alt="Editar"><span class="glyphicon glyphicon-pencil"></span></a> <a href="configuracion.php?id='.$ty->getIdImportOrganization().'&ty=2&a=3" onclick="return confirm(\'¿Desea eliminar este importador?\');" alt="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
			'.$ty->getName().' </div>
			');		
		}
		?>
		</div>
		<a href="configuracion.php?ty=2&a=1" class="btn btn-default btn-lg" style="margin:8px 15px;">Nuevo importador</a>

		<h3><strong>Categorías</strong> y subcategorías de productos</h3>
		<div class="cont-tipo">
		<?php
		$tipos=load::loadCategories();
		foreach($tipos as $ty){
			echo('<div style="margin-left:15px; font-size:20px; font-weight:bold;"><a href="configuracion.php?id='.$ty->getIdCategory().'&ty=3&a=2" alt="Editar"><span class="glyphicon glyphicon-pencil"></span></a> <a href="configuracion.php?id='.$ty->getIdCategory().'&ty=3&a=3" onclick="return confirm(\'¿Desea eliminar este importador?\');" alt="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
			'.$ty->getName().' </div>
			');		
			
			$subtipos=load::loadSubCategories($ty->getIdCategory());
			foreach($subtipos as $tyy){
				echo('<div style="margin-left:40px; font-size:20px"><a href="configuracion.php?id='.$tyy->getIdCategory().'&ty=3&a=2&idref='.$ty->getIdCategory().'&nombreref='.$ty->getName().'" alt="Editar"><span class="glyphicon glyphicon-pencil"></span></a> <a href="configuracion.php?id='.$tyy->getIdCategory().'&ty=3&a=3" onclick="return confirm(\'¿Desea eliminar este importador?\');" alt="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
				'.$tyy->getName().' </div>
				');		
			}
			
		}
		?>

		</div>
		
		<a href="configuracion.php?ty=3&a=1" class="btn btn-default btn-lg" style="margin:8px 15px;">Nueva categoría/subcategoría</a>
       </div>
    </div>
    </body> 

</html>
