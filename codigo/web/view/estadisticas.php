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
    
    if($_REQUEST['exportar']==1){
    	include_once ("../controller/exportar.php");   
    }
    
    
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
        
        		<?php
        		$filtro=$_REQUEST['filtro'];
        		$ano=$_REQUEST['ano'];
        		$grafica=$_REQUEST['grafica'];
        		$datos=array();
        		
			switch($filtro){
				case 1: $titulo="Usuarios dados de alta";
						for($i=1;$i<=12;$i++){
							array_push($datos,sizeOf(Load::loadUserStats($i,$ano)));
						}
								break;
				case 2: $titulo="Establecimiento dados de alta"; 
						for($i=1;$i<=12;$i++){
							array_push($datos,sizeOf(Load::loadEstStats($i,$ano)));
						}
								break;
				case 3: $titulo="Eventos dados de alta"; 
						for($i=1;$i<=12;$i++){
							array_push($datos,sizeOf(Load::loadEventsStats($i,$ano)));
						}
								break;
				case 4: $titulo="Productos dados de alta"; 
						for($i=1;$i<=12;$i++){
							array_push($datos,sizeOf(Load::loadProdStats($i,$ano)));
						}
								break;
				case 5: $titulo="Busquedas de establecimientos";
						for($i=1;$i<=12;$i++){
							$dat=Load::loadBusquedaStats($i,$ano);
							$cont=0;
							foreach($dat as $com){
								if($com->gettipo()==1){
									$cont++;
								}
							}
						array_push($datos,$cont);
						}
								break;
				case 6: $titulo="Busquedas de eventos";
						for($i=1;$i<=12;$i++){
							$dat=Load::loadBusquedaStats($i,$ano);
							$cont=0;
							foreach($dat as $com){
								if($com->gettipo()==2){
									$cont++;
								}
							}
						array_push($datos,$cont);
						} 
								break;
				case 7: $titulo="Busquedas de productos";
						for($i=1;$i<=12;$i++){
							$dat=Load::loadBusquedaStats($i,$ano);
							$cont=0;
							foreach($dat as $com){
								if($com->gettipo()==3){
									$cont++;
								}
							}
						array_push($datos,$cont);
						}
								break;
				case 8: $titulo="Número de comentarios";
						for($i=1;$i<=12;$i++){
							array_push($datos,sizeOf(Load::loadComentStats($i,$ano)));
						}
								break;
				case 9: $titulo="Número de accesos a la aplicación";
						for($i=1;$i<=12;$i++){
							array_push($datos,sizeOf(Load::loadAccesoStats($i,$ano)));
						}
								break;
				default: $titulo="Usuarios dados de alta";
							$ano=2015;
						for($i=1;$i<=12;$i++){
							array_push($datos,sizeOf(Load::loadUserStats($i,$ano)));
						}
			}
			
			$titulo.=" en el año ".$ano;
			
			switch($grafica){
				case 1: $graficatxt="Gráfica circular";
						$type="corechart";
						break;
				case 2: $graficatxt="Gráfico de barras";
						$type="bar";
						break;
				default: $graficatxt="Gráfica circular";
						$type="corechart";
						break;
			}
		?>

        
        
        <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.1', {'packages':['<?php echo $type; ?>']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Mes');
        data.addColumn('number', 'Cantidad');
        
        <?php
        if($grafica==2){
         	echo" var data = google.visualization.arrayToDataTable([ ['Mes', 'Número'],";
        }else{
       		echo"data.addRows([";
        }
        
        $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
        $flag=0;
        echo $cantidad;
        for($i=0;$i<=12;$i++){
        	if($datos[$i]!=""){
        	            if($flag!=0){
        	 				echo ",";
        					}
        		echo("['".$meses[$i]."', ".$datos[$i]."]");
        		$flag++;
        	}
        }
		 ?>
        ]);
       

        // Instantiate and draw our chart, passing in some options.
        <?php
        if($grafica==2){
	        echo("var options = {
	          chart: {
	            title: '".$titulo."',
	            subtitle: 'Correspondiente al año ".$ano."',
	          }
	        };
	        
	        var chart = new google.charts.Bar(document.getElementById('chart_div'));");
        }else{
	        echo("var options = {'title':'".$titulo."', 'subtitle': 'Correspondiente al año ".$ano."' };
	        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));");
        }
        ?>

        chart.draw(data, options);
      }
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
          <p id="textnav2" class="navbar-brand"><?php echo _("Estadísticas") ?></p>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav navbar-right">
          		<li><a data-ajax="false" href="gestion.php"><?php echo _("Inicio") ?></a></li>
				<li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li>
              <!-- <li><a data-ajax="false" href="info.php"><?php echo _("Acerca de") ?></a></li> -->
              <li><a target="_blank" data-ajax="false" href="../images/manualUsuario.pdf"><?php echo _("Ayuda") ?></a></li>     
          </ul>
        </nav>
      </div>
    </header>
        
        
    <body>
    
    <div class="container">
	
       <div class="col-md-8">
       		           
		<h3>Gráfica</h3>
		
	<div class="col-md-12"  style="margin-top:35px;">
		<div id="chart_div" style="width:100%; height:400px;"></div>
	</div>
       </div>
       
    <div class="col-md-4">
		<h3>Filtrado</h3>
		<form method="post" action="estadisticas.php" style="margin-top:35px;">
			<select class="form-control" name="filtro" id="filtro">
				<?php
				if($filtro!=""){
					echo('<option value="'.$filtro.'" selected="selected">'.$titulo.'</option>');
				}
				?>
				<option value="1">Usuarios dados de alta</option>
				<option value="2">Establecimiento dados de alta</option>
				<option value="3">Eventos dados de alta</option>
				<option value="4">Productos dados de alta</option>
				<option value="5">Busquedas de establecimientos</option>
				<option value="6">Busquedas de eventos</option>
				<option value="7">Busquedas de productos</option>
				<option value="8">Número de comentarios</option>
				<option value="9">Número de accesos a la aplicación</option>
			</select>
			
			<div class="row" style="margin-top:10px;">
			<div class="col-md-3">Año: </div>
			<div class="col-md-9">
			<select class="form-control" name="ano" id="ano">
				<?php
				if($_REQUEST['ano']!=""){
					echo('<option value="'.$ano.'" selected="selected">'.$ano.'</option>');
				}
				
				for($i=2014;$i<=date("Y");$i++){
					if($i==date("Y") && $_REQUEST['ano']==""){
						echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
					}else{
						echo('<option value="'.$i.'">'.$i.'</option>');
					}
				}
				
				?>
			</select>
			</div>
			</div>
			
			<div class="row" style="margin-top:10px; margin-bottom:10px;">
			<div class="col-md-3">Tipo de gráfica: </div>
			<div class="col-md-9">
			<select class="form-control" name="grafica" id="grafica">
				<?php
				if($grafica!=""){
					echo('<option value="'.$grafica.'" selected="selected">'.$graficatxt.'</option>');
				}
				?>
				<option value="1">Gráfica circular</option>
				<option value="2">Gráfica en columnas</option>
			</select>
			</div>
			</div>

			<input class="btn btn-default pull-right" name="Submit1" type="submit" value="Actualizar" />
		</form>
	</div>

	<div class="clearfix"></div>
	<div class="col-md-12" style="margin-top:20px;">
		<h3>Resumen estadístico general</h3>
	
	
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Concepto</th>
				<th>Este mes</th>
				<th>Último mes</th>
				<th>Histórico</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>Usuarios dados de alta</td>
				<td>
					<?php 
					$coments = Load::loadUserStats(date("m"),date("Y"));
					echo sizeOf($coments);
					?>
				</td>
				<td>
					<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadUserStats($mes,$ano);
					echo sizeOf($coments);
					?>
				</td>
				<td>
					<?php 
					$coments = Load::loadUserValidNoAdmin();
					echo sizeOf($coments);
					?>
				</td>
			</tr>
			<tr>
				<td>Establecimiento dados de alta</td>
				<td>
				<?php 
					$coments = Load::loadEstStats(date("m"),date("Y"));
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadEstStats($mes,$ano);
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadAllEstablishment();
				echo sizeOf($coments);
				?>
				</td>
			</tr>
			<tr>
				<td>Eventos dados de alta</td>
				<td>
				<?php 
					$coments = Load::loadEventsStats(date("m"),date("Y"));
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadEventsStats($mes,$ano);
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadAllEvents();
				echo sizeOf($coments);
				?>
				</td>
			</tr>
			<tr>
				<td>Productos dados de alta</td>
				<td>
				<?php 
					$coments = Load::loadProdStats(date("m"),date("Y"));
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadProdStats($mes,$ano);
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadProductsStats();
				echo sizeOf($coments);
				?>
				</td>
			</tr>
			<tr data-toggle="collapse" data-target="#establecimientos" class="accordion-toggle">
				<td>Busquedas de establecimientos</td>
				<td>
				<?php 
					$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
					echo $cont;
				?>

				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
					echo $cont;

				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==1){
							$cont++;
						}
					}
					echo $cont;

				?>
				</td>
			</tr>		
					
			<tr>
				<td>Busquedas de eventos</td>
				<td>
				<?php 
					$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
					echo $cont;
				?>

				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
					echo $cont;

				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==2){
							$cont++;
						}
					}
					echo $cont;

				?>
				</td>

			</tr>
			<tr>
				<td>Busquedas de productos</td>
				<td>
				<?php 
					$coments = Load::loadBusquedaStats(date("m"),date("Y"));
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
					echo $cont;
				?>

				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadBusquedaStats($mes,$ano);
					$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
					echo $cont;

				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadBusquedasStats();
				$cont=0;
					foreach($coments as $com){
						if($com->gettipo()==3){
							$cont++;
						}
					}
					echo $cont;

				?>
				</td>

			</tr>
			<tr>
				<td>Número de comentarios</td>
				<td>
				<?php 
					$coments = Load::loadComentStats(date("m"),date("Y"));
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadComentStats($mes,$ano);
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadComentsStats();
				echo sizeOf($coments);
				?>
				</td>
			</tr>
			<tr>
				<td>Número de accesos a la aplicación</td>
				<td>
				<?php 
					$coments = Load::loadAccesoStats(date("m"),date("Y"));
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php
					$datos = Load::obtenerAnoMes(date("m"),date("Y"));
					$mes=$datos[0];
					$ano=$datos[1];
	
					$coments = Load::loadAccesoStats($mes,$ano);
					echo sizeOf($coments);
				?>
				</td>
				<td>
				<?php 
				$coments = Load::loadAccesosStats();
				echo sizeOf($coments);
				?>
				</td>
			</tr>
			</tbody>
		</table>
		
		
	<div class="modal fade" id="exportar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Exportar resumen estadístico</h4>
      </div>
      <form action="#" method="post">
      <div class="modal-body">
        <h3>Seleccionar formato</h3>
        <div class="radio">
		  <label>
		    <input type="radio" name="formato" id="optionsRadios1" value="1" checked>
		    Exportar en formato <strong>Microsoft Excel .XLSX</strong>
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="formato" id="optionsRadios2" value="2">
		    Exportar en formato <strong>Libre/Open Office .ODS</strong>
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="formato" id="optionsRadios2" value="3">
		    Exportar en formato <strong>Adobe Acrobat .PDF</strong>
		  </label>
		</div>
      </div>
      		<input type="hidden" value="1" name="exportar">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Exportar</button>
      </div>
      </form>
    </div>
  </div>
</div>


	<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#exportar">
  			<span class="glyphicon glyphicon-floppy-save"></span> Exportar
	</button>
	<br><br>
	</div>
	</div>
    </body> 

</html>
