<?php

class HelloWorldController extends BaseController{

  public static function index(){
    // make-metodi renderöi app views-kansiossa sijaitsevia tiedostoja
 	  View::make('tuotteet/tuotteet.html');
  }

  public static function sandbox(){
    // Testaa koodiasi täällä
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    /*$kintkauppa = new Kauppa(array(
      'nimi' => 'k',
      'osoite' => '',
      'kauppayhtyma_id' => null
    ));
    $errors = $kintkauppa->errors();  
    Kint::dump($errors);*/
    View::make('helloworld.html');
  }
}