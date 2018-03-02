<?php
class TuoteController extends BaseController{
  public static function tuotehaku(){
    View::make('/tuotteet/tuotehaku.html');
  }
  public static function uusi_tuote(){
      View::make('/tuotteet/uusi_tuote.html');
    }
  public static function index(){
    // Haetaan kaikki tuotteet tietokannasta
    $tuotteet = Tuote::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto tuote.html muuttujan $tuotteet datalla
    View::make('/tuotteet/tuotteet.html', array('tuotteet' => $tuotteet));
  }
  public static function destroy($id){
    $tuote = new Tuote(array('id' => $id));
    $tuote->destroy($id);

    Redirect::to('/tuotteet' , array('message' => 'Tuote on poistettu onnistuneesti!'));
  }
  public static function show($id){
    // Haetaan kaikki ostot kyseisestä tuotteesta tietokannasta
    $tuote = Tuote::find($id);
    $ostot = Ostotapahtuma::tuotteella($id);
    // Renderöidään views/suunnitelmat/tuotteet kansiossa sijaitseva tiedosto tuote.html muuttujan $ostot datalla
    View::make('/tuotteet/tuote.html', array('tuote' => $tuote, 'ostot' => $ostot));
  }
  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Tuote-luokan olion käyttäjän syöttämillä arvoilla
    $attributes = array(
      'nimi' => $params['nimi']
    );

    $tuote = new Tuote($attributes);

    $errors = array();
    array_push($errors, $tuote->errors());
    //$errors = array_merge($errors, );

    if(count($errors) == 0) {
      $tuote->save();

      Redirect::to('/tuotteet' , array('message' => 'Tuote on lisätty tietokantaan!'));
    } else {
      View::make('suunnitelmat/tuotteet/uusi_tuote.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }
}