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
 * @author Javier López Martínez
 * 
 * @version 2.0
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
        
        public static function loadEstablishmentByUserId($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $establishment = $dataBase->getEstablishmentByIdUser($id,$con);
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
            $categories = $dataBase->getCategories($con);
            $dataBase->disconnectDataBase($con);
            return $categories;   
        }
        
         public static function loadAllCat(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $categories = $dataBase->getAllCat($con);
            $dataBase->disconnectDataBase($con);
            return $categories;   
        }
        
       public static function loadSubCategories($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $categories = $dataBase->getSubCategories($id,$con);
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
        
         /**
         * Static method that returns all events included in the database.
         * 
         * @return array of events 
         */
        public static function loadAllEvents(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $event = $dataBase->getAllEvents($con);
            $dataBase->disconnectDataBase($con);
            return $event;
        }
        
         /**
         * Static method that returns all events included in the database.
         * 
         * @return array of events 
         */
        public static function loadEventById($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $event = $dataBase->getEventById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $event;
        }
        

        
        
       /**
         * Static method that returns events included in the database by id of establishment.
         * 
         * @return array of events 
         */
        public static function loadAllEventsByEstablishmentId($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $event = $dataBase->getAllEventsByEstablishmentId($id,$con);
            $dataBase->disconnectDataBase($con);
            return $event;
        }

		public static function eventType($id){
                       
            $array=array("","Charla/conferencia","Videoforum","Presentación de libro","Encuentro con productores","Exposición","Actividad infantil","Degustación de productos","Taller formativo","Manifestación");
                        
            return $array[$id];
        }
        
        
        public static function notifType($id){
                       
            $array=array("-- Seleccione uno --","Nueva solicitud de usuario establecimiento","Nuevo establecimiento dado de alta","Nuevo producto dado de alta",
							"Nuevo evento introducido","Nuevo comentario");                      
           if($id==0){
             return $array;
           }else{
			 return $array[$id];
			}
        }
        
        //importador
        
        public static function insertImportador($name){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->insertImportador($name,$con);
            $dataBase->disconnectDataBase($con);
        }
        
        public static function updateImportador($id,$name){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->updateImportador($id,$name,$con);
            $dataBase->disconnectDataBase($con);
        }

		public static function deleteImportador($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $event = $dataBase->deleteImportador($id,$con);
            $dataBase->disconnectDataBase($con);
            return $event;
        }
        
        
        
        //tipo

        public static function insertTipo($name){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->insertTipo($name,$con);
            $dataBase->disconnectDataBase($con);
        }
       
       public static function updateTipo($id,$name){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->updateTipo($id,$name,$con);
            $dataBase->disconnectDataBase($con);
        }

		public static function deleteTipo($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $event = $dataBase->deleteTipo($id,$con);
            $dataBase->disconnectDataBase($con);
            return $event;
        }

        //CATEGORIAS
        
        public static function insertCat($name,$refcategoria){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->insertCat($name,$refcategoria,$con);
            $dataBase->disconnectDataBase($con);
        }
       
       public static function updateCat($id,$name,$refcategoria){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $dataBase->updateCat($id,$name,$refcategoria,$con);
            $dataBase->disconnectDataBase($con);
        }

		public static function deleteCat($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $event = $dataBase->deleteCat($id,$con);
            $dataBase->disconnectDataBase($con);
            return $event;
        }
        
        

        //NOTIFICACIONES
        
        public static function loadCommentNew(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getCommentsNew($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
        public static function loadEventsNew(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getEventsNew($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        

        public static function loadEstNew(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getEstablishmentNew($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

 	
 	    public static function loadUserNew(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getUserNew($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

 	    public static function loadProdNew(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getProductsNew($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
       public static function loadProdMes(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getProductsMes(date("m"),date("Y"),$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

        
        public static function loadUserMes(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getUserMes(date("m"),date("Y"),$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
        public static function loadEstMes(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getEstablishmentMes(date("m"),date("Y"),$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

        public static function loadEventsMes(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getEventsMes(date("m"),date("Y"),$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

        public static function loadCommentMes(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getCommentsMes(date("m"),date("Y"),$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
        //estadisticas
        
       public static function obtenerAnoMes($mes,$ano){
       		if($mes!=1){
       			return array($mes-1,$ano);
       		}else{
       			return array(12,$ano-1);
       		}
       }
        
       public static function loadCommentStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getCommentsMes($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

	   public static function loadProductsStats(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $products = $dataBase->getProductsStats($con);
            $dataBase->disconnectDataBase($con);
            return $products;
        }
        
       public static function loadUserStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $products = $dataBase->getUsersStats($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $products;
        }

		public static function loadEventsStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getEventStats($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
        public static function loadEstStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getEstablishmentStats($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
       	public static function loadProdStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getProdStats($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

       	public static function loadComentStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getCommentStats($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

       	public static function loadComentsStats(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getAllCommentStats($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
        public static function loadAccesosStats(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getAccesosStats($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

        public static function loadAccesoStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getAccesoStats($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

        public static function loadBusquedasStats(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getBusqedasStats($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }
        
        public static function loadBusquedaStats($mes,$ano){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getBusqedaStats($mes,$ano,$con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }


 		public static function getAllUsers(){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $comments = $dataBase->getUsers($con);
            $dataBase->disconnectDataBase($con);
            return $comments;
        }

       public static function loadProductById($id){
            $dataBase = new dataBase();
            $con = $dataBase->ConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
            $products = $dataBase->getProductById($id,$con);
            $dataBase->disconnectDataBase($con);
            return $products;
        }

        
   }
?>