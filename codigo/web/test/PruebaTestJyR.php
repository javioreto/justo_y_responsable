<?php

include_once ("../dataAccess/dataBase.php");

/**
 * Class DataBaseTest extends PHPUnit_Framework_TestCase
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 */
class DataBaseTest extends PHPUnit_Framework_TestCase{
    
    /**
     * database.
     * @var database
     * @access private
     */
    private $dataBase;
    
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
    private $db;
    
    /**
     * connection of database.
     * @var connection
     * @access private
     */
    private $con;
    
    /**
     * method that runs before all tests.
     * 
     */
    protected function setUp(){
        $this->dataBase = new dataBase();
        $this->server = $this->dataBase->getServer();
        $this->username = $this->dataBase->getUsername();
        $this->password = $this->dataBase->getPassword();
        $this->db =  $this->dataBase->getDB();
        $this->con = $this->dataBase->ConnectDB($this->server,$this->username,$this->password,$this->db);  
    }
    
    /**
     * Method to test the database.
     * 
     */
    public function testGetParametersDb(){
        $result = $this->dataBase->getServer();
        $this->assertEquals($result, $this->server);
        $result2 = $this->dataBase->getUsername();
        $this->assertEquals($result2, $this->username);
        $result3 = $this->dataBase->getPassword();
        $this->assertEquals($result3, $this->password);
        $result4 = $this->dataBase->getDB();
        $this->assertEquals($result4, $this->db);
    }
    
    /**
     * Method to test the method getUserById.
     * 
     */
    public function testGetUserById(){
        $user = $this->dataBase->getUserById(1,$this->con);
        $this->assertNotNull($user);
        $this->assertEquals($user->getIdUser(),"1");
    }
    
    /**
     * Method to test the method getUserByDni.
     * 
     */
    public function testGetUserByDni(){
        $user = $this->dataBase->getUserByDni( "71290934L" ,$this->con);
        $this->assertNotNull($user);
        $this->assertEquals($user->getDni(),"71290934L");
    }
    
    /**
     * Method to test the method getGetUsers.
     * 
     */
    public function testGetUsers(){
        $users = $this->dataBase->getUsers($this->con);
        $this->assertNotNull($users);
        foreach($users AS $u){
            $this->assertNotNull($u);
        }
        $this->assertEquals(count($users),"36");
    }
    
    /**
     * Method to test the method getIdsImpOrgById.
     * 
     */
    //mirar el establecimiento en ese momento.
    public function testGetIdsImpOrgById(){
        $imports = $this->dataBase->getIdsImportOrganizationsById("28",$this->con);
        $this->assertNotNull($imports);
        $this->assertEquals(count($imports),1);
        $this->assertEquals($imports[0],2);
    }
    
    /**
     * Method to test the method getIdsImpOrgById.
     * 
     */
    //mirar el establecimiento en ese momento.
    public function testGetRefUserEstablishment(){
        $id = $this->dataBase->getRefUserEstablishment("28",$this->con);
        $this->assertNotNull($id);
        $this->assertEquals($id,17);
    }
    
    /**
     * Method to test the method getIdsRedById.
     * 
     */
   //mirar el establecimiento en ese momento.
   public function testGetIdsRedById(){
        $networks = $this->dataBase->getIdsRedById("28",$this->con);
        $this->assertNotNull($networks);
        foreach($networks AS $n){
            $this->assertNotNull($n);
        }
        $this->assertEquals(count($networks),"2");
        $this->assertEquals($networks[1],"3");
        $this->assertEquals($networks[0],"1");
    }
   
    /**
     * Method to test the method getIdsProductsById.
     * 
     */
    //mirar el establecimiento en ese momento.
    public function testGetIdsProductsById(){
        $products = $this->dataBase->getIdsProductsById("34",$this->con);
        $this->assertNotNull($products);
        foreach($products AS $p){
            $this->assertNotNull($p);
        }
        $this->assertEquals(count($products),"2");
        $this->assertEquals($products[0],"133");
        $this->assertEquals($products[1],"134");
    }
    
    /**
     * Method to test the method getCommentsById.
     * 
     */
    public function testGetCommentsById(){
        $comments = $this->dataBase->getCommentsById("1",$this->con);
        $this->assertNotNull($comments);
        $this->assertEquals(count($comments),"0");
    }
    
    /**
     * Method to test the method getSectorById.
     * 
     */
    public function testGetSectorById(){
        $sector = $this->dataBase->getSectorById("1",$this->con);
        $this->assertNotNull($sector);
        $this->assertEquals($sector->getIdSector(),"1");
        $this->assertEquals($sector->getName(),"Comercio justo");
    }
    
    /**
     * Method to test the method getTypeById.
     * 
     */
    public function testGetTypeById(){
        $type = $this->dataBase->getTypeById("1",$this->con);
        $this->assertNotNull($type);
        $this->assertEquals($type->getIdType(),"1");
        $this->assertEquals($type->getName(),"Sociedad Laboral");
    }
    
    /**
     * Method to test the method getEstabById.
     * 
     */
    public function testGetEstabById(){
        $establishment = $this->dataBase->getEstablishmentById("65",$this->con);
        $this->assertNotNull($establishment);
        
        $this->assertEquals($establishment->getIdEstablishment(),"65");
        $this->assertEquals($establishment->getName(),"AGORA");
    }
    
    /**
     * Method to test the method getEstabByLogo.
     * 
     */
    /*public function testGetEstabByLogo(){
        $establishment = $this->dataBase->getEstablishmentByLogo("../../images/10.jpg",$this->con);
        $this->assertEquals(count($establishment),0); //esto debera ser not null
        //$this->assertEquals($establishment->getIdEstablishment(),"1");//El id que sea
        $establishment = $this->dataBase->getEstablishmentByLogo("../../images/noexist.jpg",$this->con);
        $this->assertEquals(count($establishment),0);
    }*/
    
    /**
     * Method to test the method getEstabByIdUser.
     * 
     */
    //mirar el establecimiento en ese momento.
    public function testGetEstabByIdUser(){
        $establishment = $this->dataBase->getEstablishmentByIdUser("4",$this->con);
        $this->assertNotNull($establishment);
        foreach($establishment AS $e){
            $this->assertNotNull($e);
        }
        $this->assertEquals(count($establishment),"4");
        $this->assertEquals($establishment[0]->getIdEstablishment(),"80");
        $this->assertEquals($establishment[0]->getName(),"AYUDA EN ACCIÓN");
        $this->assertEquals($establishment[1]->getIdEstablishment(),"81");
        $this->assertEquals($establishment[1]->getName(),"AYUDA EN ACCIÓN");
        $this->assertEquals($establishment[2]->getIdEstablishment(),"82");
        $this->assertEquals($establishment[2]->getName(),"AYUDA EN ACCIÓN");
        $this->assertEquals($establishment[3]->getIdEstablishment(),"83");
        $this->assertEquals($establishment[3]->getName(),"AYUDA EN ACCIÓN");
    }
    
    /**
     * Method to test the method getAllEstablishment.
     * 
     */
    public function testGetAllEstablishment(){
        $establishment = $this->dataBase->getAllEstablishment($this->con);
        $this->assertNotNull($establishment);
        foreach($establishment AS $e){
            $this->assertNotNull($e);
        }
        $this->assertEquals(count($establishment),"50");
    }
    
    /**
     * Method to test the method getAllCategories.
     * 
     */
    public function testGetAllCategories(){
        $categories = $this->dataBase->getAllCategories($this->con);
        $this->assertNotNull($categories);
        foreach($categories AS $c){
            $this->assertNotNull($c);
        }
        $this->assertEquals(count($categories),"8");
    }
    
    /**
     * Method to test the method getSector.
     * 
     */
    public function testGetSector(){
        $sector = $this->dataBase->getSector($this->con);
        $this->assertNotNull($sector);
        foreach($sector AS $s){
            $this->assertNotNull($s);
        }
        $this->assertEquals(count($sector),"4");
        $this->assertEquals($sector[0]->getName(),"Comercio justo");
        $this->assertEquals($sector[1]->getName(),"Banca etica");
        $this->assertEquals($sector[2]->getName(),"Economia solidaria");
        $this->assertEquals($sector[3]->getName(),"Consumidores y usuarios organizados");
    }
    
    /**
     * Method to test the method getType.
     * 
     */
    public function testGetType(){
        $type = $this->dataBase->getType($this->con);
        $this->assertNotNull($type);
        foreach($type AS $t){
            $this->assertNotNull($t);
        }
        $this->assertEquals(count($type),"7");
        $this->assertEquals($type[0]->getName(),"Sociedad Laboral");
        $this->assertEquals($type[1]->getName(),"Centro Especial de Empleo");
        $this->assertEquals($type[2]->getName(),"Cooperativa");
        $this->assertEquals($type[3]->getName(),"Fundación");
        $this->assertEquals($type[4]->getName(),"Empresa de inserción");
        $this->assertEquals($type[5]->getName(),"Asociación");
        $this->assertEquals($type[6]->getName(),"Otros");
    }
    
    /**
     * Method to test the method getImpOrg.
     * 
     */
    public function testGetImpOrg(){
        $impororg = $this->dataBase->getImportOrganization($this->con);
        $this->assertNotNull($impororg);
        foreach($impororg AS $i){
            $this->assertNotNull($i);
        }
        $this->assertEquals(count($impororg),"8");
        $this->assertEquals($impororg[0]->getName(),"Adsis Equimercado");
        $this->assertEquals($impororg[1]->getName(),"Alternativa 3");
        $this->assertEquals($impororg[2]->getName(),"Espanica");
        $this->assertEquals($impororg[3]->getName(),"Fundación COPADE");
        $this->assertEquals($impororg[4]->getName(),"Fundación Vicente Ferrer");
        $this->assertEquals($impororg[5]->getName(),"IDEAS");
        $this->assertEquals($impororg[6]->getName(),"Intermón Oxfam");
        $this->assertEquals($impororg[7]->getName(),"Taller de Solidaridad");
        
    }
    
    /**
     * Method to test the method getImpOrgById.
     * 
     */
    public function testGetImpOrgById(){
        $arrayId = array();
        $arrayId[0] = "1";
        $arrayId[1] = "2";
        $impororg = $this->dataBase->getImportOrganizationById($arrayId,$this->con);
        $this->assertNotNull($impororg);
        foreach($impororg AS $i){
            $this->assertNotNull($i);
        }
        $this->assertEquals(count($impororg),"2");
        $this->assertEquals($impororg[0]->getName(),"Adsis Equimercado");
        $this->assertEquals($impororg[1]->getName(),"Alternativa 3");
    }
    
    /**
     * Method to test the method getNetworkById.
     * 
     */
    public function testGetNetworkById(){
        $arrayId = array();
        $arrayId[0] = "1";
        $arrayId[1] = "2";
        $network = $this->dataBase->getNetworkById($arrayId,$this->con);
        $this->assertNotNull($network);
        foreach($network AS $n){
            $this->assertNotNull($n);
        }
        $this->assertEquals(count($network),"2");
        $this->assertEquals($network[0]->getName(),"COOP.57");
        $this->assertEquals($network[1]->getName(),"CECJ");
    }
    
    /**
     * Method to test the method getNetwork.
     * 
     */
    public function testGetNetwork(){
        $network = $this->dataBase->getNetwork($this->con);
        $this->assertNotNull($network);
        foreach($network AS $n){
            $this->assertNotNull($n);
        }
        $this->assertEquals(count($network),"5");
        $this->assertEquals($network[0]->getName(),"COOP.57");
        $this->assertEquals($network[1]->getName(),"CECJ");
        $this->assertEquals($network[2]->getName(),"REAS");
        $this->assertEquals($network[3]->getName(),"FIARE");
        $this->assertEquals($network[4]->getName(),"ASGECO");
    }
    
    /**
     * Method to test the method getProductsById.
     * 
     */
    public function testGetProductsById(){
        $products = $this->dataBase->getProductsById("34",$this->con);
        $this->assertNotNull($products);
        foreach($products AS $p){
            $this->assertNotNull($p);
        }
        $this->assertEquals(count($products),"2");
        $this->assertEquals($products[0]->getIdProduct(),"134");
        $this->assertEquals($products[1]->getIdProduct(),"133");
    }
    
    /**
     * Method to test the method getUserNoValid.
     * 
     */
    public function testGetUserNoValid(){
        $users = $this->dataBase->getUserNoValid($this->con);
        $this->assertEquals(count($users),0);
    }
    
    /**
     * Method to test the method getUserValid.
     * 
     */
    public function testGetUserValid(){
        $users = $this->dataBase->getUserValid(1,$this->con);
        $this->assertNotNull($users);
        foreach($users AS $u){
            $this->assertNotNull($u);
        }
        $this->assertEquals(count($users),"35");
    }
    
    /**
     * Method to test the method getUserValid without admin.
     * 
     */
    public function testGetUserValidNoAdmin(){
        $users = $this->dataBase->getUserValidNoAdmin($this->con);
        $this->assertNotNull($users);
        foreach($users AS $u){
            $this->assertNotNull($u);
        }
        $this->assertEquals(count($users),"33");
    }
    
    /**
     * Method to test the method getSubCategories.
     * 
     */
    public function testGetSubCategories(){
        $subCat = $this->dataBase->getSubCategories("1",$this->con);
        $this->assertNotNull($subCat);
        foreach($subCat AS $c){
            $this->assertNotNull($c);
        }
        $this->assertEquals(count($subCat),"17");
    }
    
    /**
     * Method to test the method getpdateValidUser.
     * 
     */
    public function testUpdateValidUser(){
        $this->dataBase->insertUser('Maria', 'López Martínez', '81548753E', 'maria', '665665665', 'alderivas@hotmail.com',0,$this->con);
        $user = $this->dataBase->getUserNoValid($this->con);
        $this->assertEquals(count($user),"1");
        $this->dataBase->updateValidUser($user[0]->getIdUser(),$this->con);
        $users = $this->dataBase->getUserNoValid($this->con);
        $this->assertEquals(count($users),"0");
        $this->dataBase->deleteUser($user[0]->getIdUser(),$this->con);
    }
    
    /**
     * Method to test the method updateValidAllUser.
     * 
     */
    public function testUpdateValidAllUser(){
        $this->dataBase->insertUser('Maria', 'López Martínez', '23592597W', 'maria', '665665665', 'alderivas@hotmail.com',0,$this->con);
        $this->dataBase->insertUser('Pablo', 'López Martínez', '91070173V', 'pablo', '665665665', 'alderivas@hotmail.com',0,$this->con);
        $users = $this->dataBase->getUserNoValid($this->con);
        $this->assertEquals(count($users),"2");
        $this->dataBase->updateValidAllUser($this->con);
        $Allusers = $this->dataBase->getUserNoValid($this->con);
        $this->assertEquals(count($Allusers),"0");
        $this->dataBase->deleteUser($users[0]->getIdUser(),$this->con);
        $this->dataBase->deleteUser($users[1]->getIdUser(),$this->con);
    }
    
    /**
     * Method to test the method updateUser.
     * 
     */
    public function testUpdateUser(){
        $this->dataBase->insertUser('Maria', 'López Martínez','maria' ,'09391598P', 665665665, 'alderivas@hotmail.com',0,$this->con);
        $user = $this->dataBase->getUserNoValid($this->con);
        $this->assertEquals($user[0]->getName(),"Maria");        
        $this->dataBase->updateUser($user[0]->getIdUser(), 'Paula', 'López Martínez','maria' , '09391598P', 665665665, 'alderivas@hotmail.com',$this->con);
        $user = $this->dataBase->getUserNoValid($this->con);
        $this->assertEquals($user[0]->getName(),"Paula");
        $this->dataBase->deleteUser($user[0]->getIdUser(),$this->con);
    }
    
    /**
     * Method to test the method UpdateEstablishment.
     * 
     */
    public function testUpdateEstablishment(){
        $estab = $this->dataBase->getEstablishmentById(28, $this->con);
        
        $this->assertEquals($estab->getPhone(),976440530);
        
        $refuser = $this->dataBase->getRefUserEstablishment(28,$this->con);
        $this->dataBase->updateEstablishment(28, $estab->getName(), 947266554, $estab->getMail(), $estab->getLogo(),$estab->getCash(),$estab->getCard(),$estab->getPostCode(),$estab->getAddress(), $estab->getWebSite(), 
        $estab->getSchedule(),$estab->getFacebook(),$estab->getTwitter(),$estab->getDisableAccess(),$estab->getLatitude(),$estab->getLongitude(),$estab->getLocation(),$estab->getNature()->getIdType(), $estab->getSector()->getIdSector(), $refuser,$this->con);
        $estab = $this->dataBase->getEstablishmentById(28, $this->con);
        $this->assertEquals($estab->getPhone(),947266554);
        $this->dataBase->updateEstablishment(28, $estab->getName(), 976440530, $estab->getMail(), $estab->getLogo(),$estab->getCash(),$estab->getCard(),$estab->getPostCode(),$estab->getAddress(), $estab->getWebSite(), 
        $estab->getSchedule(),$estab->getFacebook(),$estab->getTwitter(),$estab->getDisableAccess(),$estab->getLatitude(),$estab->getLongitude(),$estab->getLocation(),$estab->getNature()->getIdType(), $estab->getSector()->getIdSector(), $refuser,$this->con);
    }
    
    

    /**
     * Method to test the method updateOrgPerEstablishment.
     * 
     */
    public function testUpdateOrgPerEst(){
        $est = $this->dataBase->getEstablishmentById(28, $this->con);
        $orgPer = $est->getReds();
        $this->assertEquals($orgPer[0],"1");
        $arrayOrgPer = array();
        $arrayOrgPer[0] = "2";
        $this->dataBase->updateOrgPerEstablishment(28, $arrayOrgPer,$this->con);
        $est2 = $this->dataBase->getEstablishmentById(28, $this->con);
        $orgPer2 = $est2->getReds();
        $this->assertEquals($orgPer2[0],"2");
        $this->dataBase->updateOrgPerEstablishment(28, $orgPer,$this->con);
    }
    
    /**
     * Method to test the method updateOrgImpEstablishment.
     * 
     */
    public function testUpdateOrgImpEst(){
        $est = $this->dataBase->getEstablishmentById(28, $this->con);
        $orgImp = $est->getImportOrganizations();
        $this->assertEquals(count($orgImp),1);
        $arrayOrgImp = array();
        $arrayOrgImp[0] = "2";
        $this->dataBase->updateOrgImpEstablishment(28, $arrayOrgImp,$this->con);
        $est2 = $this->dataBase->getEstablishmentById(28, $this->con);
        $orgImp2 = $est2->getImportOrganizations();
        
        $this->assertEquals($orgImp2[0],"2");
        $this->dataBase->updateOrgImpEstablishment(28, $orgImp,$this->con);
    }
    
    /**
     * Method to test the method insertProduct.
     * 
     */
    public function testInsertProduct(){
        $date = date('Y/m/d H:i:s');
        $id = $this->dataBase->insertProduct('cafe', $date, 'en polvo', '9',$this->con);
        $products = $this->dataBase->getProductsByIds("$id;",$this->con);
        $this->assertEquals(count($products),"1");
        $this->dataBase->deleteProduct($id,$this->con);
    }
    
    /**
     * Method to test the method insertEstablishment.
     * 
     */
    public function testInsertEstablishment(){
        $date = date('Y/m/d H:i:s');
        $ide = $this->dataBase->insertEstablishment('establecimiento', '', '', '','','','09002','calle san julian, 2', '', 
            '','','','','42.454656','-3.778763','Burgos','1', '1', '2', $this->con);
        $est = $this->dataBase->getEstablishmentById($ide,$this->con);
        $this->assertEquals(count($est),"1");
        
        $this->dataBase->deleteEstablishment($ide,$this->con);  
    }
    
    /**
     * Method to test the method insertProductsEstablishment.
     * 
     */
    public function testInsertProductsEst(){
        $date = date('Y/m/d H:i:s');
        $ide = $this->dataBase->insertEstablishment('establecimiento', '', '', '','','','09002','calle san julian, 2', '', 
            '','','','','42.454656','-3.778763','Burgos','1', '1', '2', $this->con);
        
        $prod = $this->dataBase->getProductsById($ide,$this->con);
        $this->assertEquals(count($prod),"0");
        $date = date('Y/m/d H:i:s');
        $id = $this->dataBase->insertProduct('cafe', $date, 'en polvo', '9',$this->con);
        $arrayids = array();
        $arrayids[0] = $id;
        $this->dataBase->insertProductsEstablishment($ide, $arrayids,$this->con);
        $products = $this->dataBase->getProductsById("$ide",$this->con);
        $this->assertEquals(count($products),"1");
        $this->dataBase->deleteEstablishment($ide,$this->con);  
    }
    
    /**
     * Method to test the method getEstablishmentByLogo.
     */
     public function testGetEstablishmentByLogo(){
         $estab = $this->dataBase->getEstablishmentByLogo("../../images/109.jpg",$this->con);
         $this->assertEquals(count($estab),1);
         $this->assertEquals($estab[0]->getIdEstablishment(),"109");
     }
    
    /**
     * Method to test the method insertUserValid.
     * 
     */
    public function testInsertUserValid(){
        $uservalid = $this->dataBase->getUserValid(1, $this->con);
        $this->assertEquals(count($uservalid),"35");
        
        $this->dataBase->insertUserValid("usuario", "apellidos", "69717340Q", "usu", "","",0,$this->con);
        $uservalid2 = $this->dataBase->getUserValid(1, $this->con);
        
        $this->assertEquals(count($uservalid)+1,count($uservalid2));
        
        $user = $this->dataBase->getUserByDni("69717340Q",$this->con);
        $this->dataBase->deleteUser($user->getIdUser(),$this->con);
    }
    
    /**
     * Method to test the method deleteEstablishment.
     * 
     */
    public function testDeleteEstablishment(){
        $date = date('Y/m/d H:i:s');
        $ide = $this->dataBase->insertEstablishment('establecimiento', '', '', '','','','09002','calle san julian, 2', '', 
            '','','','','42.454656','-3.778763','Burgos','1', '1', '2', $this->con);
        $total = $this->dataBase->getAllEstablishment($this->con);
        $this->dataBase->deleteEstablishment($ide,$this->con);
        $total2 = $this->dataBase->getAllEstablishment($this->con);
        $this->assertEquals((count($total)-1),count($total2));
    }
    
    
}
?>