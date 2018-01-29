<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('/suunnitelmat/tuotehaku.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
      $kesko = Kauppayhtyma::find(1);
      $kauppayhtymat = Kauppayhtyma::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      Kint::dump($kauppayhtymat);
      Kint::dump($kesko);
    }

    public static function kaupat(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/kaupat.html');
    }

    public static function tuotehaku(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/tuotehaku.html');
    }

    public static function tuotteet(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/tuotteet.html');
    }

    public static function kauppayhtymat(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/kauppayhtymat.html');
    }
  }
