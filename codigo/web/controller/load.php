<?php

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
         * Static method that returns the establishments of userid.
         * 
         * @param id user id
         * 
         * @return array of establishment
         */
        public static function loadEstablishmentByIdUser($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $establishment = $dataBase->getEstablishmentByIdUser($id,$con);
            $dataBase->disconnectDataBase($con);
            return $establishment;
            
        }
        
        /**
         * Static method that returns the establishments of establishmentid.
         * 
         * @param id establishment id
         * 
         * @return establishment
         */
        public static function loadEstablishmentById($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $establishment = $dataBase->getEstablishmentById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $establishment;
            
        }
        
        /**
         * Static method that returns all establishment included in the database.
         * 
         * @return array of establishments 
         */
        public static function loadAllEstablishment(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $establishment = $dataBase->getAllEstablishment($con);
            $dataBase->disconnectDataBase($con);
            return $establishment;
        }
        
        /**
         * Static method that returns the iduser of establishment.
         * 
         * @return id the id 
         */
        public static function loadUserEstablishment($idEstablishment){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $id = $dataBase->getRefUserEstablishment($idEstablishment,$con);
            $dataBase->disconnectDataBase($con);
            return $id;
        }
        
        
        /**
         * Static method that returns all categories of the top level.
         * 
         * @return array of categories
         */
        public static function loadCategories(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $categories = $dataBase->getAllCategories($con);
            $dataBase->disconnectDataBase($con);
            return $categories;   
        }
        
        /**
         * Static method that returns all sector included in the database.
         * 
         * @return array of sector
         */
        public static function loadSector(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $sector = $dataBase->getSector($con);
            $dataBase->disconnectDataBase($con);
            return $sector;   
        }
        
        /**
         * Static method that returns all type included in the database.
         * 
         * @return array of type
         */
        public static function loadType(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $type = $dataBase->getType($con);
            $dataBase->disconnectDataBase($con);
            return $type;   
        }
        
        /**
         * Static method that returns all import organization included in the database.
         * 
         * @return array of import organization
         */
        public static function loadImportOrganization(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $importOrganization = $dataBase->getImportOrganization($con);
            $dataBase->disconnectDataBase($con);
            return $importOrganization;   
        }
        
        /**
         * Static method that returns all network included in the database.
         * 
         * @return array of network
         */
        public static function loadNetwork(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $network = $dataBase->getNetwork($con);
            $dataBase->disconnectDataBase($con);
            return $network;   
        }
        
        /**
         * Static method that returns the products of establishmentid.
         * 
         * @param id establishment id
         * 
         * @return array of products
         */
        public static function loadProductsEstablishment($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $products = $dataBase->getProductsById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $products;
        }
        
        /**
         * Static method that returns unvalidated users.
         * 
         * @return array of users
         */
        public static function loadUserNoValid(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $users = $dataBase->getUserNoValid($con);
            $dataBase->disconnectDataBase($con);
            return $users;
        }
        
        /**
         * Static method that returns validated users.
         * 
         * @param id id of admin
         * 
         * @return array of users
         */
        public static function loadUserValid($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $users = $dataBase->getUserValid($id,$con);
            $dataBase->disconnectDataBase($con);
            return $users;
        }
        
        /**
         * Static method that returns validated users without admins.
         * 
         * @return array of users
         */
        public static function loadUserValidNoAdmin(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $users = $dataBase->getUserValidNoAdmin($con);
            $dataBase->disconnectDataBase($con);
            return $users;
        }
        
        /**
         * Static method that returns the user of userid
         * 
         * @param id user id
         * 
         * @return user
         */
        public static function loadUserById($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $user = $dataBase->getUserById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $user;
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
         * Static method that returns comments of the establishmentid.
         * 
         * @param id of establishment
         * 
         * @return array of comments.
         */
        public static function loadCommentByIdEstablishment($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getCommentsById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
   }
?>