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
      $this->validators = array('validate_name');
    }

    public function validate_name() {
      $errors = array();
      if($this->nimi == null || $this->nimi == '') {
        $errors[] = 'Nimi-kenttä ei saa olla tyhjä!';
      }
      else if(strlen($this->nimi) < 2) {
        $errors[] = 'Nimen pituuden tulee olla vähintään  2 merkkiä!';
      }
      return $errors;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $validate_name = 'validate_name';

      $errors = array();
      $errors = array_merge($errors, $this->{$validate_name}());

      /*foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      }*/

      return $errors;
    }

  }
