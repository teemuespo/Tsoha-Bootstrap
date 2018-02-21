<?php
class KauppaController extends BaseController{
  public static function uusi_kauppa(){
    $kauppayhtymat = Kauppayhtyma::all();
    View::make('/kaupat/uusi_kauppa.html', array('kauppayhtymat' => $kauppayhtymat));
  }
  public static function index(){
    // Haetaan kaikki kaupat tietokannasta
    $kaupat = Kauppa::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('/kaupat/kaupat.html', array('kaupat' => $kaupat));
  }
  public static function edit($id) {
    $kauppa = Kauppa::find($id);
    $kauppayhtymat = Kauppayhtyma::all();
    View::make('/kaupat/edit.html', array('kauppa' => $kauppa, 'kauppayhtymat' => $kauppayhtymat));
  }
  public static function update($id) {
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kauppayhtyma_id' => $params['kauppayhtyma_id']
    );

    $kauppa = new Kauppa($attributes);

    $kauppa->update($id);

    Redirect::to('/kaupat' , array('message' => 'Kauppaa on muokattu onnistuneesti!'));
  }
  public static function destroy($id){
    $kauppa = new Kauppa(array('id' => $id));
    $kauppa->destroy($id);

    Redirect::to('/kaupat' , array('message' => 'Kauppa on poistettu onnistuneesti!'));
  }

  public static function show($id){
    // Haetaan kaikki kaupat tietokannasta
    $kauppa = Kauppa::find($id);
    $ostot = Ostotapahtuma::kaupalla($id);
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('/kaupat/kauppa.html', array('kauppa' => $kauppa, 'ostot' => $ostot));
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Kauppa-luokan olion käyttäjän syöttämillä arvoilla
    $kauppa = new Kauppa(array(
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kauppayhtyma_id' => $params['kauppayhtyma_id']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $kauppa->save();

    // Ohjataan käyttäjä lisäyksen jälkeen kaupan esittelysivulle
    Redirect::to('/kaupat' , array('message' => 'Kauppa on lisätty tietokantaan!'));
  }
  
}