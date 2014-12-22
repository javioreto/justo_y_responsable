<?php
include_once("../model/establishment.php");

include_once("../model/category.php");

include_once("../model/comment.php");

include_once("../model/product.php");

include_once("../model/sector.php");

include_once("../model/user.php");

include_once("../model/type.php");

include_once("../model/importOrganization.php");

include_once("../model/network.php");

include_once("../model/event.php");


/**
 * Class Database responsible for communicating with the database.
 * 
 * @author Gadea Hidalgo LÃ³pez
 * 
 * @version 1.0
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
     * Method that returns the user of userid.
     * 
     * @param id user id
     * @param con the connection
     * 
     * @return user
     */
    function getUserById($id,$con){
                         
        $sql = "select * from usuario where idusuario = '$id'";
        $result = mysql_query($sql, $con);
        $user = "";
        
        if(count($result)>0){
            while ($row = mysql_fetch_array($result)) {
                $u = new User($row['idusuario'],$row['nombre'],$row['apellidos'],$row['password'],$row['dni']
                ,$row['telefono'],$row['correo'],$row['administrador'],$row['validado']);
                 $user = $u;
            }
        }
        return $user;
    }
    
    /**
     * Method that returns the user of user dni
     * 
     * @param dni user dni
     * @param con the connection
     * 
     * @return user
     */
    function getUserByDni($dni,$con){
                         
        $sql = "select * from usuario where dni like '$dni'";
        $result = mysql_query($sql, $con);
        $user = "";
        
        if(count($result)>0){
            while ($row = mysql_fetch_array($result)) {
                $u = new User($row['idusuario'],$row['nombre'],$row['apellidos'],$row['password'],$row['dni']
                ,$row['telefono'],$row['correo'],$row['administrador'],$row['validado']);
                 $user = $u;
            }
        }
        return $user;
    }
    
    /**
     * Method that returns all user includes in database
     * 
     * @param con the connection
     * 
     * @return array of users
     */
    function getUsers($con){
        $arrayUsers = array();
        $sql = "select * from usuario";
        $result = mysql_query($sql, $con);
        while ($row = mysql_fetch_array($result)) {
            $user = new User($row['idusuario'],$row['nombre'],$row['apellidos'],$row['password'],$row['dni']
            ,$row['telefono'],$row['correo'],$row['administrador'],$row['validado']);
            $arrayUsers[] = $user;
        }
        return $arrayUsers;  
    }
    
    /**
     * Method that returns the id user of establishment.
     * 
     * @param idEstablishment the id of establishment
     * @param con the connection
     * 
     * @return id the user of the establishment
     */
    function getRefUserEstablishment($idEstablishment,$con){
        
        $sql = "select * from establecimiento where idestablecimiento = ".$idEstablishment;
        $id = "";
        $result = mysql_query($sql, $con);
        while ($row = mysql_fetch_array($result)) {
            $id = $row['refidusuario'];
        }
        return $id;
    }
    
    /**
     * Method that returns the ids of import organization from de establishmentid.
     * 
     * @param id the id of establishment
     * @param con the connection
     * 
     * @return array of import organizations ids
     */
    function getIdsImportOrganizationsById($id,$con){
        $sql = "select * from organizacionimportadoraestablecimiento where refestablecimiento =".$id;
        $result = mysql_query($sql, $con);
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
    function getIdsRedById($id,$con){
        $sql = "select * from redestablecimiento where refestablecimiento =". $id;
        $result = mysql_query($sql, $con);
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
    function getIdsProductsById($id,$con){
        $sql = "select * from productoestablecimiento where refestablecimiento =". $id;
        $result = mysql_query($sql, $con);
        $arrayIdProducts = array();
        while ($row = mysql_fetch_array($result)) {
            $arrayIdProducts[] = $row['refproducto'];
        }
        return $arrayIdProducts;
    }
    
    /**
     * Method that returns the products from de array of productsid.
     * 
     * @param arrayid the ids of products
     * @param con the connection
     * 
     * @return array of products
     */
    function getProductsByIds($arraid,$con){
        $array = split ("\;", $arraid);
        $sql = "select * from producto where ";
        foreach($array AS $a){
            if($a!=""){
                $sql.= "idproducto = $a OR ";
            }
        }
        
        $sql = substr($sql, 0, -3);
        $result = mysql_query($sql, $con);
        $arrayIdProducts[][] = " ";
        $i = 0;
        while ($row = mysql_fetch_array($result)) {
            $id = $row['idproducto'];
            $name = $row['nombre'];
            $description = $row['descripcion'];
            $date = $row['fecha'];
            $refcateg = $row['refidcategoria'];
            $product = new Product($id,$date,$name, $description);
            $arrayIdProducts[$i][0] = $product;
            $arrayIdProducts[$i][1] = $refcateg;
            $i = $i + 1;
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
    function getCommentsById($id,$con){
        $sql = "select * from comentario where refidestablecimiento =". $id." order by fecha DESC ";
        $result = mysql_query($sql, $con);
        $arrayComments = array();
        while ($row = mysql_fetch_array($result)) {
            $comment = new Comment($row['idcomentario'],$row['autor'],$row['fecha'], $row['descripcion']);
            $arrayComments[] = $comment;
        }
        return $arrayComments;
    }
    
    /**
     * Method that returns the sector from de sectorid.
     * 
     * @param id the id of sector
     * @param con the connection
     * 
     * @return sector the sector
     */
    function getSectorById($id, $con){
        $sql = "select * from sector where idsector=".$id;
        $result = mysql_query($sql, $con);
        $sector = "";
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
    function getTypeById($id, $con){
        $sql = "select * from tipo where idtipo=".$id;
        $result = mysql_query($sql, $con);
        $type = "";
        while ($row = mysql_fetch_array($result)) {
            $type = new Type($row['idtipo'],$row['nombre']);
        }
        return $type;
    } 
    
    /**
     * Method that returns the establishment from de establishmentid.
     * 
     * @param id the id of establishment
     * @param con the connection
     * 
     * @return establishment the establishment
     */
    function getEstablishmentById($idEstablishment, $con){
        
        $sql = "select * from establecimiento where idestablecimiento = ".$idEstablishment;
        $establishment = array();
        $result = mysql_query($sql, $con);
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
            $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$con);
            $reds = $this->getIdsRedById($row['idestablecimiento'],$con);
            $products = $this->getIdsProductsById($row['idestablecimiento'],$con);
            $comments = $this->getCommentsById($row['idestablecimiento'],$con);
            $schedule = $row['horario'];
            $type = $this->getTypeById($row['refidtipo'], $con);
            $sector = $this->getSectorById($row['refidsector'],$con);
            $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
    $products,$comments, $type, $sector);
        }
        return $establishment;
    }
    
    /**
     * Method that returns the establishment from de userid.
     * 
     * @param id the id of user
     * @param con the connection
     * 
     * @return arrayEstablishment of id user
     */
    function getEstablishmentByIdUser($id,$con){
        $arrayEstablishment = array();
        $sql = "select * from establecimiento where refidusuario = '$id' ORDER BY nombre";
        $result = mysql_query($sql, $con);
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
                    $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$con);
                    $reds = $this->getIdsRedById($row['idestablecimiento'],$con);
                    $products = $this->getIdsProductsById($row['idestablecimiento'],$con);
                    $comments = $this->getCommentsById($row['idestablecimiento'],$con);
                    $schedule = $row['horario'];
                    $type = $this->getTypeById($row['refidtipo'], $con);
                    $sector = $this->getSectorById($row['refidsector'],$con);
                    $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
            $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
            $products,$comments, $type, $sector);
                    $arrayEstablishment[] = $establishment;
        }
        return $arrayEstablishment;  
    }
    
    /**
     * Method that returns all establishment includes in the database.
     * 
     * @param con the connection
     * 
     * @return arrayEstablishment all establishment
     */
    function getAllEstablishment($con){
        $arrayEstablishment = array();
        $sql = "select * from establecimiento order by nombre";
        $result = mysql_query($sql, $con);
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
                    $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$con);
                    $reds = $this->getIdsRedById($row['idestablecimiento'],$con);
                    $products = $this->getIdsProductsById($row['idestablecimiento'],$con);
                    $comments = $this->getCommentsById($row['idestablecimiento'],$con);
                    $schedule = $row['horario'];
                    $type = $this->getTypeById($row['refidtipo'], $con);
                    $sector = $this->getSectorById($row['refidsector'],$con);
                    $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
            $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
            $products,$comments, $type, $sector);
                    $arrayEstablishment[] = $establishment;
        }
        return $arrayEstablishment;  
    }
    
    /**
     * Method that returns all categories of the top level.
     * 
     * @param connection the connection
     * 
     * @return arrayCategories array of categories
     */
    function getAllCategories($connection) {
        
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
     * Method that returns all type included in the database.
     * 
     * @param connection the connection
     * 
     * @return arrayType array of type
     */
    function getType($connection){
        $sql = "select * from tipo";
        $result = mysql_query($sql, $connection);
        $arrayType = array();
        while ($row = mysql_fetch_array($result)) {
            $type = new Type($row['idtipo'],$row['nombre']);
            $arrayType[] = $type;
        }
        return $arrayType;
    }
    
    /**
     * Method that returns all import organization included in the database.
     * 
     * @param connection the connection
     * 
     * @return arrayImportOrganization array of import organization
     */
    function getImportOrganization($connection){
        $sql = "select * from organizacionimportadora";
        $result = mysql_query($sql, $connection);
        $arrayImportOrganization = array();
        while ($row = mysql_fetch_array($result)) {
            $import = new ImportOrganization($row['idorganizacionimportadora'],$row['nombre']);
            $arrayImportOrganization[] = $import;
        }
        return $arrayImportOrganization;
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
     * Method that returns all network included in the database.
     * 
     * @param connection the connection
     * 
     * @return arrayNetwork array of network
     */
    function getNetwork($connection){
        $sql = "select * from red";
        $result = mysql_query($sql, $connection);
        $arrayNetwork = array();
        while ($row = mysql_fetch_array($result)) {
            $network = new Network($row['idred'],$row['nombre']);
            $arrayNetwork[] = $network;
        }
        return $arrayNetwork;
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
        $sql = "SELECT * FROM producto, productoestablecimiento WHERE idproducto = refproducto AND refestablecimiento = $id ORDER BY producto.nombre";
        $result = mysql_query($sql, $connection);
        $arrayProducts = array();
        while ($row = mysql_fetch_array($result)) {
            $product = new Product($row['idproducto'],$row['fecha'],$row['nombre'], $row['descripcion']);
            $arrayProducts[] = $product;
        }
        return $arrayProducts;
    }
    
    /**
     * Method that returns unvalidated users.
     * 
     * @param connection the connection
     * 
     * @return array of users
     */
    function getUserNoValid($connection){
        $sql = "SELECT * FROM usuario WHERE validado = 0 ORDER BY apellidos";
        $result = mysql_query($sql, $connection);
        $arrayUsers = array();
        while ($row = mysql_fetch_array($result)) {
            $user = new User($row['idusuario'],$row['nombre'],$row['apellidos'], $row['password'], $row['dni']
            , $row['telefono'], $row['correo'], $row['administrador'], $row['validado']);
            $arrayUsers[] = $user;
        }
        return $arrayUsers;
    }
    
    /**
     * Method that returns validated users.
     * 
     * @param connection the connection
     * 
     * @return array of users
     */
    function getUserValid($id, $connection){
        $sql = "SELECT * FROM usuario WHERE validado = 1 AND idusuario<>$id ORDER BY apellidos";
        $result = mysql_query($sql, $connection);
        $arrayUsers = array();
        while ($row = mysql_fetch_array($result)) {
            $user = new User($row['idusuario'],$row['nombre'],$row['apellidos'], $row['password'], $row['dni']
            , $row['telefono'], $row['correo'], $row['administrador'], $row['validado']);
            $arrayUsers[] = $user;
        }
        return $arrayUsers;
    }
    
    /**
     * Method that returns validated users.
     * 
     * @param connection the connection
     * 
     * @return array of users
     */
    function getUserValidNoAdmin($connection){
        $sql = "SELECT * FROM usuario WHERE validado = 1 AND administrador=0 ORDER BY apellidos";
        $result = mysql_query($sql, $connection);
        $arrayUsers = array();
        while ($row = mysql_fetch_array($result)) {
            $user = new User($row['idusuario'],$row['nombre'],$row['apellidos'], $row['password'], $row['dni']
            , $row['telefono'], $row['correo'], $row['administrador'], $row['validado']);
            $arrayUsers[] = $user;
        }
        return $arrayUsers;
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
     * Method that returns the establishments of logo.
     * 
     * @param logo establishment logo
     * @param con the connection
     * 
     * @return arrayEstablishment array of establishment
     */
    function getEstablishmentByLogo($logo,$con){
        $arrayEstablishment = array();
        $sql = "select * from establecimiento where logo = '$logo'";
        $result = mysql_query($sql, $con);
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
                    $importOrganizations = $this->getIdsImportOrganizationsById($row['idestablecimiento'],$con);
                    $reds = $this->getIdsRedById($row['idestablecimiento'],$con);
                    $products = $this->getIdsProductsById($row['idestablecimiento'],$con);
                    $comments = $this->getCommentsById($row['idestablecimiento'],$con);
                    $schedule = $row['horario'];
                    $type = $this->getTypeById($row['refidtipo'], $con);
                    $sector = $this->getSectorById($row['refidsector'],$con);
                    $establishment = new Establishment($idEstablishment, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
            $schedule,$facebook,$twitter,$disabledaccess,$latitude,$longitude,$location, $importOrganizations, $reds,
            $products,$comments, $type, $sector);
                    $arrayEstablishment[] = $establishment;
        }
        return $arrayEstablishment; 
    }
    
    /**
     * Method that valid user from the id.
     * 
     * @param id user id
     * @param con the connection
     *
     * @return email of user 
     */
    function updateValidUser($id,$con){
        $sql = "UPDATE usuario SET validado=1 WHERE idusuario=$id"; 
        mysql_query($sql,$con);
        
        /* return user email to send confirmation */
        
        $sql = "SELECT * FROM usuario WHERE idusuario=$id";
        $result = mysql_query($sql, $con);
        $row = mysql_fetch_array($result);
        $email=$row['correo'];
        
        return $email;
    }
    
    /**
     * Method that change the password
     * 
     * @param dni user id
     * @param pass new password
     * @param con the connection
     * 
     */
    function updatePassword($dni,$pass,$con){
    	$password=md5($pass);
        $sql = "UPDATE usuario SET password='$password' WHERE dni like '$dni'"; 
        mysql_query($sql,$con);
    }

    
    
    /**
     * Method that update the establishment.
     * 
     * @param $idestablecimientoedit the id of the establishment to edit
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
     * @param type the nature
     * @param sector the sector
     * @param iduser the id of user
     * @param con the connection
     * 
     */
    function updateEstablishment($idestablecimientoedit, $name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$dissableaccess,$latitude,$longitude,$location,$type, $sector, $iduser, $con){
        $sql = "UPDATE establecimiento SET nombre='$name', telefono='$phone', correo='$mail', logo='$logo', pagoefectivo='$cash', pagotarjeta='$card', codigopostal='$postcode', direccion='$address', paginaweb='$website', horario='$schedule' , facebook='$facebook', twitter='$twitter', accesominusvalidos='$dissableaccess', latitud='$latitude', longitud='$longitude',localidad='$location', refidusuario='$iduser', refidtipo='$type', refidsector='$sector'  WHERE idestablecimiento=$idestablecimientoedit"; 
        mysql_query($sql,$con);
        //return $id;
    }
    
    /**
     * Method that update the products for a establishment.
     * 
     * @param id the id of establishment
     * @param arrayIds the ids of products
     * @param con the connection
     */
    function updateProductsEst($id, $arrayIds, $con){
        $sql = "DELETE FROM productoestablecimiento WHERE refestablecimiento='$id' ";
        mysql_query($sql,$con);
        
        foreach($arrayIds AS $a){            
            if($a != ""){
                $sql = "insert into productoestablecimiento (refproducto, refestablecimiento)
                values ($a,$id)";
                mysql_query($sql,$con);    
            }
        }
    }
    
    /**
     * Method that updates the network of the establishment.
     * 
     * @param id the id of establishment.
     * @param arrayOrgPer the array of network
     * @param con the connection
     */
    function updateOrgPerEstablishment($id, $arrayOrgPer,$con){
        
        $sql = "DELETE FROM redestablecimiento WHERE refestablecimiento='$id' ";
        mysql_query($sql,$con);
        
        foreach($arrayOrgPer AS $a){
         
            $sql = "insert into redestablecimiento (refestablecimiento, refred) 
            values ($id,$a)";
    
            mysql_query($sql,$con);    
     
        }
    }
    
    /**
     * Method that updates the import organizations of the establishment.
     * 
     * @param id the id of establishment.
     * @param arrayOrgimp the array of import organizations
     * @param con the connection
     */
    function updateOrgImpEstablishment($id, $arrayOrgImp,$con){
        
        $sql = "DELETE FROM organizacionimportadoraestablecimiento WHERE refestablecimiento='$id' ";
        mysql_query($sql,$con);
        if(count($arrayOrgImp)>0){
            foreach($arrayOrgImp AS $a){
             
                $sql = "insert into organizacionimportadoraestablecimiento (reforganizacionimportadora, refestablecimiento) 
                values ($a,$id)";
        
                mysql_query($sql,$con);     
         
            }
        }
    }
    
    /**
     * Method that update user.
     * 
     * @param id user id
     * @param name user name
     * @param surname user surname
     * @param password user password
     * @param dni user dni
     * @param phone user phone
     * @param email user email
     * @param con the connection
     * 
     */
    function updateUser($id, $name, $surname, $password, $dni, $phone, $email, $con){
        $sql = "UPDATE usuario SET nombre='$name', apellidos='$surname', password='$password', dni='$dni', telefono=$phone, correo='$email' WHERE idusuario=$id";
        mysql_query($sql,$con);
    }
    
    /**
     * Method that validate all user.
     * 
     * @param con the connection
     * 
     */
    function updateValidAllUser($con){
        $sql = "UPDATE usuario SET validado=1 WHERE validado=0"; 
        mysql_query($sql,$con);
    }
    
    /**
     * Method that insert an user
     * 
     * @param name the name
     * @param surname the surnmae
     * @param dni the dni
     * @param password the password
     * @param phone the phone
     * @param email the email
     * @param con the connection
     * 
     */
    function insertUser($name, $surname, $dni, $password, $phone, $email,$admin,$con){
        $sql = "insert into usuario (idusuario, nombre, apellidos, password, dni, telefono, correo, administrador, validado) 
        values ('','".$name."','".$surname."','".$password."','".$dni."',
        '".$phone."','".$email."',".$admin.",0)";
        mysql_query($sql,$con);
    }
    
    /**
     * Method that insert a valid user
     * 
     * @param name the name
     * @param surname the surnmae
     * @param dni the dni
     * @param password the password
     * @param phone the phone
     * @param email the email
     * @param con the connection
     * 
     */
    function insertUserValid($name, $surname, $dni, $password, $phone, $email,$admin,$con){
        $sql = "insert into usuario (idusuario, nombre, apellidos, password, dni, telefono, correo, administrador, validado) 
        values ('','".$name."','".$surname."','".$password."','".$dni."',
        '".$phone."','".$email."',".$admin.",1)";
        mysql_query($sql,$con);
    }
    
    /**
     * Method that insert a product.
     * 
     * @param name the name
     * @param date the date
     * @param decription the description
     * @param refCateg the id of category
     * @param con the connection
     * 
     * @return id the id of insert product
     * 
     */
    function insertProduct($name, $date, $description, $refCateg,$code,$img,$con){
        $sql = "insert into producto (idproducto, nombre, fecha, descripcion, refidcategoria, codbarras, img) 
        values ('','".$name."','".$date."','".$description."','".$refCateg."','".$code."','".$img."')";
        mysql_query($sql,$con);
        
        $sql2 = "select * from producto ORDER BY idproducto";
        
        $result = mysql_query($sql2, $con);
        $array = array();
        $id = "";
        while ($row = mysql_fetch_array($result)) {
                
            $id =  $row['idproducto'];   
            
        }
        return $id;
    }
    
    /**
     * Method that insert a establishment
     * 
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
     * @param nature the nature
     * @param sector the sector
     * @param refiduser the id of user
     * @param con the connection
     * 
     * @return id the id of insert establishment.
     */
    function insertEstablishment($name, $phone, $mail, $logo,$cash,$card,$postcode,$address, $website, 
    $schedule,$facebook,$twitter,$dissableaccess,$latitude,$longitude,$location,$nature, $sector, $refiduser, $con){
        
        $sql = "insert into establecimiento (idestablecimiento, nombre, telefono, correo, logo, pagoefectivo, pagotarjeta,codigopostal, direccion, paginaweb, horario, facebook, twitter, accesominusvalidos, latitud, longitud,localidad, refidusuario, refidtipo, refidsector) values ('','".$name."','".$phone."','".$mail."','".$logo."','".$cash."','".$card."','".$postcode."','".$address."','".$website."','".$schedule."','".$facebook."','".$twitter."','".$dissableaccess."','".$latitude."','".$longitude."','".$location."','".$refiduser."','".$nature."','".$sector."')";
             
        mysql_query($sql,$con);
        
        $sql2 = "select * from establecimiento ORDER BY idestablecimiento";
        
        $result = mysql_query($sql2, $con);
        $array = array();
        $id = "";
        while ($row = mysql_fetch_array($result)) {
                
            $id =  $row['idestablecimiento'];   
            
        }
        return $id;
    }
    
    /**
     * Method that insert id products and id establishment.
     * 
     * @param id the id of establishment
     * @param arrayids ids of products
     * @param con the connection
     */
    function insertProductsEstablishment($id, $arrayids,$con){
        foreach($arrayids AS $a){
            if($a != ""){
                $sql = "insert into productoestablecimiento (refproducto, refestablecimiento)
                values ($a,$id)";
                mysql_query($sql,$con);    
            }
        }
        
    }
    
    /**
     * Method that insert id network and id establishment.
     * 
     * @param id the id of establishment
     * @param arrayOrgPer ids of network
     * @param con the connection
     */
    function insertOrgPerEstablishment($id, $arrayOrgPer,$con){
        foreach($arrayOrgPer AS $a){
            
            $sql = "insert into redestablecimiento (refestablecimiento, refred) 
            values ($id,$a)";
    
            mysql_query($sql,$con);    
     
        }
    }
    
    /**
     * Method that insert id organization import and id establishment.
     * 
     * @param id the id of establishment
     * @param arrayOrgImp ids of organization import
     * @param con the connection
     */
    function insertOrgImpEstablishment($id, $arrayOrgImp,$con){
        if($arrayOrgImp!=""){
            foreach($arrayOrgImp AS $a){
             
                $sql = "insert into organizacionimportadoraestablecimiento (reforganizacionimportadora, refestablecimiento) 
                values ($a,$id)";
        
                mysql_query($sql,$con);    
         
            }
         }
    }
    
    /**
     * Method that delete user by id
     * 
     * @param id id of user
     * @param con the connection
     */
    function deleteUser($id,$con){
        $sql = "DELETE FROM usuario WHERE idusuario = $id ";
        mysql_query($sql,$con);
    }
    
    /**
     * Method that delete establishment by id
     * 
     * @param id the id of establishment
     * @param con the connection
     */
    function deleteEstablishment($id,$con){
        $establishment = $this->getEstablishmentById($id, $con);
        $urllogo = $establishment->getLogo();
        $sql = "DELETE FROM establecimiento WHERE idestablecimiento = $id ";
        if($urllogo != "" ){
            $establishments = $this->getEstablishmentByLogo($urllogo,$con);
            if(count($establishments)==1){
                unlink($urllogo);
            }
        }
        mysql_query($sql,$con);
    }
    
    /**
     * Method that delete product by id
     * 
     * @param id the id of product
     * @param con the connection
     */
    function deleteProduct($id,$con){
        $sql = "DELETE FROM producto WHERE idproducto = $id ";
        mysql_query($sql,$con);
    }
    
    /**
     * Method that delete products by array of ids
     * 
     * @param arrayids the ids of products
     * @param con the connection
     */
    function deleteProducts($arrayids,$con){
        if($arrayids!=""){
            $sql = "DELETE FROM producto WHERE ";
            foreach($arrayids AS $a){
                if($a!=""){
                    $sql.= "idproducto = $a OR ";
                }
            }
            $sql = substr($sql, 0, -3);
            mysql_query($sql,$con);
        }
    }
    
    /**
     * Method that delete comment by id
     * 
     * @param id the id of comment
     * @param con the connection
     */
    function deleteComment($id,$con){
        $sql = "DELETE FROM comentario WHERE idcomentario = $id";
        mysql_query($sql,$con);
    }
    
    
    
    
    
    
    /** NUEVAS FUNCIONES */
    
    
    
     function insertEvent($name,$address,$postcode,$latitude,$longitude,$locality,$descripcion,$fecha,$inicio,$inicio,$fin,$tipo,$val,$userselect,$con){
        
        $sql = "insert into evento (idEvento, descripcion, direccion, localidad, cp,fecha, inicio, fin, fecha_creacion, nombre, longitud, latitud, validado, idTipo, idEstablecimiento) values ('','".$descripcion."','".$address."','".$locality."','".$postcode."','".$fecha."','".$inicio."','".$fin."','".$fecha."','".$name."','".$longitude."','".$latitude."','".$val."','".$tipo."','".$userselect."')";
             
        mysql_query($sql,$con);
        
        $sql2 = "select * from evento ORDER BY idEvento";
        
        $result = mysql_query($sql2, $con);
        $array = array();
        $id = "";
        while ($row = mysql_fetch_array($result)) {
                
            $id =  $row['idEvento'];   
            
        }
        return $id;
    }
    
    
     function updateEvent($id,$name,$address,$postcode,$latitude,$longitude,$locality,$descripcion,$fecha,$inicio,$inicio,$fin,$tipo,$userselect,$con){
        
        $sql = "UPDATE evento SET descripcion='$descripcion', direccion='$address', localidad='$locality', cp='$postcode',fecha='$fecha', inicio='$inicio', fin='$fin', fecha_creacion='$fecha', nombre='$name', longitud='$longitude', latitud='$latitude', idTipo='$tipo', idEstablecimiento='$userselect' WHERE idEvento=$id";      
        mysql_query($sql,$con);
        
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
    
    
    
        
    function deleteEvent($id,$con){
        $sql = "DELETE FROM evento WHERE idEvento =".$id;
        mysql_query($sql, $con);
       }
       
    
}

?>