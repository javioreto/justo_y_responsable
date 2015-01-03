        		<?php
        		include_once ("../init.php");
include_once ("../controller/load.php");

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

        		
        		
        		
	        		// COMENTARIOS
	        if($_REQUEST['filtro']==5){		
	        		$comment = Load::loadCommentNew(); 
	        		$cont=0;
	        		
	        		if(sizeof($comment)>0){
					foreach($comment as $co){
					
						if($co->getrefidestablecimiento()==0){
							$donde="evento";
						}else{
							$donde="establecimiento";
						}
					
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
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
			</div>';	
			$cont++;
					}}
					
			$comment = Load::loadCommentMes(); 
	        		
	        		if(sizeof($comment)>0){
					foreach($comment as $co){
					
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo comentario en '.$donde.'</a><span class="glyphicon glyphicon-ok-sign pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.$co->getDescription().'
					</div>
				</div>
			</div>';	
			$cont++;
					}}

					}
				if($_REQUEST['filtro']==4){		
			$comment = Load::loadEventsNew(); 
		
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
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
			</div>';	
			$cont++;
					}}
					
						$comment = Load::loadEventsMes(); 
			
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1" style=" background-color:#FFFFFF"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo evento en '.$co->getlocalidad().'</a><span class="glyphicon glyphicon-ok-sign pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.substr($co->getdescripcion(),0,250).'...<br> <a href="informationEstablishment.php?id='.$co->getidEvento().'">Click aquí para ver descripción completa.</a>
					</div>
				</div>
			</div>';	
			$cont++;
					}}

					
					}
				if($_REQUEST['filtro']==1){	
			$comment = Load::loadUserNew(); 
			
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
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
			</div>';	
			$cont++;
					}}
					
			$comment = Load::loadUserMes(); 
			
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1" style=" background-color:#FFFFFF"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo usuario</a><span class="glyphicon glyphicon-ok-sign pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.$co->getSurName().', '.$co->getName().'<br> <a href="informationUser.php?id='.$co->getIdUser().'">Click aquí para ver perfil completo.</a>
					</div>
				</div>
			</div>';	
			$cont++;
					}}

					
			}
				if($_REQUEST['filtro']==2){	
			$comment = Load::loadEstNew(); 
		
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
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
			</div>';	
			$cont++;
					}}
					
					$comment = Load::loadEstMes(); 
		
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1" style=" background-color:#FFFFFF"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo establecimiento en '.$co->getLocation().'</a><span class="glyphicon glyphicon-ok-sign pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body">'.$co->getName().'<br> <a href="informationEstablishment.php?id='.$co->getIdEstablishment().'">Click aquí para ver descripción completa.</a>
					</div>
				</div>
			</div>';	
			$cont++;
					}}


				}
				if($_REQUEST['filtro']==3){	
			$comment = Load::loadProdNew(); 
		
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
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
			</div>';	
			$cont++;
					}}
	
						$comment = Load::loadProdMes(); 
			if(sizeof($comment)>0){
			foreach($comment as $co){
								
			$html .='<div class="panel panel-default" style=" border-radius:0px;" id="panelex'.$cont.'">
				<div class="panel-heading" role="tab" id="cabecera1" style=" background-color:#FFFFFF"><h4 class="panel-title">
				<a href="#panel'.$cont.'" data-toggle="collapse" aria-expanded="false" aria-controls="panel1" class="collapsed" data-parent="#contenedor-objetos">Nuevo producto</a><span class="glyphicon glyphicon-ok-sign pull-right"></span></h4>				
				</div>
				<div class="panel-collapse collapse" id="panel'.$cont.'" role="tabpanel" aria-labelledby="cabecera1">
					<div class="panel-body"><strong>'.$co->getName().'</strong> '.substr($co->getDescription(),0,110).'
					</div>
				</div>
			</div>';	
			$cont++;
					}}

					}
					
	$html = substr( $html, 0, strlen($html));
    //reply with information
    $response = array("categ"=>$html);
    echo json_encode($response);

				
			?>
