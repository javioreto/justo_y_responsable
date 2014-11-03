<?php
/**
 * Class Province
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Province{
    
    /**
     * id of province of database.
     * @var int id 
     * @access private
     */     
    private $idProvince;
    
    /**
     * name of province of database.
     * @var int name 
     * @access private
     */     
    private $name;

    /**
     * Constructor
     * 
     * @param idProvince the id
     * @param name the name
     */
    function Province($idProvince, $name){
        $this->idProvince = $idProvince;
        $this->name = $name;
    }
    
    /**
     * Method that return the id of province.
     * 
     * @return idProvince the id
     */
    function getIdProvince(){
        return $this->idProvince;
    }
    
    /**
     * Method that change the id of province.
     * 
     * @param val the new id to change
     */
    function setIdProvince($val){
        $this->idProvince = $val;
    }
    
    /**
     * Method that return the name of province.
     * 
     * @return name the name
     */
    function getName(){
        return $this->name;
    }
    
    /**
     * Method that change the name of province.
     * 
     * @param val the new name to change
     */
    function setName($val){
        $this->name = $val;
    }
        
}

?>