<?php
/**
 * Class Sector
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Sector{
    
    /**
     * id of sector of database.
     * @var int id 
     * @access private
     */
    private $idsector;
    
    /**
     * name of sector of database.
     * @var string name 
     * @access private
     */
    private $name;
    
    /**
     * Constructor
     * 
     * @param idsector the id
     * @param name the name
     */
    function Sector($idsector, $name){
        $this->idsector = $idsector;
        $this->name = $name;
    }
    
    /**
     * Method that return the id of sector.
     * 
     * @return idsector the id
     */
    function getIdSector(){
        return $this->idsector;
    }
    
    /**
     * Method that change the id of sector.
     * 
     * @param val the new id to change
     */
    function setIdSector($val){
        $this->idsector = $val;
    }
    
    /**
     * Method that return the name of sector.
     * 
     * @return name the name
     */
    function getName(){
        return $this->name;
    }
    
    /**
     * Method that change the name of sector.
     * 
     * @param val the new name to change
     */
    function setName($val){
        $this->name = $val;
    }
        
}

?>