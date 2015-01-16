<?php
/**
 * Class Category
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Category{
    	
	/**
     * id of category of database.
     * @var int id 
     * @access private
     */
	private $idCategory;
    
    /**
     * name of category of database.
     * @var string name 
     * @access private
     */
    private $name;
    
    /**
     * reference of category of database.
     * @var int reference
     * @access private
     */
	private $refCategory;

	/**
     * Constructor of Category
     * 
     * @param idCategory the id of category
     * @param name the name of category
     * @param refCategory the reference of the category
     */
	function Category($idCategory,$name, $refCategory) {
	    $this->idCategory = $idCategory;
		$this->name = $name;
		$this->refCategory = $refCategory;
    }
    
    /**
     * Method that return the id of category.
     * 
     * @return idCategory the id
     */
	function getIdCategory(){
        return $this->idCategory;
    }
    
    /**
     * Method that change the id of category.
     * 
     * @param val the new id to change
     */
    function setIdCategory($val){
        $this->idCategory = $val;
    }
    
    /**
     * Method that return the name of category.
     * 
     * @return name the id
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
    
    /**
     * Method that return the reference of category.
     * 
     * @return refCategory the reference
     */
    function getRefCategory(){
        return $this->refCategory;
    }
    
    /**
     * Method that change the ref of category.
     * 
     * @param val the new ref to change
     */
    function setRefCategory($val){
        $this->refCategory = $val;
    }
}
?>