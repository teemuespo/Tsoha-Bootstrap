<?php
class OstotapahtumaController extends BaseController{
  public static function uusi_ostotapahtuma(){
    $tuotteet = Tuote::all();
    $kaupat = Kauppa::all();
    View::make('/ostotapahtumat/uusi_ostotapahtuma.html', array('tuotteet' => $tuotteet, 'kaupat' => $kaupat));
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Ostotapahtuma-luokan olion käyttäjän syöttämillä arvoilla
    $ostotapahtuma = new Ostotapahtuma(array(
      'tuote_id' => $params['tuote_id'],
      'kauppa_id' => $params['kauppa_id'],
      'hinta' => $params['hinta'],
      'ostohetki' => $params['ostohetki']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $ostotapahtuma->save();

    // Ohjataan käyttäjä lisäyksen jälkeen kaupan esittelysivulle
    Redirect::to('/uusi_ostotapahtuma' , array('message' => 'Kauppa on lisätty tietokantaan!'));
  }
}  