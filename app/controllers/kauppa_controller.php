<?php
class KauppaController extends BaseController{
  public static function uusi_kauppa(){
      View::make('/suunnitelmat/kaupat/uusi_kauppa.html');
    }
  public static function index(){
    // Haetaan kaikki kaupat tietokannasta
    $kaupat = Kauppa::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('suunnitelmat/kaupat/kaupat.html', array('kaupat' => $kaupat));
  }
  public static function edit($id) {
    $kauppa = Kauppa::find($id);
    View::make('suunnitelmat/kaupat/edit.html', array('attributes' => $kauppa));
  }
  public static function update($id) {
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kauppayhtyma_id' => $params['kauppayhtyma']
    );

    $kauppa = new Kauppa($attributes);

    $kauppa->update($id);

    Redirect::to('/kaupat/' , $kauppa->id, array('message' => 'Kauppaa on muokattu onnistuneesti!'));
  }
  public static function destroy($id){
    $kauppa = new Kauppa(array('id' => $id));
    $kauppa->destroy($id);

    Redirect::to('/kaupat/' , $kauppa->id, array('message' => 'Kauppa on poistettu onnistuneesti!'));
  }

  public static function show($id){
    // Haetaan kaikki kaupat tietokannasta
    $kauppa = Kauppa::find($id);
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('suunnitelmat/kaupat/kauppa.html', array('kauppa' => $kauppa));
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

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $kauppa->save();

    // Ohjataan käyttäjä lisäyksen jälkeen kaupan esittelysivulle
    Redirect::to('/kaupat/' . $kauppa->id, array('message' => 'Kauppa on lisätty tietokantaan!'));
  }
  
}