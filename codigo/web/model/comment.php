<?php

/**
 * Class Comment
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Comment{
    	
	/**
     * id of comment of database.
     * 
     * @var int id 
     * @access private
     */
	private $idComment;
    
    /**
     * author of comment of database.
     * 
     * @var int author 
     * @access private
     */
    private $author;
    
    /**
     * date of comment of database.
     * 
     * @var int date
     * @access private
     */
	private $date;
    
    /**
     * description of comment of database.
     * 
     * @var int description
     * @access private
     */
    private $description;
    
    private $idevento;
    
    private $refidestablecimiento;

	/**
     * Constructor of Comment.
     * 
     * @param idComment the id of comment
     * @param author the author of the comment
     * @param date the date of the comment
     * @param description the description of the comment
     */
	function Comment($idComment,$author,$date, $description, $idevento, $refidestablecimiento) {
	    $this->idComment = $idComment;
		$this->author = $author;
		$this->date = $date;
        $this->description = $description;
        $this->idevento = $idevento;
        $this->refidestablecimiento = $refidestablecimiento;
    }
    
    /**
     * Method that return the id of comment.
     * 
     * @return idComment the id
     */
	function getIdComment(){
        return $this->idComment;
    }
    
    /**
     * Method that change the id of comment.
     * 
     * @param val the new id to change
     */
    function setIdComment($val){
        $this->idComment = $val;
    }
    
    /**
     * Method that return the author of comment.
     * 
     * @return author the name of author
     */
    function getAuthor(){
        return $this->author;
    }
    
    /**
     * Method that change the author of comment.
     * 
     * @param val the new author to change
     */
    function setAuthor($val){
        $this->author = $val;
    }
    
    /**
     * Method that return the date of comment.
     * 
     * @return date the date
     */
	function getDate(){
		return $this->date;
 	}
	
    /**
     * Method that change the date of comment.
     * 
     * @param val the new date to change
     */
	function setDate($val){
		$this->date = $val;
 	}
	
    /**
     * Method that return the description of comment.
     * 
     * @return desciption the description
     */
	function getDescription(){
		return $this->description;
 	}
	
    /**
     * Method that change the desciption of comment.
     * 
     * @param val the new desciption to change
     */
	function setDescription($val){
		$this->description = $val;
 	}
 	
	function getrefidestablecimiento(){
		return $this->refidestablecimiento;
	} 
	
	function getidevento(){
		return $this->idevento;
	}     
    
}
?>