<?php
class KauppayhtymaController extends BaseController{
  public static function uusi_kauppayhtyma(){
      // Testaa koodiasi täällä
      View::make('/suunnitelmat/kauppayhtymat/uusi_kauppayhtyma.html');
    }
  public static function index(){
    // Haetaan kaikki yhtymat tietokannasta
    $kauppayhtymat = Kauppayhtyma::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppayhtyma.html muuttujan $kauppayhtymat datalla
    View::make('suunnitelmat/kauppayhtymat/kauppayhtymat.html', array('kauppayhtymat' => $kauppayhtymat));
  }
  public static function show($id){
    // Haetaan kaikki kaupat tietokannasta
    $kauppayhtyma = Kauppayhtyma::find($id);
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('suunnitelmat/kauppayhtymat/kauppayhtyma.html', array('kauppayhtyma' => $kauppayhtyma));
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Kauppayhtymä-luokan olion käyttäjän syöttämillä arvoilla
    $kauppayhtyma = new Kauppayhtyma(array(
      'nimi' => $params['nimi'],
      'bonus' => $params['bonus']
    ));
/*
    $errors = $kauppayhtyma->errors();

    if(count($errors) == 0) {   */
      // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
      $kauppayhtyma->save();

      // Ohjataan käyttäjä lisäyksen jälkeen kauppayhtymän esittelysivulle
      Redirect::to('/kauppayhtymat' , array('message' => 'Kauppayhtymä on lisätty tietokantaan!'));
/*    } else {
      View::make('suunnitelmat/kauppayhtymat/uusi_kauppayhtyma.html', array('errors' => $errors, 'attributes' => $attributes));
    } */
  } 
}