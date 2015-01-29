<?php

/**
 * Class User
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class User{
    
    /**
     * id of user of database.
     * @var int id 
     * @access private
     */
    private $idUser;
    
    /**
     * name of user of database.
     * @var string name
     * @access private
     */
    private $name;
    
    /**
     * surName of user of database.
     * @var string surname
     * @access private
     */
    private $surName;
    
    /**
     * password of user of database.
     * @var string password
     * @access private
     */
    private $password;
    
    /**
     * dni of user of database.
     * @var string dni
     * @access private
     */
    private $dni;
    
    /**
     * phone of user of database.
     * @var int phone
     * @access private
     */
    private $phone;
    
    /**
     * mail of user of database.
     * @var string mail
     * @access private
     */
    private $email;
    
    /**
     * admin of user of database.
     * @var int admin
     * @access private
     */
    private $admin;
    
    /**
     * valid of user of database.
     * @var int valid
     * @access private
     */
    private $valid;
    
    private $fval;

    /**
     * Constructor
     * 
     * @param idUser the id
     * @param name the name
     * @param surName the surname
     * @param password the password
     * @param dni the dni
     * @param phone the phone
     * @param email the email
     * @param admin the admin
     * @param valid the valid
     */
	function User($idUser, $name, $surName, $password, $dni, $phone, $email, $admin, $valid, $fval){
	    $this->idUser = $idUser;
		$this->name = $name;
        $this->surName = $surName;
        $this->password = $password;
        $this->dni = $dni;
        $this->phone = $phone;
        $this->email = $email;
        $this->admin = $admin;
        $this->valid = $valid;
        $this->fval=$fval;
    }
	
    /**
     * Method that return the id of user.
     * 
     * @return idUser the id
     */
    function getIdUser(){
        return $this->idUser;
    }
    
    /**
     * Method that change the id of user.
     * 
     * @param val the new id to change
     */
    function setIdUser($val){
        $this->idUser = $val;
    }
    
    /**
     * Method that return the name of user.
     * 
     * @return name the name
     */
	function getName(){
		return $this->name;
 	}
	
    /**
     * Method that change the name of user.
     * 
     * @param val the new name to change
     */
	function setName($val){
		$this->name = $val;
 	}
	
    /**
     * Method that return the surname of user.
     * 
     * @return surName the surname
     */
    function getSurName(){
        return $this->surName;
    }
    
    /**
     * Method that change the surname of user.
     * 
     * @param val the new surname to change
     */
    function setSurName($val){
        $this->surName = $val;
    }
    
    /**
     * Method that return the dni of user.
     * 
     * @return dni the dni
     */
    function getDni(){
        return $this->dni;
    }
    
    /**
     * Method that change the dni of user.
     * 
     * @param val the new dni to change
     */
    function setDni($val){
        $this->dni = $val;
    }
    
    /**
     * Method that return the password of user.
     * 
     * @return password the password
     */
    function getPassword(){
        return $this->password;
    }
    
    /**
     * Method that change the password of user.
     * 
     * @param val the new password to change
     */
    function setPassword($val){
        $this->password = $val;
    }        
    
    /**
     * Method that return the email of user.
     * 
     * @return email the email
     */
    function getEmail(){
        return $this->email;
    }
    
    /**
     * Method that change the email of user.
     * 
     * @param val the new email to change
     */
    function setEmail($val){
        $this->email = $val;
    }
    
    /**
     * Method that return the phone of user.
     * 
     * @return phone the phone
     */
    function getPhone(){
        return $this->phone;
    }
    
    /**
     * Method that change the phone of user.
     * 
     * @param val the new phone to change
     */
    function setPhone($val){
        $this->phone = $val;
    }
    
    /**
     * Method that return the admin of user.
     * 
     * @return admin the admin
     */
    function getAdmin(){
        return $this->admin;
    }
    
    /**
     * Method that return the valid of user.
     * 
     * @return valid the valid
     */
    function getValid(){
        return $this->valid;
    }
    
    function getFVal(){
        return $this->fval;
    }
    

    
    /**
     * Method that change the valid of user.
     * 
     * @param val the new valid to change
     */
    function setValid($val){
        $this->valid = $val;
    }
}

?>