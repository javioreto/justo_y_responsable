<?php

include_once("../model/establishment.php");

include_once("../model/category.php");

include_once("../model/comment.php");

include_once("../model/product.php");

include_once("../model/sector.php");

include_once("../model/type.php");

include_once("../model/importOrganization.php");

include_once("../model/network.php");

include_once("../model/event.php");


/**
 * Class Database responsible for communicating with the database.
 * 
 * @author Javier López Martínez
 * @author Gadea Hidalgo López
 * 
 * @version 2.0
 * 
 */
class DataBase{
    /**
     * server of database.
     * @var string server
     * @access private
     */	
	private $server;
    
    /**
     * username of database.
     * @var string username
     * @access private
     */
	private $username;
    
    /**
     * password of database.
     * @var string password
     * @access private
     */
	private $password;
    
    /**
     * name of database.
     * @var string name
     * @access private
     */
	private $database;
	
    /**
     * Constructor of DataBase class.
     */
	function DataBase(){
		$this->server = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "justoyresponsable";
	}
	
    /**
     * Method that returns the server of database.
     * 
     * @return the server
     */
	function getServer(){
		return $this->server;
	}
	
    /**
     * Method that returns the username of database.
     * 
     * @return the username
     */
	function getUsername(){
		return $this->username;
	}
    
    /**
     * * Method that returns the password of database.
     * 
     * @return the password
     */
	function getPassword(){
		return $this->password;
	}
	
    /**
     * Method that returns the name of database.
     * 
     * @return the name of database
     */
	function getDB(){
		return $this->database;
	}
	
    /**
     * Method that connect with the database.
     * 
     * @param serverbd the server 
     * @param userbd the username 
     * @param passbd the password
     * @param db the name of database
     * 
     * @return con the connection
     */
	function ConnectDB($serverbd,$userbd,$passbd,$db){
	    
		$con = @mysql_connect($serverbd, $userbd, $passbd);
        @mysql_select_db($db, $con);
        @mysql_query("SET NAMES 'utf8'");
        
		return $con;
	}
    
    /**
     * Method that check the connect with the database.
     * 
     * @param serverbd the server 
     * @param userbd the username 
     * @param passbd the password
     * @param db the name of database
     * 
     */
    function CheckConnectDB($serverbd,$userbd,$passbd,$db){
        
        $con = @mysql_connect($serverbd, $userbd, $passbd);
        $flag = true;
        if(!$con){
            $flag = false;
        }
        
        if(!@mysql_select_db($db, $con)){
            $flag = false;
        }
        
        if(!@mysql_query("SET NAMES 'utf8'")){
            $flag = false;
        }
        
        if(!$flag){
            header('Location:../view/errorBd.php');
        }
        
    }
	
    /**
     * Method that disconnect the database
     * 
     * @param con the connection
     * 
     */
	function disconnectDataBase($con) {
		mysql_close($con);
	}
    
    /**
     * Method that returns all categories of the top level.
     * 
     * @param connection the connection
     * 
     * @return arrayCategories array of categories
     */
	function getCategories($connection) {
		
		$sql = "select * from categoria where refcategoria is null ORDER BY nombre";
		$result = mysql_query($sql, $connection);
		
		while ($row = mysql_fetch_array($result)) {
		    $idCategory = $row['idcategoria']; 
			$name = $row['nombre'];
            $refcateg = $row['refcategoria'];
			$category = new Category($idCategory,$name,$refcateg);
			$arrayCategories[] = $category;
		}
		return $arrayCategories;
	}
	
	function getAllSubCategories($connection) {
		
		$sql = "select * from categoria where refcategoria is not null";
		$result = mysql_query($sql, $connection);
		
		while ($row = mysql_fetch_array($result)) {
		    $idCategory = $row['idcategoria']; 
			$name = $row['nombre'];
            $refcateg = $row['refcategoria'];
			$category = new Category($idCategory,$name,$refcateg);
			$arrayCategories[] = $category;
		}
		return $arrayCategories;
	}

    
    /**
     * Method that returns subCategories from categoryid.
     * 
     * @param idCategory the id of the category
     * @param connection the connection
     * 
     * @return arraySubcategories array of categories
     */
	function getSubCategories($idCategory, $connection) {
           
		$sql = "select * from categoria where refcategoria=".$idCategory;
        
		$result = mysql_query($sql, $connection);
		$arraySubcategories = array();
		while ($row = mysql_fetch_array($result)) {
            
			$subcategory = new Category($row['idcategoria'],$row['nombre'],$row['refcategoria']);
			$arraySubcategories[] = $subcategory;
            
		}
		return $arraySubcategories;
	}
	
    /**
     * Method that returns the sector from de sectorid.
     * 
     * @param id the id of sector
     * @param con the connection
     * 
     * @return sector the sector
     */    
    function getSectorById($id, $connection){
        $sql = "select * from sector where idsector=".$id;
        $result = mysql_query($sql, $connection);
        while ($row = mysql_fetch_array($result)) {
            $sector = new Sector($row['idsector'],$row['nombre']);
        }
        return $sector;
    }
    
    /**
     * Method that returns the type from de sectorid.
     * 
     * @param id the id of type
     * @param con the connection
     * 
     * @return type the type
     */
    function getTypeById($id, $connection){
        $sql = "select * from tipo where idtipo=".$id;
        $result = mysql_query($sql, $connection);
        while ($row = mysql_fetch_array($result)) {
            $type = new Type($row['idtipo'],$row['nombre']);
        }
        return $type;
    } 
    
    /**
     * Method that returns the import organizations from importorganizationids.
     * 
     * @param connection the connection
     * @param arrayId ids from import organization
     * 
     * @return arrayImportOrganization array of import organization
     */
    function getImportOrganizationById($arrayId, $connection){
        $sql = "select * from organizacionimportadora WHERE ";
        foreach($arrayId AS $id){
            $sql .= "idorganizacionimportadora = $id OR ";
        }
        $sql = substr($sql, 0, -3);
        
        $result = mysql_query($sql, $connection);
        $arrayImportOrganization = array();
        while ($row = mysql_fetch_array($result)) {
            $import = new ImportOrganization($row['idorganizacionimportadora'],$row['nombre']);
            $arrayImportOrganization[] = $import;
        }
        return $arrayImportOrganization;
    }
    
    /**
     * Method that returns the network from networkid.
     * 
     * @param connection the connection
     * @param arrayId ids from network
     * 
     * @return arrayNetwork array of network
     */
    function getNetworkById($arrayId, $connection){
        $sql = "select * from red WHERE ";
        foreach($arrayId AS $id){
            $sql .= "idred = $id OR ";
        }
        $sql = substr($sql, 0, -3);
        $result = mysql_query($sql, $connection);
        $arrayNetwork = array();
        while ($row = mysql_fetch_array($result)) {
            $network = new Network($row['idred'],$row['nombre']);
            $arrayNetwork[] = $network;
        }
        return $arrayNetwork;
    }
    
    /**
     * Method that returns the subcategories from the id of category.
     * 
     * @param row the row of the query
     * @param connection the connection
     * 
     * @return array ids of subcategories
     */
    function intoCategories($row, $connection){
        $in = true;
        $arr = Array();
        $arrayIdCat = Array();
        $id2 = $row['idcategoria'];
        $sql2 = "SELECT * FROM categoria WHERE refcategoria = ".$id2;
        $results2 = mysql_query($sql2, $connection);
        
            while ($row = mysql_fetch_array($results2)) {
                $in = false;
                $arr = $this->intoCategories( $row, $connection);
                foreach ($arr as $a) {
                    $arrayIdCat[] = $a;
                }
            }
        if($in){
            $arrayIdCat[] = $id2;
        }
        return $arrayIdCat;
    }
    
    /**
     * Method thar returns establishment from array of categories.
     * 
     * @param arrayCategories the arrayids of categories
     * @param connection the connection
     * 
     * @return totalCategorias the array of establishment
     */
    function getEstablishmentWithoutProduct($connection){
        $sql = "SELECT * FROM `establecimiento` where idestablecimiento not in (select distinct refestablecimiento from productoestablecimiento) and refidsector = 1";
        $result = mysql_query($sql, $connection);
        $arrayEstablishments = array();
        while ($row = mysql_fetch_array($result)) {
            $idEstablishment = $row['idestablecimiento'];
            $name = $row['nombre'];
            $phone = $row['telefono'];          
            $mail = $row['correo'];
            $logo = $row['logo'];
            $cash = $row['pagoefectivo'];
            $card = $row['pagotarjeta'];
            $postcode = $row['codigopostal'];
            $address = $row['direccion'];
            $website = $row['paginaweb'];
            $schedule = $row['horario'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
            $disabledaccess = $row['accesominusvalidos'];
            $latitude = $row['latitud'];
            $longitude = $row['longitud'];
            $location = $row['localidad'];
            $online = $row['online'];
            $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
            $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
            $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $connection);
            $sector = $this->getSectorById($row['refidsector'],$connection);
            $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector, $online);
            $arrayEstablishments[] = $establishment;
        }
        return $arrayEstablishments;
    }
    
    /**
     * Method thar returns establishment from array of categories.
     * 
     * @param arrayCategories the arrayids of categories
     * @param connection the connection
     * 
     * @return totalCategorias the array of establishment
     */
    function getEstablishmentByCategories($arrayCategories, $connection){
        $arrayEstablishmentsAllCat = array();
        $arrayEstablishments = array();
        $arrayIdCat = array();
        $arr = array();
        $sql = "SELECT * FROM categoria WHERE ";
        
        foreach ($arrayCategories AS $category){
                
            if(substr($category, 0,1)=="a"  /*empieza por a*/){
              
                $id = substr($category, 3,strlen($category));//sacas el id
                $sql .= " refcategoria = ".$id;
                
                $results = mysql_query($sql, $connection);
                
                    while ($row = mysql_fetch_array($results)) {
                        $arr = $this->intoCategories($row, $connection);
                        foreach($arr AS $a){
                            $arrayIdCat[] = $a;
                        }
                        
                    }
                if(count($arrayIdCat)!=0){
                    $sql = "select * from establecimiento, productoestablecimiento, producto where idestablecimiento=refestablecimiento AND refproducto = idproducto AND ( ";
                    foreach($arrayIdCat AS $id){
                        $sql .= "refidcategoria = $id OR ";
                    }
                    $sql = substr($sql,0,-3);
                    $sql .=")";
                    $result = mysql_query($sql, $connection);
                    $arrayEstablishments = array();
                    while ($row = mysql_fetch_array($result)) {
                        $idEstablishment = $row['idestablecimiento'];
                        $name = $row['nombre'];
                        $phone = $row['telefono'];          
                        $mail = $row['correo'];
                        $logo = $row['logo'];
                        $cash = $row['pagoefectivo'];
                        $card = $row['pagotarjeta'];
                        $postcode = $row['codigopostal'];
                        $address = $row['direccion'];
                        $website = $row['paginaweb'];
                        $schedule = $row['horario'];
                        $facebook = $row['facebook'];
                        $twitter = $row['twitter'];
                        $disabledaccess = $row['accesominusvalidos'];
                        $latitude = $row['latitud'];
                        $longitude = $row['longitud'];
                        $location = $row['localidad'];
                        $online = $row['online'];
                        $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
                        $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
                        $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
                        $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
                        $schedule = $row['horario'];
                        $type = $this->getTypeById($row['refidtipo'], $connection);
                        $sector = $this->getSectorById($row['refidsector'],$connection);
                        $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
                $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
                $products,$comments, $type, $sector, $online);
                        $arrayEstablishmentsAllCat[] = $establishment;
                    }  
                }
            }else{
                $sql = "select * from establecimiento, productoestablecimiento, producto where idestablecimiento=refestablecimiento AND refproducto = idproducto AND refidcategoria = $category";
                 
                $result = mysql_query($sql, $connection);
                
                while ($row = mysql_fetch_array($result)) {
                    $idEstablishment = $row['idestablecimiento'];
                    $name = $row['nombre'];
                    $phone = $row['telefono'];          
                    $mail = $row['correo'];
                    $logo = $row['logo'];
                    $cash = $row['pagoefectivo'];
                    $card = $row['pagotarjeta'];
                    $postcode = $row['codigopostal'];
                    $address = $row['direccion'];
                    $website = $row['paginaweb'];
                    $schedule = $row['horario'];
                    $facebook = $row['facebook'];
                    $twitter = $row['twitter'];
                    $disabledaccess = $row['accesominusvalidos'];
                    $latitude = $row['latitud'];
                    $longitude = $row['longitud'];
                    $location = $row['localidad'];
                    $online = $row['online'];
                    $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
                    $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
                    $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
                    $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
                    $schedule = $row['horario'];
                    $type = $this->getTypeById($row['refidtipo'], $connection);
                    $sector = $this->getSectorById($row['refidsector'],$connection);
                    $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
            $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
            $products,$comments, $type, $sector, $online);
                    if(!$this->checkInto($arrayEstablishments,$idEstablishment)){
                        $arrayEstablishments[] = $establishment;
                    }
                }
            }
        }   
        
        
        $totalCategorias = $arrayEstablishmentsAllCat;
        
        $into = false;
        foreach($arrayEstablishments AS $s){
            foreach($arrayEstablishmentsAllCat AS $f){
                if($s->getIdEstablishment() == $f->getIdEstablishment()){
                    $into = true;
                }
            }
            if($into==false){
                
                $totalCategorias[] = $s; 
            }
            $into = false;
        }    
 
        return $totalCategorias;
    }

    /**
     * Method that returns all establishment includes in the database.
     * 
     * @param con the connection
     * 
     * @return arrayEstablishment all establishment
     */  
    function checkInto($array, $id){
        foreach($array as $a){
            if($a->getIdEstablishment()==$id){
                return true;
            }
        }
        return false;
    }
    
    /**
     * Method that returns all establishment includes in the database.
     * 
     * @param con the connection
     * 
     * @return arrayEstablishment all establishment
     */  
	function getEstablishment($connection){
		$sql = "select * from establecimiento";
		$result = mysql_query($sql, $connection);
		$arrayEstablishments = array();
		while ($row = mysql_fetch_array($result)) {
		    $idEstablishment = $row['idestablecimiento'];
			$name = $row['nombre'];
            $phone = $row['telefono'];			
			$mail = $row['correo'];
			$logo = $row['logo'];
            $cash = $row['pagoefectivo'];
            $card = $row['pagotarjeta'];
            $postcode = $row['codigopostal'];
            $address = $row['direccion'];
			$website = $row['paginaweb'];
			$schedule = $row['horario'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
			$disabledaccess = $row['accesominusvalidos'];
            $latitude = $row['latitud'];
            $longitude = $row['longitud'];
            $location = $row['localidad'];
            $online = $row['online'];
			$importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
			$reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
            $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $connection);
            $sector = $this->getSectorById($row['refidsector'],$connection);
			$establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector, $online);
			$arrayEstablishments[] = $establishment;
		}
        
		return $arrayEstablishments;
	}

    /**
     * Method that returns the establishment by array of sector.
     * 
     * @param arraySector the array of sector
     * @param connection the connection
     * 
     * @return arrayEstablishment the array of establishments.
     */
    function getEstablishmentBySector($arraySector, $connection){
        $sql = "select * from establecimiento where ";
        $flag = false;
        foreach($arraySector AS $sector){
            if($sector != 1){
                $sql .= " refidsector = $sector OR ";
                $flag = true;
            }
        }
        $arrayEstablishments = array();
        if($flag){
            $sql = substr($sql,0,-3);
            
            $result = mysql_query($sql, $connection);
            while ($row = mysql_fetch_array($result)) {
                $idEstablishment = $row['idestablecimiento'];
                $name = $row['nombre'];
                $phone = $row['telefono'];          
                $mail = $row['correo'];
                $logo = $row['logo'];
                $cash = $row['pagoefectivo'];
                $card = $row['pagotarjeta'];
                $postcode = $row['codigopostal'];
                $address = $row['direccion'];
                $website = $row['paginaweb'];
                $schedule = $row['horario'];
                $facebook = $row['facebook'];
                $twitter = $row['twitter'];
                $disabledaccess = $row['accesominusvalidos'];
                $latitude = $row['latitud'];
                $longitude = $row['longitud'];
                $location = $row['localidad'];
                $online = $row['online'];
                $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
                $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
                $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
                $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
                $schedule = $row['horario'];
                $type = $this->getTypeById($row['refidtipo'], $connection);
                $sector = $this->getSectorById($row['refidsector'],$connection);
                $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
        $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
        $products,$comments, $type, $sector, $online);
                $arrayEstablishments[] = $establishment;
            }
        }
        return $arrayEstablishments;
    }

    /**
     * Method that returns establishment with sector equals to fair trade.
     * 
     * @param connection the connection
     * 
     * @return arrayEstablishments the array of establishments
     */
    function getEstablishmentBySectorcj($connection){
        $sql = "select * from establecimiento where refidsector = 1";
        $arrayEstablishments = array();
            $result = mysql_query($sql, $connection);
            while ($row = mysql_fetch_array($result)) {
                $idEstablishment = $row['idestablecimiento'];
                $name = $row['nombre'];
                $phone = $row['telefono'];          
                $mail = $row['correo'];
                $logo = $row['logo'];
                $cash = $row['pagoefectivo'];
                $card = $row['pagotarjeta'];
                $postcode = $row['codigopostal'];
                $address = $row['direccion'];
                $website = $row['paginaweb'];
                $schedule = $row['horario'];
                $facebook = $row['facebook'];
                $twitter = $row['twitter'];
                $disabledaccess = $row['accesominusvalidos'];
                $latitude = $row['latitud'];
                $longitude = $row['longitud'];
                $location = $row['localidad'];
                $online = $row['online'];
                $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
                $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
                $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
                $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
                $schedule = $row['horario'];
                $type = $this->getTypeById($row['refidtipo'], $connection);
                $sector = $this->getSectorById($row['refidsector'],$connection);
                $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
        $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
        $products,$comments, $type, $sector, $online);
                $arrayEstablishments[] = $establishment;
            }

        return $arrayEstablishments;
    }

    /**
     * Method that returns the establishment with locality equals to madrid.
     * 
     * @param connection the connection
     * 
     * @return arrayEstablishments the array of establishment
     */
    function getEstablishmentInMadrid($connection){
        $sql = "select * from establecimiento where localidad='Madrid'";
        $result = mysql_query($sql, $connection);
        $arrayEstablishments = array();
        while ($row = mysql_fetch_array($result)) {
            $idEstablishment = $row['idestablecimiento'];
            $name = $row['nombre'];
            $phone = $row['telefono'];          
            $mail = $row['correo'];
            $logo = $row['logo'];
            $cash = $row['pagoefectivo'];
            $card = $row['pagotarjeta'];
            $postcode = $row['codigopostal'];
            $address = $row['direccion'];
            $website = $row['paginaweb'];
            $schedule = $row['horario'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
            $disabledaccess = $row['accesominusvalidos'];
            $latitude = $row['latitud'];
            $longitude = $row['longitud'];
            $location = $row['localidad'];
            $online = $row['online'];
            $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
            $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
            $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $connection);
            $sector = $this->getSectorById($row['refidsector'],$connection);
            $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector, $online);
            $arrayEstablishments[] = $establishment;
        }
        return $arrayEstablishments;
    }

    /**
     * Method that returns the establishment by locality.
     * 
     * @param locality the locality
     * @param connection the connection
     * 
     * @return arrayEstablishment the array of estabalishment
     */
    function getEstablishmentByLocality($locality, $connection){
        $sql = "select * from establecimiento where localidad='".$locality."'";
        $result = mysql_query($sql, $connection);
        $arrayEstablishments = array();
        while ($row = mysql_fetch_array($result)) {
            $idEstablishment = $row['idestablecimiento'];
            $name = $row['nombre'];
            $phone = $row['telefono'];          
            $mail = $row['correo'];
            $logo = $row['logo'];
            $cash = $row['pagoefectivo'];
            $card = $row['pagotarjeta'];
            $postcode = $row['codigopostal'];
            $address = $row['direccion'];
            $website = $row['paginaweb'];
            $schedule = $row['horario'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
            $disabledaccess = $row['accesominusvalidos'];
            $latitude = $row['latitud'];
            $longitude = $row['longitud'];
            $location = $row['localidad'];
            $online = $row['online'];
            $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
            $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
            $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $connection);
            $sector = $this->getSectorById($row['refidsector'],$connection);
            $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector, $online);
            $arrayEstablishments[] = $establishment;
        }
        return $arrayEstablishments;
    }

    /**
     * Method that returns the establishment from de establishmentid.
     * 
     * @param id the id of establishment
     * @param con the connection
     * 
     * @return establishment the establishment
     */
    function getEstablishmentById($idEstablishment, $connection){
        $establishment = null;
        $sql = "select * from establecimiento where idestablecimiento = ".$idEstablishment;
        
        $result = mysql_query($sql, $connection);
        while ($row = mysql_fetch_array($result)) {
            $idEstablishment = $row['idestablecimiento'];
            $name = $row['nombre'];
            $phone = $row['telefono'];          
            $mail = $row['correo'];
            $logo = $row['logo'];
            $cash = $row['pagoefectivo'];
            $card = $row['pagotarjeta'];
            $postcode = $row['codigopostal'];
            $address = $row['direccion'];
            $website = $row['paginaweb'];
            $schedule = $row['horario'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
            $disabledaccess = $row['accesominusvalidos'];
            $latitude = $row['latitud'];
            $longitude = $row['longitud'];
            $location = $row['localidad'];
            $online = $row['online'];
            $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
            $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
            $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $connection);
            $sector = $this->getSectorById($row['refidsector'],$connection);
            $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector, $online);
        }
        return $establishment;
    }

    /**
     * Method that returns the import organizations from importorganizationids.
     * 
     * @param connection the connection
     * @param arrayId ids from import organization
     * 
     * @return arrayImportOrganization array of import organization
     */
    function getIdsImportOrganizationsById($id,$connection){
        $sql = "select * from organizacionimportadoraestablecimiento where refestablecimiento =". $id;
        $result = mysql_query($sql, $connection);
        $arrayIdImportOrganizations = array();
        while ($row = mysql_fetch_array($result)) {
            $arrayIdImportOrganizations[] = $row['reforganizacionimportadora'];
        }
        return $arrayIdImportOrganizations;
    }
	
    /**
     * Method that returns the ids of network from de establishmentid.
     * 
     * @param id the id of establishment
     * @param con the connection
     * 
     * @return array of network ids
     */
    function getIdsRedById($id,$connection){
        $sql = "select * from redestablecimiento where refestablecimiento =". $id;
        $result = mysql_query($sql, $connection);
        $arrayIdsRed = array();
        while ($row = mysql_fetch_array($result)) {
            $arrayIdsRed[] = $row['refred'];
        }
        return $arrayIdsRed;
    }
    
    /**
     * Method that returns the ids of products from de establishmentid.
     * 
     * @param id the id of establishment
     * @param con the connection
     * 
     * @return array of products ids
     */
    function getIdsProductsById($id,$connection){
        $sql = "select * from productoestablecimiento where refestablecimiento =". $id;
        $result = mysql_query($sql, $connection);
        $arrayIdProducts = array();
        while ($row = mysql_fetch_array($result)) {
            $arrayIdProducts[] = $row['refproducto'];
        }
        return $arrayIdProducts;
    }
    
    /**
     * Method that returns the comments from de establishmentid.
     * 
     * @param id the id of establishment
     * @param con the connection
     * 
     * @return arrayComments of comments
     */
    function getCommentsById($id,$connection){
        $sql = "select * from comentario where refidestablecimiento =". $id." order by fecha DESC ";
        $result = mysql_query($sql, $connection);
        $arrayComments = array();
        while ($row = mysql_fetch_array($result)) {
            $comment = new Comment($row['idcomentario'],$row['autor'],$row['fecha'], $row['descripcion']);
            $arrayComments[] = $comment;
        }
        
        return $arrayComments;
    }
    
    function getEventCommentsById($id,$connection){
        $sql = "select * from comentario where idevento =". $id." order by fecha DESC ";
        $result = mysql_query($sql, $connection);
        $arrayComments = array();
        while ($row = mysql_fetch_array($result)) {
            $comment = new Comment($row['idcomentario'],$row['autor'],$row['fecha'], $row['descripcion']);
            $arrayComments[] = $comment;
        }
        
        return $arrayComments;
    }

    
    /**
     * Method that returns all sector included in the database.
     * 
     * @param connection the connection
     * 
     * @return arraySector array of sector
     */
    function getSector($connection){
        $sql = "select * from sector";
        $result = mysql_query($sql, $connection);
        $arraySector = array();
        while ($row = mysql_fetch_array($result)) {
            $sector = new Sector($row['idsector'],$row['nombre']);
            $arraySector[] = $sector;
        }
        return $arraySector;
    }
    
    /**
     * Method that returns the products by establishmentid.
     * 
     * @param id id of establishment
     * @param connection the connection
     * 
     * @return arrayProducts array of products
     */
    function getProductsById($id,$connection){
        $sql = "SELECT * FROM producto, productoestablecimiento WHERE idproducto = refproducto AND refestablecimiento = ". $id;
        $result = mysql_query($sql, $connection);
        $arrayProducts = array();
        while ($row = mysql_fetch_array($result)) {
            $product = new Product($row['idproducto'],$row['fecha'],$row['nombre'], $row['descripcion'], $row['img'], $row['refidcategoria']);
            $arrayProducts[] = $product;
        }
        return $arrayProducts;
    }
    
    /**
     * Method thar insert comment.
     * 
     * @param author the author
     * @param date the date
     * @param text the text
     * @param refE the reference of the establishment
     * @param connection the connection
     * 
     */
    function insertComment($author,$date,$text,$refE,$connection){
        $sql = "insert into comentario (idcomentario,autor,fecha,descripcion,refidestablecimiento,idevento) values ('','".$author."','".$date."','".$text."',".$refE.",'')";
        mysql_query($sql,$connection);
    }
    
    /**
     * Method thar insert comment.
     * 
     * @param author the author
     * @param date the date
     * @param text the text
     * @param refE the reference of the establishment
     * @param connection the connection
     * 
     */
    function insertCommentEvent($author,$date,$text,$refE,$connection){
        $sql = "insert into comentario (idcomentario,autor,fecha,descripcion,refidestablecimiento,idevento) values ('','".$author."','".$date."','".$text."','',".$refE.")";
        mysql_query($sql,$connection) or die(mysql_error());
    }

    
    
    /** NEW FUNCTIONS */
    
     /**
     * Method that returns the products by barcode.
     * 
     * @param barcode barcode of product
     * @param connection the connection
     * 
     * @return num products
     */
    function checkProductsByCode($barcode,$connection){
    	$id;
    	
        $sql = "SELECT idproducto FROM producto WHERE codbarras = '".$barcode."' limit 0,1";
        $result = mysql_query($sql, $connection) or die("Error en: ".$sql.": " . mysql_error());;
	        while($row = mysql_fetch_array($result)){
	        	$id=$row['idproducto']; 
	        }
	       
        return $id;
    }

    
    /**
     * Method that returns the products by establishmentid.
     * 
     * @param id id of establishment
     * @param connection the connection
     * 
     * @return arrayProducts array of products
     */
    function getProductById($id,$connection){
        $sql = "SELECT * FROM producto WHERE idproducto = ". $id;
        $result = mysql_query($sql, $connection);
        $arrayProducts = array();
        while ($row = mysql_fetch_array($result)) {
            $product = new Product($row['idproducto'],$row['fecha'],$row['nombre'], $row['descripcion'], $row['img'], $row['refidcategoria']);
            $arrayProducts[] = $product;
        }
        return $arrayProducts;
    }

    


    function getAllEvents($con){
        $arrayEvent = array();
        $sql = "select * from evento order by idEvento DESC";
        $result = mysql_query($sql, $con);
        while ($row = mysql_fetch_array($result)) {                    
                    $event = new Event($row['idEvento'], $row['descripcion'], $row['direccion'],$row['localidad'],$row['cp'],
                    $row['fecha'],$row['inicio'], $row['fin'],$row['fecha_creacion'],$row['nombre'],$row['longitud'],$row['latitud'],
                    $row['validado'],$row['idTipo'],$row['idEstablecimiento']);
                    
                    $arrayEvent[] = $event;
        }
        return $arrayEvent;  
    }
    
    
    function getAllEventsByEstablishmentId($id,$con){
        $arrayEvent = array();
        $sql = "select * from evento where idEstablecimiento =".$id." order by idEvento DESC";
        $result = mysql_query($sql, $con);
        while ($row = mysql_fetch_array($result)) {                    
                    $event = new Event($row['idEvento'], $row['descripcion'], $row['direccion'],$row['localidad'],$row['cp'],
                    $row['fecha'],$row['inicio'], $row['fin'],$row['fecha_creacion'],$row['nombre'],$row['longitud'],$row['latitud'],
                    $row['validado'],$row['idTipo'],$row['idEstablecimiento']);
                    
                    $arrayEvent[] = $event;
        }
        return $arrayEvent;  
    }
    
    function getEventById($id,$con){
        $sql = "select * from evento where idEvento =".$id;
        $result = mysql_query($sql, $con);
        $row = mysql_fetch_array($result);                   
                    $event = new Event($row['idEvento'], $row['descripcion'], $row['direccion'],$row['localidad'],$row['cp'],
                    $row['fecha'],$row['inicio'], $row['fin'],$row['fecha_creacion'],$row['nombre'],$row['longitud'],$row['latitud'],
                    $row['validado'],$row['idTipo'],$row['idEstablecimiento']);
        return $event;  
    }
    
    function getEventsInMadrid($con){
        $arrayEvent = array();
        $sql = "select * from evento where localidad='Madrid'";
        $result = mysql_query($sql, $con);
        while ($row = mysql_fetch_array($result)) {                    
                    $event = new Event($row['idEvento'], $row['descripcion'], $row['direccion'],$row['localidad'],$row['cp'],
                    $row['fecha'],$row['inicio'], $row['fin'],$row['fecha_creacion'],$row['nombre'],$row['longitud'],$row['latitud'],
                    $row['validado'],$row['idTipo'],$row['idEstablecimiento']);
                    
                    $arrayEvent[] = $event;
                }
        return $arrayEvent;  
    }

    
    
    function getEventByData($arraySector,$inicio,$fin,$desde,$hasta,$idEstablecimiento,$connection){
        $hasta1 = date("Y-m-d", strtotime($hasta));
		$desde1 = date("Y-m-d", strtotime($desde));
		
        $sql = "select * from evento where (inicio >=  '$inicio' AND  fin <=  '$fin') AND (";
        
        if($desde!="" && $hasta!=""){
	        $sql .= "fecha >=  '$desde1' AND  fecha <=  '$hasta1') AND (";
        }else{
        
	         if($desde!=""){
		        $sql .= "fecha >=  '$desde1') AND (";
	        }
	
	 		if($hasta!=""){
		        $sql .= "fecha <=  '$hasta1') AND (";
	        }

        }
        
        if($idEstablecimiento!=""){
	        $sql .= "idEstablecimiento =  '$idEstablecimiento') AND (";
        }
        
        $flag = false;
        foreach($arraySector AS $sector){
            if($sector != 1){
                $sql .= " idTipo = $sector OR ";
                $flag = true;
            }
        }
        $arrayEvent = array();
        if($flag){
            $sql = substr($sql,0,-3);
            $sql .=")";
            
            $result = mysql_query($sql, $connection) or die(mysql_error());
            while ($row = mysql_fetch_array($result)) {
                    $event = new Event($row['idEvento'], $row['descripcion'], $row['direccion'],$row['localidad'],$row['cp'],
                    $row['fecha'],$row['inicio'], $row['fin'],$row['fecha_creacion'],$row['nombre'],$row['longitud'],$row['latitud'],
                    $row['validado'],$row['idTipo'],$row['idEstablecimiento']);
                    
                    $arrayEvent[] = $event;
                 }
        }
        return $arrayEvent;
    }


    function getEventsByLocality($locality, $connection){
        $sql = "select * from evento where localidad='".$locality."'";
        $result = mysql_query($sql, $connection);
        $arrayEvent = array();
        while ($row = mysql_fetch_array($result)) {
            $event = new Event($row['idEvento'], $row['descripcion'], $row['direccion'],$row['localidad'],$row['cp'],
                    $row['fecha'],$row['inicio'], $row['fin'],$row['fecha_creacion'],$row['nombre'],$row['longitud'],$row['latitud'],
                    $row['validado'],$row['idTipo'],$row['idEstablecimiento']);
                    
                    $arrayEvent[] = $event;
        }
        return $arrayEvent;
    }

	function getEstablishmentByName($name, $connection){
	$establishment=null;
        $sql = "select * from establecimiento where nombre LIKE '%".$name."%'";
        $result = mysql_query($sql, $connection);
       $arrayEstablishments = array();
        if($row = mysql_fetch_array($result)){
            $idEstablishment = $row['idestablecimiento'];
            $name = $row['nombre'];
            $phone = $row['telefono'];          
            $mail = $row['correo'];
            $logo = $row['logo'];
            $cash = $row['pagoefectivo'];
            $card = $row['pagotarjeta'];
            $postcode = $row['codigopostal'];
            $address = $row['direccion'];
            $website = $row['paginaweb'];
            $schedule = $row['horario'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
            $disabledaccess = $row['accesominusvalidos'];
            $latitude = $row['latitud'];
            $longitude = $row['longitud'];
            $location = $row['localidad'];
            $online = $row['online'];
            $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
            $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
            $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $connection);
            $sector = $this->getSectorById($row['refidsector'],$connection);
            $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector, $online);
        }
        return $establishment;
    }

    function getEstablishmentOnline($connection){
        $sql = "select * from establecimiento where online='1'";
        $result = mysql_query($sql, $connection);
        $arrayEstablishments = array();
        while ($row = mysql_fetch_array($result)) {
            $idEstablishment = $row['idestablecimiento'];
            $name = $row['nombre'];
            $phone = $row['telefono'];          
            $mail = $row['correo'];
            $logo = $row['logo'];
            $cash = $row['pagoefectivo'];
            $card = $row['pagotarjeta'];
            $postcode = $row['codigopostal'];
            $address = $row['direccion'];
            $website = $row['paginaweb'];
            $schedule = $row['horario'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
            $disabledaccess = $row['accesominusvalidos'];
            $latitude = $row['latitud'];
            $longitude = $row['longitud'];
            $location = $row['localidad'];
            $online = $row['online'];
            $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$connection);
            $reds = $this->getIdsRedById($row['idestablecimiento'],$connection);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$connection);
            $comments = $this->getCommentsById($row['idestablecimiento'],$connection);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $connection);
            $sector = $this->getSectorById($row['refidsector'],$connection);
            $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector, $online);
            $arrayEstablishments[] = $establishment;
        }
        return $arrayEstablishments;
    }

    function insertAcceso($idioma,$connection){
        $sql = "insert into accesos (id,idioma) values ('','$idioma')";
        mysql_query($sql,$connection);
    }
    
    function insertBusqueda($idobjeto,$tipo,$connection){
        $sql = "insert into busqueda (idBusqueda,idObjeto,tipo) values ('','$idobjeto','$tipo')";
        mysql_query($sql,$connection);
    }

  
}

?>