<?php
include_once ("../init.php");
if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

if (is_file("controller/search.php")){
    include_once ("controller/search.php");
}
else {
    include_once ("../controller/search.php");
}
$dataBase = new dataBase();
$con = $dataBase->CheckConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
?>

<!DOCTYPE html>
<html>
	<head>
	    
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo _("Justo y Responsable") ?></title>
		
		<link rel="stylesheet" href="../css/themes/default/jyrtheme.min.css" />
		<link rel="stylesheet" href="../css/themes/default/jquery.mobile.icons.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
        
        
		
		<script src="../js/static/jquery.js"></script>
		<script src="../js/static/jquery.mobile-1.4.2.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="../js/static/gmaps.js"></script>
		<script type="text/javascript" src="../js/location.js"></script>		
		
	</head>
	   
    <body>
        <!-- Lista de puntos -->
        <div role="main" class="ui-content ui-content-list">
            <div id="list">
                
                <ul data-role="listview" data-inset="true">
                    
                    <?php
                        echo"<script type='text/javascript'>"; 
                        echo"getCoordLocat();";
                        echo"</script>"; 
                    ?>
                    
                </ul>
           
            </div>
        
    </body>
</html>