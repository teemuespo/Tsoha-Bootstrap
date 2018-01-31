<?php
class KauppaController extends BaseController{
  public static function index(){
    // Haetaan kaikki kaupat tietokannasta
    $kaupat = Kauppa::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('suunnitelmat/kauppa.html', array('kaupat' => $kaupat));
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Kauppa-luokan olion käyttäjän syöttämillä arvoilla
    $kauppa = new Kauppa(array(
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kauppayhtyma' => $params['kauppayhtyma']
    ));

    Kint::dump($params);

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $kauppa->save();

    // Ohjataan käyttäjä lisäyksen jälkeen kaupan esittelysivulle
    Redirect::to('/kaupat/' . $kauppa->id, array('message' => 'Kauppa on lisätty tietokantaan!'));
  }
  
}