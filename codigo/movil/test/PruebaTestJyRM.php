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
     * Test that ckeck the method getCategories. 
     */
    public function testGetCategories(){
        $categories = $this->dataBase->getCategories($this->con);
        $this->assertNotNull($categories);
        foreach($categories AS $c){
            $this->assertNotNull($c);
        }
        $this->assertEquals(count($categories),"8");
    } 
    
    /**
     * Test that ckeck the method getSubCategories. 
     */
    public function testGetSubCategories(){
        $arrayCategories = array();
        $categories = $this->dataBase->getSubCategories("2",$this->con);
        $this->assertNotNull($categories);
        foreach($categories AS $c){
            $this->assertNotNull($c);
        }
        $this->assertEquals(count($categories),"2");
        $this->assertEquals($categories[0]->getIdCategory(),"26");
        $this->assertEquals($categories[1]->getIdCategory(),"27");
    }
    
    /**
     * Test that ckeck the method getSectorById 
     */
    public function testGetSectorById(){
        $sector = $this->dataBase->getSectorById("1",$this->con);
        $this->assertNotNull($sector);
        $this->assertEquals($sector->getIdSector(),"1");
        $this->assertEquals($sector->getName(),"Comercio justo");
    }
    
    /**
     * Test that ckeck the method getTypeById 
     */
    public function testGetTypeById(){
        $type = $this->dataBase->getTypeById("1",$this->con);
        $this->assertNotNull($type);
        $this->assertEquals($type->getIdType(),"1");
        $this->assertEquals($type->getName(),"Sociedad Laboral");
    }
    
    /**
     * Test that ckeck the method intoCategories. 
     */
    public function testIntoCategories(){
        $sql = "SELECT * FROM categoria WHERE refcategoria = 1";
        $results = mysql_query($sql, $this->con);
        $categories = array();
        $i=0;
        while ($row = mysql_fetch_array($results)) {
            $cat = $this->dataBase->intoCategories($row,$this->con);
            $categories[$i] = $cat;
            $i = $i +1;
        }
        $this->assertEquals(count($categories),"17");
        $sql2 = "SELECT * FROM categoria WHERE refcategoria = 10";
        $results2 = mysql_query($sql2, $this->con);
        $categories = array();
        $i=0;
        while ($row = mysql_fetch_array($results2)) {
            $cat = $this->dataBase->intoCategories($row,$this->con);
            $categories[$i] = $cat;
            $i = $i +1;
        }
        $this->assertEquals(count($categories),"0");
    }
    
    /**
     * Test that ckeck the method getEstablishmentByCategories. 
     */
    public function testGetEstabByCategories(){
        $arrayCategories = array();
        $arrayCategories[0] = "9";
        $estab = $this->dataBase->getEstablishmentByCategories($arrayCategories,$this->con);
        $this->assertNotNull($estab);
        $this->assertEquals(count($estab),"12");
    }
    
    /**
     * Test that ckeck the method getEstablishment. 
     */
    public function testGetEstablishment(){
        $establishment = $this->dataBase->getEstablishment($this->con);
        $this->assertNotNull($establishment);
        $this->assertEquals(count($establishment),"50");
    }
    
    /**
     * Test that ckeck the method getEstablishmentBySector. 
     */
    public function testGetEstabBySetor(){
        $arraySector = array();
        $arraySector[0] = "2";
        $establishment = $this->dataBase->getEstablishmentBySector($arraySector,$this->con);
        $this->assertNotNull($establishment);
        $this->assertEquals(count($establishment),"3");
    }
    
    /**
     * Test that ckeck the method getEstablishmentBySectorCj. 
     */
    public function testGetEstabBySetorCj(){
        $establishment = $this->dataBase->getEstablishmentBySectorcj($this->con);
        $this->assertNotNull($establishment);
        $this->assertEquals(count($establishment),"39");
    }
    
    /**
     * Test that ckeck the method getEstablishmentInMadrid. 
     */
    public function testGetEstabInMadrid(){
        $establishment = $this->dataBase->getEstablishmentInMadrid($this->con);
        $this->assertNotNull($establishment);
        $this->assertEquals(count($establishment),"7");
    }
    
    /**
     * Test that ckeck the method getEstablishmentByLocality. 
     */
    public function testGetEstabByLocality(){
        $establishment = $this->dataBase->getEstablishmentByLocality("Burgos",$this->con);
        $this->assertNotNull($establishment);
        $this->assertEquals(count($establishment),"14");
    }
    
    /**
     * Test that ckeck the method getEstablishmentById. 
     */
    public function testGetEstablishmentById(){
        $establishment = $this->dataBase->getEstablishmentById("56",$this->con);
        $this->assertNotNull($establishment);
        $this->assertEquals($establishment->getIdEstablishment(),"56");
        $this->assertEquals($establishment->getName(),"FIARE");
    }
    
    /**
     * Test that ckeck the method getIdsImportOrganizationById. 
     */
    public function testGetIdsImpOrgById(){
        $imports = $this->dataBase->getIdsImportOrganizationsById("28",$this->con);
        $this->assertNotNull($imports);
        $this->assertEquals(count($imports),"1");
    }
    /**
     * Test that ckeck the method getIdsRedById. 
     */
    public function testGetIdsRedById(){
        $net = $this->dataBase->getIdsRedById("28",$this->con);
        $this->assertNotNull($net);
        $this->assertEquals(count($net),"2");
    }
    
    /**
     * Test that ckeck the method getIdsProductById.
     */
    public function testGetIdsProductsById(){
        $products = $this->dataBase->getIdsProductsById("65",$this->con);
        $this->assertNotNull($products);
        $this->assertEquals(count($products),2);
    }
    
    /**
     * Test that ckeck the method getCommentsById. 
     */
    public function testGetCommentsById(){
        $comments = $this->dataBase->getCommentsById("28",$this->con);
        $this->assertEquals(count($comments),1);
    }
    
    /**
     * Test that ckeck the method getSector. 
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
     * Test that ckeck the method getProductsById. 
     */
    public function testGetProductsById(){
        $products = $this->dataBase->getProductsById("65",$this->con);
        $this->assertNotNull($products);
        $this->assertEquals(count($products),2);
    }
    
    /**
     * Test that ckeck the method insertComment. 
     */
    public function testInsertComment(){
        $date = date('Y/m/d H:i:s');
        $comments = $this->dataBase->getCommentsById("28",$this->con);
        $num = count($comments);
        $this->dataBase->insertComment("Gadea",$date,"megusta",28,$this->con);
        $comments2 = $this->dataBase->getCommentsById("28",$this->con);
        $this->assertEquals(count($comments2),$num+1);
    }
}
?>