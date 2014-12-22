<?php

/**
 * Class Establishment
 * 
 * @author Javier López Martínez
 * 
 * @version 2.0
 */
class Event{
    
    private $idEvento;
	private $descripcion;
	private $direccion;
	private $localidad;
	private $cp;
	private $fecha;
	private $inicio;
	private $fin;
	private $fecha_creacion;
	private $nombre;
	private $longitud;
	private $latitud;
	private $validado;
	private $idTipo;
	private $idEstablecimiento;
	
    /**
     * Constructor
    */
    
	function Event($idEvento, $descripcion, $direccion,$localidad,$cp,$fecha,$inicio, $fin,
	$fecha_creacion,$nombre,$longitud,$latitud,$validado,$idTipo,$idEstablecimiento){
	    
		$this-> idEvento=$idEvento;
		$this-> descripcion=$descripcion;
		$this-> direccion=$direccion;
		$this-> localidad=$localidad;
		$this-> cp=$cp;
		$this-> fecha=$fecha;
		$this-> inicio=$inicio;
		$this-> fin=$fin;
		$this-> fecha_creacion=$fecha_creacion;
		$this-> nombre=$nombre;
		$this-> longitud=$longitud;
		$this-> latitud=$latitud;
		$this-> validado=$validado;
		$this-> idTipo=$idTipo;
		$this-> idEstablecimiento=$idEstablecimiento;				    
    }
    
    /** Métodos get */
    
    function getidEvento(){ return $this->idEvento; }
	function getdescripcion(){ return $this->descripcion; }
	function getdireccion(){ return $this->direccion; }
	function getlocalidad(){ return $this->localidad; }
	function getcp(){ return $this->cp; }
	function getfecha(){ return $this->fecha; }
	function getinicio(){ return $this->inicio; }
	function getfin(){ return $this->fin; }
	function getfecha_creacion(){ return $this->fecha_creacion; }
	function getnombre(){ return $this->nombre; }
	function getlongitud(){ return $this->longitud; }
	function getlatitud(){ return $this->latitud; }
	function getvalidado(){ return $this->validado; }
	function getidTipo(){ return $this->idTipo; }
	function getidEstablecimiento(){ return $this->idEstablecimiento; }
	
	/** Métodos set */
	
	function setidEvento($val){  $this->idEvento=$val; }
	function setdescripcion($val){  $this->descripcion=$val; }
	function setdireccion($val){  $this->direccion=$val; }
	function setlocalidad($val){  $this->localidad=$val; }
	function setcp($val){  $this->cp=$val; }
	function setfecha($val){  $this->fecha=$val; }
	function setinicio($val){  $this->inicio=$val; }
	function setfin($val){  $this->fin=$val; }
	function setfecha_creacion($val){  $this->fecha_creacion=$val; }
	function setnombre($val){  $this->nombre=$val; }
	function setlongitud($val){  $this->longitud=$val; }
	function setlatitud($val){  $this->latitud=$val; }
	function setvalidado($val){  $this->validado=$val; }
	function setidTipo($val){  $this->idTipo=$val; }
	function setidEstablecimiento($val){  $this->idEstablecimiento=$val; }
		
}

?>