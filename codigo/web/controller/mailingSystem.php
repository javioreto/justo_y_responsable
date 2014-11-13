<?php

class mailingSystem{


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

	$ssubject="Nueva cuenta de usuario";
	$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
	$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
	$sheader=$sheader."Mime-Version: 1.0\n";
	$sheader=$sheader."Content-Type: text/html";

	mail($this->admin_mail,$ssubject,$newUserRequestConfirmationToAdmin,$sheader);
	
	/* Send second mail to user */
	
	$ssubject="Confirmación nueva cuenta de usuario";
	$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
	$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
	$sheader=$sheader."Mime-Version: 1.0\n";
	$sheader=$sheader."Content-Type: text/html";

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

	$ssubject="Cuenta de usuario activada";
	$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
	$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
	$sheader=$sheader."Mime-Version: 1.0\n";
	$sheader=$sheader."Content-Type: text/html";

	mail($email,$ssubject,$newUserAceptConfirmation,$sheader);
}



/*
Send email confirmation when users 
register a new establishment acount 
*/
function newEstablishment($name){

if (is_file("view/mailView.php")){
    include_once ("view/mailView.php");
}
else {
    include_once ("../view/mailView.php");
}

	/* Notification to admin */

	$ssubject="Nuevo establecimiento";
	$sheader="From: Justo y Responsable <".$this->system_mail.">\nReply-To:".$this->system_mail."\n";
	$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
	$sheader=$sheader."Mime-Version: 1.0\n";
	$sheader=$sheader."Content-Type: text/html";

	mail($this->admin_mail,$ssubject,$newEstablishmentConfirmationToAdmin,$sheader);

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