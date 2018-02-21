<?php
class KauppayhtymaController extends BaseController{
  public static function uusi_kauppayhtyma(){
      // Testaa koodiasi täällä
      View::make('/kauppayhtymat/uusi_kauppayhtyma.html');
    }
  public static function index(){
    // Haetaan kaikki yhtymat tietokannasta
    $kauppayhtymat = Kauppayhtyma::all();
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppayhtyma.html muuttujan $kauppayhtymat datalla
    View::make('/kauppayhtymat/kauppayhtymat.html', array('kauppayhtymat' => $kauppayhtymat));
  }
  public static function show($id){
    // Haetaan kaikki kaupat tietokannasta
    $kauppayhtyma = Kauppayhtyma::find($id);
    $kaupat = Kauppayhtyma::kaupat($id);
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('/kauppayhtymat/kauppayhtyma.html', array('kauppayhtyma' => $kauppayhtyma, 'kaupat' => $kaupat));
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
  public static function destroy($id){
    $kauppayhtyma = new Kauppayhtyma(array('id' => $id));
    $kauppayhtyma->destroy($id);

    Redirect::to('/kauppayhtymat' , array('message' => 'Kauppayhtyma on poistettu onnistuneesti!'));
  }
  public static function edit($id) {
    $kauppayhtyma = Kauppayhtyma::find($id);
    View::make('/kauppayhtymat/edit.html', array('kauppayhtyma' => $kauppayhtyma));
  }
  public static function update($id) {
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'bonus' => $params['bonus']
    );

    $kauppayhtyma = new Kauppayhtyma($attributes);

    $kauppayhtyma->update($id);

    Redirect::to('/kauppayhtymat' , array('message' => 'Kauppayhtymää on muokattu onnistuneesti!'));
  }
}