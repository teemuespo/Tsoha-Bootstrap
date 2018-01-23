<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function kaupat(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/kaupat.html');
    }

    public static function tuotehaku(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/tuotehaku.html');
    }

    public static function tuotteet(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/tuotteet.html');
    }
  }
