<?php

class mailingSystem{

	//el mail de envio no-replay@comerciojusto.org
	private $system_mail="info@factoria76.com";
	
	private $admin_mail="javioreto@gmail.com";
	
	
	
	/*
	Send email confirmation when users 
	register a new acount 
	*/
	function newUser($email){
	
	if (is_file("view/mailView.php")){
	    include_once ("view/mailView.php");
	}
	else {
	    include_once ("../view/mailView.php");
	}
	
		/* Send first mail to admin */
	
		$ssubject="[JyR] Nueva cuenta de usuario";
		$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html; charset=UTF-8";
	
		mail($this->admin_mail,$ssubject,$newUserRequestConfirmationToAdmin,$sheader);
		
		/* Send second mail to user */
		
		$ssubject="[JyR] Confirmación nueva cuenta de usuario";
		$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html; charset=UTF-8";
	
		mail($email,$ssubject,$newUserRequestConfirmationToUser,$sheader);
	$newUserAceptConfirmation;
	}
	
	
	/*
	Send email confirmation when admin
	validate user acount
	*/
	function userAcepted($email){
	
	if (is_file("view/mailView.php")){
	    include_once ("view/mailView.php");
	}
	else {
	    include_once ("../view/mailView.php");
	}
	
		/* Send first mail to admin */
	
		$ssubject="[JyR] Cuenta de usuario activada";
		$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html; charset=UTF-8";
	
		mail($email,$ssubject,$newUserAceptConfirmation,$sheader);
	}
	
	
	
	/*
	Send email confirmation when users 
	register a new establishment acount 
	*/
	function newEstablishment($name,$location){
	
	if (is_file("view/mailView.php")){
	    include_once ("view/mailView.php");
	}
	else {
	    include_once ("../view/mailView.php");
	}
	
		/* Notification to admin */
	
		$ssubject="[JyR] Nuevo establecimiento";
		$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html; charset=UTF-8";
	
		mail($this->admin_mail,$ssubject,$newEstablishmentConfirmationToAdmin,$sheader);
	
	}
	
	
	/*
	Send email to restore user password 
	*/
	function restorePass($id,$email){
	
	if (is_file("view/mailView.php")){
	    include_once ("view/mailView.php");
	}
	else {
	    include_once ("../view/mailView.php");
	}
	
		$ssubject="[JyR] Cambiar tu contraseña";
		$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html; charset=UTF-8";
	
		mail($email,$ssubject,$restorePass,$sheader);
	
	}
	
	
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
	
		$ssubject="[JyR] Nuevo comentario en su ".$tipo;
		$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
		$sheader=$sheader."Mime-Version: 1.0\n";
		$sheader=$sheader."Content-Type: text/html; charset=UTF-8";
	
		mail($email,$ssubject,$newComment,$sheader);
	
	}

	
	
	/*
	Get url to make static img-url in emails 
	*/
	function getURL(){
		$url="http://".$_SERVER['HTTP_HOST']."/jyr/web";
		return $url;
	}
}

?>