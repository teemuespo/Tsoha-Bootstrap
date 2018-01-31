<?php
class TuoteController extends BaseController{
  public static function index(){
    // Haetaan kaikki tuotteet tietokannasta
    $tuotteet = Tuote::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto tuote.html muuttujan $tuotteet datalla
    Kint::dump($tuotteet)
    View::make('suunnitelmat/tuote.html', array('tuotteet' => $tuotteet));
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Tuote-luokan olion käyttäjän syöttämillä arvoilla
    $tuote = new Tuote(array(
      'nimi' => $params['nimi']
    ));

    Kint::dump($params);

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $tuote->save();

    // Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle
    Redirect::to('/tuotteet/' . $tuote->id, array('message' => 'Tuote on lisätty tietokantaan!'));
  }
  
}