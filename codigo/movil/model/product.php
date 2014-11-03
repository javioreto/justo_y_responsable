<?php
/**
 * Class Product
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Product{
    
    /**
     * id of product of database.
     * @var int id 
     * @access private
     */
    private $idProduct;
    
    /**
     * date of product of database.
     * @var date date 
     * @access private
     */
    private $date;
    
    /**
     * name of product of database.
     * @var string name 
     * @access private
     */
    private $name;
    
    /**
     * description of product of database.
     * @var string description 
     * @access private
     */
    private $description;

    /**
     * Constructor
     * 
     * @param idProduct the id
     * @param date the date
     * @param name the name
     * @param description the description
     */
    function Product($idProduct,$date,$name, $description) {
        $this->idProduct = $idProduct;
        $this->date = $date;
        $this->name = $name;
        $this->description = $description;
    }
    
    /**
     * Method that return the id of product.
     * 
     * @return idProduct the id
     */
    function getIdProduct(){
        return $this->idProduct;
    }
    
    /**
     * Method that change the id of product.
     * 
     * @param val the new id to change
     */
    function setIdProduct($val){
        $this->idProduct = $val;
    }
    
    /**
     * Method that return the date of product.
     * 
     * @return date the date
     */
    function getDate(){
        return $this->date;
    }
    
    /**
     * Method that change the date of product.
     * 
     * @param val the new date to change
     */
    function setDate($val){
        $this->date = $val;
    }
    
    /**
     * Method that return the name of product.
     * 
     * @return name the name
     */
    function getName(){
        return $this->name;
    }
    
    /**
     * Method that change the name of product.
     * 
     * @param val the new name to change
     */
    function setName($val){
        $this->name = $val;
    }
    
    /**
     * Method that return the description of product.
     * 
     * @return description the description
     */
    function getDescription(){
        return $this->description;
    }
    
    /**
     * Method that change the description of product.
     * 
     * @param val the new description to change
     */
    function setDescription($val){
        $this->description = $val;
    }    
}
?>