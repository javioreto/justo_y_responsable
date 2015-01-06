<?php

/**
 * Class Comment
 * 
 * @author Javier López
 * 
 * @version 2.0
 */
class Busqueda{
    	
	private $id;
    
    private $idobjeto;
    
    private $fecha;
    
    private $tipo;
  
	function Busqueda($id,$idobjeto, $fecha, $tipo) {
	    $this->id = $id;
		$this->fecha = $fecha;
		$this->idobjeto = $idobjeto;
		$this->tipo = $tipo;
    }
    
    /**
     * Method that return the id of comment.
     * 
     * @return idComment the id
     */
	function getId(){
        return $this->id;
    }
    
    /**
     * Method that change the id of comment.
     * 
     * @param val the new id to change
     */
    function setId($val){
        $this->id = $val;
    }
    
    /**
     * Method that return the author of comment.
     * 
     * @return author the name of author
     */
    function getFecha(){
        return $this->fecha;
    }
    
    /**
     * Method that change the author of comment.
     * 
     * @param val the new author to change
     */
    function setFecha($val){
        $this->fecha = $val;
    }
    
    /**
     * Method that return the date of comment.
     * 
     * @return date the date
     */
	function getIdobjeto(){
		return $this->idobjeto;
 	}
	
    /**
     * Method that change the date of comment.
     * 
     * @param val the new date to change
     */
	function setIdobjeto($val){
		$this->idobjeto = $val;
	}
	
	
	function gettipo(){
		return $this->tipo;
 	}
	
	function settipo($val){
		$this->tipo = $val;
	}
    
}
?>