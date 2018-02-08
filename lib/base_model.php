<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
      //$this->validators = array('validate_string_length');
    }
/*
    public function validate_string_length($string) {
      if($string == null) {
        return 'Kenttä ei saa olla tyhjä!';
      }
      else if(strlen($string) < 2) {
        return 'Kentän pituuden tulee olla vähintään  2 merkkiä!';
      }
      return null;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        array_push($errors, $validator());
      }

      return $errors;
    }
*/
  }
