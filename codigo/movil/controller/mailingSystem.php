<?php

class mailingSystem{

	//el mail de envio no-replay@comerciojusto.org
	private $system_mail="info@factoria76.com";
	
	private $admin_mail="javioreto@gmail.com";
	
	/*
	Send email to user when create a new acount
	*/
	function newComment($nombre,$tipo,$email){
	
	if (is_file("view/mailView.php")){
	    include_once ("view/mailView.php");
	}
	else {
	    include_once ("../view/mailView.php");
	}
	
		$ssubject="Nuevo comentario en su ".$tipo;
		$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html";
	
		mail($email,$ssubject,$newComment,$sheader);
	
	}

	
	
	/*
	Get url to make static img-url in emails 
	*/
	function getURL(){
		$url="http://".$_SERVER['HTTP_HOST']."/jyr/movil";
		return $url;
	}
}

?>