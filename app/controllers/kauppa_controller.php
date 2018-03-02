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
    $attributes = array(
      'id' => $id,
      'nimi' => $kauppa['nimi'],
      'osoite' => $kauppa['osoite'],
      'kauppayhtyma_id' => $kauppa['kauppayhtyma_id']
    );
    $kauppayhtymat = Kauppayhtyma::all();
    View::make('/kaupat/edit.html', array('attributes' => $attributes, 'kauppayhtymat' => $kauppayhtymat));
  }
  public static function update($id) {
    $params = $_POST;
    $kauppayhtymat = Kauppayhtyma::all();

    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kauppayhtyma_id' => $params['kauppayhtyma_id']
    );

    $kauppa = new Kauppa($attributes);

    $errors = $kauppa->errors();
    $errors = array_merge($errors, KauppaController::validate_address($params['osoite']));

    if(count($errors) == 0) {
      $kauppa->update($id);

      Redirect::to('/kaupat' , array('message' => 'Kauppaa on muokattu onnistuneesti.'));
    } else {
      View::make('kaupat/edit.html', array('errors' => $errors, 'kauppayhtymat' => $kauppayhtymat, 'attributes' => $attributes));
    }
  }
  public static function destroy($id){
    $kauppa = new Kauppa(array('id' => $id));
    $kauppa->destroy($id);

    Redirect::to('/kaupat' , array('message' => 'Kauppa on poistettu onnistuneesti!'));
  }
  public static function show($id){
    // Haetaan kauppa ja kaikki kyseisessä kaupassa tehdyt ostokset tietokannasta
    $kauppa = Kauppa::find($id);
    $ostot = Ostotapahtuma::kaupalla($id);
    // Renderöidään views/suunnitelmat kansiossa sijaitseva tiedosto kauppa.html muuttujan $kaupat datalla
    View::make('/kaupat/kauppa.html', array('kauppa' => $kauppa, 'ostot' => $ostot));
  }
  public static function validate_address($osoite) {
      $errors = array();
      if($osoite == null || $osoite == '') {
        $errors[] = 'Osoite-kenttä ei saa olla tyhjä!';
      }
      else if(strlen($osoite) < 10) {
        $errors[] = 'Osoitteen pituuden tulee olla vähintään  10 merkkiä. Muistathan lisätä kaupungin!';
      }
      return $errors;
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    $kauppayhtymat = Kauppayhtyma::all();
    
    $attributes = array(
      'nimi' => $params['nimi'],
      'osoite' => $params['osoite'],
      'kauppayhtyma_id' => $params['kauppayhtyma_id']
    );

    $kauppa = new Kauppa($attributes);

    $errors = $kauppa->errors();
    $errors = array_merge($errors, KauppaController::validate_address($params['osoite']));

    if(count($errors) == 0) {
      $kauppa->save();

      Redirect::to('/kaupat' , array('message' => 'Kauppa on lisätty tietokantaan!'));
    } else {
      View::make('kaupat/uusi_kauppa.html', array('errors' => $errors, 'kauppayhtymat' => $kauppayhtymat, 'attributes' => $attributes));
    }
  }  
}