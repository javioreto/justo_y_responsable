<?php include'conexion.php'; ?>
<div id="banner_sup_fondo">
<span style="color:#FFFFFF"><img src="img/logo.jpg" alt="Fair Trade | Sistema de administraci&oacute;n" title="Fair Trade | Sistema de administraci&oacute;n"style="float:left;"/></span>
<div id="menu">
<ul>
	<li <?php if($estoy=="inicio"){ echo "class='seleccionado'"; } ?> 
    style="border-left:#FFFFFF thin solid ;"><a href="inicio.php">INICIO</a></li>
    <li <?php if($estoy=="ejemplo"){ echo "class='seleccionado'"; } ?>><a href="ejemplo.php">SECCION EJEMPLO</a></li>
    <li <?php if($estoy=="estadisticas"){ echo "class='seleccionado'"; } ?>><a href="#">ESTADISTICAS</a></li>
	</ul>
</div>
<div id="texto_usuario">Te has identificado como <b><?php echo $_SESSION[nombre]; ?></b> | <a href="index.php?error=2">Cerrar Sesi&oacute;n</a>
</div>
</div>