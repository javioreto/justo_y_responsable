<?php

class ImportOrganization{
            
    private $idimportorganization;
    private $name;

    function ImportOrganization($idimportorganization, $name){
        $this->idimportorganization = $idimportorganization;
        $this->name = $name;
    }
    
    function getIdImportOrganization(){
        return $this->idimportorganization;
    }
    
    function setIdImportOrganization($val){
        $this->idimportorganization = $val;
    }
    
    function getName(){
        return $this->name;
    }
    
    function setName($val){
        $this->name = $val;
    }
        
}

?>