<?php
class Tuote extends BaseModel{
    // Attribuutit
    public $id, $nimi
    // Konstruktori
    public function __construct($attributes){
    	parent::__construct($attributes);
    }
}