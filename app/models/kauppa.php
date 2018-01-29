<?php
class Kauppa extends BaseModel{
    // Attribuutit
    public $id, $nimi, $osoite;
    // Konstruktori
    public function __construct($attributes){
    	parent::__construct($attributes);
    }
}