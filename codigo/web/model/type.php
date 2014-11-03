<?php

/**
 * Class Type
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Type{
    
    /**
     * id of type of database.
     * @var int id 
     * @access private
     */
    private $idtype;
    
    /**
     * name of type of database.
     * @var string name
     * @access private
     */
    private $name;

    /**
     * Constructor
     * 
     * @param idtype the id
     * @param name the name
     */
    function Type($idtype, $name){
        $this->idtype = $idtype;
        $this->name = $name;
    }
    
    /**
     * Method that return the id of type.
     * 
     * @return idtype the id
     */
    function getIdType(){
        return $this->idtype;
    }
    
    /**
     * Method that change the id of type.
     * 
     * @param val the new id to change
     */
    function setIdType($val){
        $this->idtype = $val;
    }
    
    /**
     * Method that return the name of type.
     * 
     * @return idtype the name
     */
    function getName(){
        return $this->name;
    }
    
    /**
     * Method that change the name of type.
     * 
     * @param val the new name to change
     */
    function setName($val){
        $this->name = $val;
    }
        
}

?>