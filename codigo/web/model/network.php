<?php

/**
 * Class Network
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Network{
    
    /**
     * id of network of database.
     * @var int id 
     * @access private
     */
    private $idnetwork;
    
    /**
     * name of network of database.
     * @var string name 
     * @access private
     */
    private $name;

    /**
     * Constructor
     * 
     * @param idnetwork the id
     * @param name the name
     */
    function Network($idnetwork, $name){
        $this->idnetwork = $idnetwork;
        $this->name = $name;
    }
    
    /**
     * Method that return the id of network.
     * 
     * @return idnetwork the id
     */
    function getIdNetwork(){
        return $this->idnetwork;
    }
    
    /**
     * Method that change the id of network.
     * 
     * @param val the new id to change
     */
    function setIdNetwork($val){
        $this->idnetwork = $val;
    }
    
    /**
     * Method that return the name of network.
     * 
     * @return name the name
     */
    function getName(){
        return $this->name;
    }
    
    /**
     * Method that change the name of category.
     * 
     * @param val the new name to change
     */
    function setName($val){
        $this->name = $val;
    }
        
}

?>