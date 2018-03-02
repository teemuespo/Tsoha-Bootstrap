<?php
class OstotapahtumaController extends BaseController{
  public static function uusi_ostotapahtuma(){
    $tuotteet = Tuote::all();
    $kaupat = Kauppa::all();
    View::make('/ostotapahtumat/uusi_ostotapahtuma.html', array('tuotteet' => $tuotteet, 'kaupat' => $kaupat));
  }
  public static function validate_price($hinta) {
      $errors = array();
      if($hinta == '' || $hinta == null) {
        $errors[] = 'Bonus-kenttä ei saa olla tyhjä';
      } else if(!is_numeric($hinta)) {
        $errors[] = 'Bonuksen tulee olla desimaaliluku!';
      }
      return $errors;
  }
  public static function validate_timestamp($ostohetki) {
      $errors = array();
      if($ostohetki == '' || $ostohetki == null) {
        $errors[] = 'Ostohetki-kenttä ei saa olla tyhjä';
      } else if(!($ostohetki instanceof DateTime)) {
        $errors[] = 'Ostohetken tulee olla muodossa YYYY-MM-DD HH:MI:SS!';
      }
      return $errors;
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    $tuotteet = Tuote::all();
    $kaupat = Kauppa::all();
    // Alustetaan uusi Ostotapahtuma-luokan olion käyttäjän syöttämillä arvoilla
    $attributes = array(
      'tuote_id' => $params['tuote_id'],
      'kauppa_id' => $params['kauppa_id'],
      'hinta' => $params['hinta'],
      'ostohetki' => $params['ostohetki']
    );

    $ostotapahtuma = new Ostotapahtuma($attributes);

    $errors = array();
    $errors = array_merge($errors, OstotapahtumaController::validate_price($params['hinta']), OstotapahtumaController::validate_timestamp($params['ostohetki']));

    if(count($errors) == 0) {
      $ostotapahtuma->save();

      Redirect::to('/uusi_ostotapahtuma' , array('message' => 'Ostotapahtuma lisätty onnistuneesti tietokantaan!'));
    } else {
      View::make('ostotapahtumat/uusi_ostotapahtuma.html', array('tuotteet' => $tuotteet, 'kaupat' => $kaupat, 'errors' => $errors, 'attributes' => $attributes));
    }
  }
}  