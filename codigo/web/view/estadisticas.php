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
        
        <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Enero', 3],
          ['Febrero', 1],
          ['Marzo', 1],
          ['Abril', 1],
          ['Mayo', 2],
          ['Junio', 1],
          ['Julio', 1],
          ['Agosto', 1],
          ['Septiembre', 2],
          ['Octubre', 1],
          ['Noviembre', 1],
          ['Diciembre', 1]
        ]);

        // Set chart options
        var options = {'title':'Nuevos establecimientos'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
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
				<option value="1">Nuevos establecimientos</option>
			</select>
			<div class="col-md-3">Desde: </div>
			<div class="col-md-9"><input name="desde" id="desde" type="date" class="form-control"></div>
			<div class="col-md-3">Hasta: </div>
			<div class="col-md-9"><input name="hasta" id="hasta" type="date" class="form-control"></div>


			<a href="#" class="btn btn-default pull-right">Actualizar</a>
		</form>
	</div>

	<div class="clearfix"></div>
	<div class="col-md-12">
		<h3>Resumen estadístico</h3>
	
	
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Concepto</th>
				<th><span class="glyphicon glyphicon-chevron-up"></span> Este mes</th>
				<th><span class="glyphicon glyphicon-chevron-up"></span> Último mes</th>
				<th><span class="glyphicon glyphicon-chevron-up"></span> Histórico</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>Usuarios dados de alta</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			</tbody>
		</table>
	
	<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span> Exportar</a>
	</div>
	</div>
    </body> 

</html>
