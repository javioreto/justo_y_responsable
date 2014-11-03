<?php

/**
 * Class Establishment
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class Establishment{
    
    /**
     * id of establishment of database.
     * @var int id 
     * @access private
     */
    private $idEstablishment;
    
    /**
     * name of establishment of database.
     * @var string name 
     * @access private
     */    	
    private $name;
    
    /**
     * phone of establishment of database.
     * @var int phone 
     * @access private
     */
    private $phone;
    
    /**
     * mail of establishment of database.
     * @var string mail 
     * @access private
     */
    private $mail;
    
    /**
     * logo of establishment of database.
     * @var string url of logo 
     * @access private
     */
    private $logo;
    
    /**
     * cash of establishment of database.
     * @var int cash 
     * @access private
     */
    private $cash; 
    
    /**
     * card of establishment of database.
     * @var int card 
     * @access private
     */
	private $card;
    
    /**
     * postcode of establishment of database.
     * @var int postcode 
     * @access private
     */
    private $postCode;
    
    /**
     * address of establishment of database.
     * @var string address 
     * @access private
     */
    private $address;
    
    /**
     * website of establishment of database.
     * @var string website 
     * @access private
     */
	private $website;
    
    /**
     * schedule of establishment of database.
     * @var string schedule 
     * @access private
     */
	private $schedule;
    
    /**
     * facebook of establishment of database.
     * @var string url of facebook 
     * @access private
     */
    private $facebook;
    
    /**
     * twitter of establishment of database.
     * @var string twitter 
     * @access private
     */
    private $twitter;  
    
    /**
     * dissabled of establishment of database.
     * @var int dissabledaccess 
     * @access private
     */
	private $disabledaccess;
    
    /**
     * latitude of establishment of database.
     * @var double latitude 
     * @access private
     */
	private $latitude;
    
    /**
     * longitude of establishment of database.
     * @var double longitude 
     * @access private
     */
    private $longitude;
    
    /**
     * location of establishment of database.
     * @var string location 
     * @access private
     */
    private $location;
    
    /**
     * import organizations of establishment of database.
     * @var string import organization 
     * @access private
     */
	public $importOrganizations;
    
    /**
     * network of establishment of database.
     * @var string network 
     * @access private
     */
	public $reds;
    
    /**
     * products of establishment of database.
     * @var string array of id of products 
     * @access private
     */
    public $products;
    
    /**
     * comments of establishment of database.
     * @var string array of id of comments 
     * @access private
     */
    public $comments;
    
    /**
     * nature of establishment of database.
     * @var string array of id of nature 
     * @access private
     */
    public $nature;
    
    /**
     * sector of establishment of database.
     * @var id of sector 
     * @access private
     */
    public $sector;
	
    /**
     * Constructor
     * 
     * @param idEstablishment the id 
     * @param name the name
     * @param phone the phone
     * @param mail the mail
     * @param logo the logo
     * @param cash the cash
     * @param card the card
     * @param postcode the postcode
     * @param address the address
     * @param website the website
     * @param schedule the schedule
     * @param facebook the facebook
     * @param twitter the twitter
     * @param dissableaccess the dissableaccess
     * @param latitude the latitude
     * @param longitude the longitude
     * @param location the location
     * @param importOrganization the import organization
     * @param reds the network
     * @param products the array of products
     * @param comments the array of comments
     * @param nature the nature
     * @param sector the sector
     * 
     */
	function Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
	$schedule,$facebook,$twitter,$dissableaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
	$products,$comments, $nature, $sector){
	    
		$this->idEstablishment = $idEstablishment;					    
		$this->name = $name;
		$this->phone = $phone;
		$this->mail = $mail;
		$this->logo = $logo;
        $this->cash = $cash;
        $this->card = $card;
        $this->postCode = $postcode;
        $this->address = $address;
		$this->website = $website;
		$this->schedule = $schedule;
        $this->facebook = $facebook;
        $this->twitter = $twitter;
		$this->disabledaccess = $dissableaccess;
		$this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->location = $location;
		$this->importOrganizations = $importOrganizations;
		$this->reds = $reds;
        $this->products = $products;
        $this->comments = $comments;
        
		$this->nature = $nature;
        $this->sector = $sector;
    }
    
    /**
     * Method that return the id of establishment.
     * 
     * @return idEstablishment the id
     */
    function getIdEstablishment(){
        return $this->idEstablishment;
    }
    
    /**
     * Method that change the id of establishment.
     * 
     * @param val the new id to change
     */
    function setIdEstablishment($val){
        $this->idEstablishment = $val;
    }
	
    /**
     * Method that return the name of establishment.
     * 
     * @return name the name
     */
	function getName(){
		return $this->name;
 	}
	
    /**
     * Method that change the name of establishment.
     * 
     * @param val the new name to change
     */
	function setName($val){
		$this->name = $val;
 	}
	
    /**
     * Method that return the phone of establishment.
     * 
     * @return phone the phone
     */
	function getPhone(){
		return $this->phone;
 	}
	
    /**
     * Method that change the phone of establishment.
     * 
     * @param val the new phone to change
     */
	function setPhone($val){
		$this->phone = $val;
 	}
	
    /**
     * Method that return the mail of establishment.
     * 
     * @return mail the mail
     */
	function getMail(){
		return $this->mail;
 	}
	
    /**
     * Method that change the mail of establishment.
     * 
     * @param val the new mail to change
     */
	function setMail($val){
		$this->mail = $val;
 	}
    
	/**
     * Method that return the logo of establishment.
     * 
     * @return logo the logo
     */
	function getLogo(){
		return $this->logo;
 	}
	
    /**
     * Method that change the logo of establishment.
     * 
     * @param val the new logo to change
     */
	function setLogo($val){
		$this->logo = $val;
 	}
    
    /**
     * Method that return the cash of establishment.
     * 
     * @return cash the cash
     */
    function getCash(){
        return $this->cash;
    }
    
    /**
     * Method that change the cash of establishment.
     * 
     * @param val the new cash to change
     */
    function setCash($val){
        $this->cash = $val;
    }
    
    /**
     * Method that return the card of establishment.
     * 
     * @return card the card
     */
    function getCard(){
        return $this->card;
    }
    
    /**
     * Method that change the card of establishment.
     * 
     * @param val the new card to change
     */
    function setCard($val){
        $this->card = $val;
    }
    
    /**
     * Method that return the postcode of establishment.
     * 
     * @return postcode the postcode
     */
    function getPostCode(){
        return $this->postCode;
    }
    
    /**
     * Method that change the postcode of establishment.
     * 
     * @param val the new postcode to change
     */
    function setPostCode($val){
        $this->postCode = $val;
    }
    
    /**
     * Method that return the address of establishment.
     * 
     * @return address the address
     */
    function getAddress(){
        return $this->address;
    }
    
    /**
     * Method that change the address of establishment.
     * 
     * @param val the new address to change
     */
    function setAddress($val){
        $this->address = $val;
    }
    
    /**
     * Method that return the facebook of establishment.
     * 
     * @return facebook the url of facebook
     */
    function getFacebook(){
        return $this->facebook;
    }
    
    /**
     * Method that change the facebook of establishment.
     * 
     * @param val the new url of faceboook to change
     */
    function setFacebook($val){
        $this->facebook = $val;
    }
    
    /**
     * Method that return the twitter of establishment.
     * 
     * @return twitter the url of twitter
     */
    function getTwitter(){
        return $this->twitter;
    }
    
    /**
     * Method that change the twitter of establishment.
     * 
     * @param val the new url of twitter to change
     */
    function setTwitter($val){
        $this->twitter = $val;
    }
	
    /**
     * Method that return the website of establishment.
     * 
     * @return website the website
     */
	function getWebSite(){
		return $this->website;
 	}
	
    /**
     * Method that change the website of establishment.
     * 
     * @param val the new website to change
     */
	function setWebSite($val){
		$this->website = $val;
 	}
	
    /**
     * Method that return the schedule of establishment.
     * 
     * @return schedule the schedule
     */
	function getSchedule(){
		return $this->schedule;
 	}
	
    /**
     * Method that change the schedule of establishment.
     * 
     * @param val the new schedule to change
     */
	function setSchedule($val){
		$this->schedule = $val;
 	}
	
    /**
     * Method that return the dissabledaccess of establishment.
     * 
     * @return dissabledaccess the dissabledaccess
     */
	function getDisableAccess(){
		return $this->disabledaccess;
 	}
	
    /**
     * Method that change the dissabledaccess of establishment.
     * 
     * @param val the new dissabledaccess to change
     */
	function setDisableAccess($val){
		$this->disabledaccess = $val;
 	}
	
    /**
     * Method that return the latitude of establishment.
     * 
     * @return latitude the latitude
     */
	function getLatitude(){
		return $this->latitude;
 	}
	
    /**
     * Method that change the latitude of establishment.
     * 
     * @param val the new latitude to change
     */
	function setLatitude($val){
		$this->latitude = $val;
 	}
	
    /**
     * Method that return the longitude of establishment.
     * 
     * @return longitude the longitude
     */
    function getLongitude(){
        return $this->longitude;
    }
    
    /**
     * Method that change the longitude of establishment.
     * 
     * @param val the new longitude to change
     */
    function setLongitude($val){
        $this->longitude = $val;
    }
    
    /**
     * Method that return the location of establishment.
     * 
     * @return location the location
     */
    function getLocation(){
        return $this->location;
    }
    
    /**
     * Method that change the location of establishment.
     * 
     * @param val the new location to change
     */
    function setLocation($val){
        $this->location = $val;
    }
    
    /**
     * Method that return the import organizations of establishment.
     * 
     * @return importOrganizations the import organizations
     */
	function getImportOrganizations(){
		return $this->importOrganizations;
 	}
	
    /**
     * Method that change the import organization of establishment.
     * 
     * @param val the new array of import organization to change
     */
	function setImportOrganizations($val){
		$this->importOrganizations = $val;
 	}
	
    /**
     * Method that return the network of establishment.
     * 
     * @return network the network
     */
	function getReds(){
		return $this->reds ;
 	}
	
    /**
     * Method that change the network of establishment.
     * 
     * @param val the new array of network to change
     */
	function setReds($val){
		$this->reds = $val;
 	}
	
    /**
     * Method that return the products of establishment.
     * 
     * @return products the array of products
     */
    function getProducts(){
        return $this->products ;
    }
    
    /**
     * Method that change the products of establishment.
     * 
     * @param val the new array of products to change
     */
    function setProducts($val){
        $this->products = $val;
    }
    
    /**
     * Method that return the comment of establishment.
     * 
     * @return comments the array of comments
     */
    function getComments(){
        return $this->comments ;
    }
    
    /**
     * Method that change the comments of establishment.
     * 
     * @param val the new array of comments to change
     */
    function setComments($val){
        $this->comments = $val;
    }
    
    /**
     * Method that return the nature of establishment.
     * 
     * @return nature the nature
     */
    function getNature(){
        return $this->nature;
    }
    
    /**
     * Method that change the nature of establishment.
     * 
     * @param val the new nature to change
     */
    function setNature($val){
        $this->nature = $val;
    }
    
    /**
     * Method that return the sector of establishment.
     * 
     * @return sector the sector
     */
    function getSector(){
        return $this->sector;
    }
    
    /**
     * Method that change the sector of establishment.
     * 
     * @param val the new sector to change
     */
    function setSector($val){
        $this->sector = $val;
    }
        
}

?>