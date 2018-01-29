<?php
class KauppayhtymaController extends BaseController{
  public static function index(){
    // Haetaan kaikki yhtymat tietokannasta
    $kauppayhtymat = Kauppayhtyma::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppayhtyma.html muuttujan $kauppayhtymat datalla
    View::make('suunnitelmat/kauppayhtymat.html', array('kauppayhtymat' => $kauppayhtymat));
  }
}