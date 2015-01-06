<?php
include_once ("../init.php");
if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

/**
 * Class responsible for communicating with the class database.
 * 
 * @author Gadea Hidalgo López
 * 
 * @version 1.0
 * 
 */
class Load{
    
        /**
         * Static method that returns all categories of the top level.
         * 
         * @return array of categories
         */
        public static function loadAllCategories(){
            $dataBase = new dataBase();
            $alltc = array();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            
            $categories = $dataBase->getCategories($con);
            foreach($categories as $category){
                $i = 0;
                    $allc = Load::fillCategories($category,null,$i);
                foreach($allc AS $a){
                    $alltc[] = $a;
                }
                
            }
            
            $dataBase->disconnectDataBase($con);
            return $alltc;
        }
        
        /**
         * Static method that load all subcategories.
         * 
         * @param category the category
         * @param categoryFather the reference of category
         */
        public static function fillCategories($category,$categoryFather,$i){
            $dataBase = new dataBase();
            $arrayAllCategories = array();
            $con2 = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $subcategories = $dataBase->getSubCategories($category->getIdCategory(), $con2);
                   
               if(count($subcategories)!=0){
              
                        $arrayAllCategories[] = $i.";".$category->getIdCategory().";".$category->getName();
                     
                                    $j = $i+1;
                    foreach($subcategories as $subcategory){
                        $afill = array();
                        $afill = Load::fillCategories($subcategory,$category,$j);
                        foreach($afill AS $af){
                            $arrayAllCategories[] =  $af;
                        }
                    }
                 
                    
                }else{
                    $arrayAllCategories[] = $i.";".$category->getIdCategory().";".$category->getName();
                   
                }
                
                return $arrayAllCategories;
        }
        
        /**
         * Static method that returns all comments of the id of establishment.
         * 
         * @param id the id of establishment
         * 
         * @return comments the array of comments
         */
        public static function getComments($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getCommentsById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
                /**
         * Static method that returns all comments of the id of event.
         * 
         * @param id the id of event
         * 
         * @return comments the array of comments
         */
        public static function getEventsComments($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getEventCommentsById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

        
        
        
        /**
         * Static method that returns import organizations of establishment.
         * 
         * @param establishment
         * 
         * @return string with imports organizations separated by comas. 
         */
        public static function loadImportOrganizationByEstablishment($establishment){
            $arrayIds = "";
            $arrayIds =  $establishment->getImportOrganizations();
            $allimport = "";
            if(count($arrayIds)>0){
                $dataBase = new dataBase();
                $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
                $importOrganization = $dataBase->getImportOrganizationById($arrayIds, $con);
                foreach($importOrganization AS $imp){
                    $allimport .= $imp->getName();
                    $allimport .= " ,";
                }
                $allimport = substr($allimport, 0, -1);
            }
            return $allimport;
        }
        
        /**
         * Method to scape the special character.
         * 
         * @param string with special characteres
         * 
         * @return strf string without characters.
         */
         public static function replace($strf){
            $strf = str_replace("á","a",$strf);
            $strf = str_replace('à','a',$strf);
            $strf = str_replace("é","e",$strf);
            $strf = str_replace('è','e',$strf);
            $strf = str_replace("í","i",$strf);
            $strf = str_replace('ì','i',$strf);
            $strf = str_replace("ó","o",$strf);
            $strf = str_replace('ò','o',$strf);
            $strf = str_replace("ú","u",$strf);
            $strf = str_replace('ù','u',$strf);
           
            $strf = str_replace("Á","A",$strf);
            $strf = str_replace('À','A',$strf);
            $strf = str_replace("É","E",$strf);
            $strf = str_replace('È','E',$strf);
            $strf = str_replace("Í","I",$strf);
            $strf = str_replace('Ì','I',$strf);
            $strf = str_replace("Ó","O",$strf);
            $strf = str_replace('Ò','O',$strf);
            $strf = str_replace("Ú","U",$strf);
            $strf = str_replace('Ù','U',$strf);
        
            $strf = str_replace("ñ","N",$strf);
            $strf = str_replace('Ñ','N',$strf);
            
            return $strf;
         }
        
        /**
         * Static method that returns the network of establishment
         * 
         * @param establishment
         * 
         * @return string with networks separated by comas.
         */
        public static function loadNetworkByEstablishment($establishment){
            $arrayIds = "";
            $arrayIds =  $establishment->getReds();
            $allnetwork = "";
            if(count($arrayIds)>0){
                $dataBase = new dataBase();
                $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
                $network = $dataBase->getNetworkById($arrayIds, $con);
                $allnetwork = "";
                foreach($network AS $n){
                    $allnetwork .= $n->getName();
                    $allnetwork .= " ,";
                }
                $allnetwork = substr($allnetwork, 0, -1);
            }
            return $allnetwork;
        }
        
        /**
         * Static method that returns the products of establishmentid.
         * 
         * @param id establishment id
         * 
         * @return products array of products
         */
        public static function getProducts($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $products = $dataBase->getProductsById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $products;
        }
        
        /**
         * Static method that returns all sector included in the database.
         * 
         * @return sectors array of sector
         */
        public static function loadSector(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $sectors = $dataBase->getSector($con);
            $dataBase->disconnectDataBase($con);
            return $sectors;
        }
        
        public static function insertAcceso($idioma){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->insertAcceso($idioma,$con);
            $dataBase->disconnectDataBase($con);
        }
        
        public static function insertBusqueda($idobjeto, $tipo){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->insertBusqueda($idobjeto,$tipo,$con);
            $dataBase->disconnectDataBase($con);
        }


   }
?>