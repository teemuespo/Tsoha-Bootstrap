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
  public static function validate_bonus($bonus) {
      $errors = array();
      if(!(is_numeric($bonus) || $bonus == null)) {
        $errors[] = 'Bonuksen tulee olla desimaaliluku!';
      }
      return $errors;
  }
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Kauppayhtymä-luokan olio käyttäjän syöttämillä arvoilla
    $attributes = array(
      'nimi' => $params['nimi'],
      'bonus' => $params['bonus']
    );

    $kauppayhtyma = new Kauppayhtyma($attributes);

    $errors = $kauppayhtyma->errors();
    $errors = array_merge($errors, KauppayhtymaController::validate_bonus($params['bonus']));

    if(count($errors) == 0) {
      $kauppayhtyma->save();

      Redirect::to('/kauppayhtymat' , array('message' => 'Kauppayhtymä on lisätty tietokantaan!'));
    } else {
      View::make('kauppayhtymat/uusi_kauppayhtyma.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  } 
  public static function destroy($id){
    $kauppayhtyma = new Kauppayhtyma(array('id' => $id));
    $kauppayhtyma->destroy($id);

    Redirect::to('/kauppayhtymat' , array('message' => 'Kauppayhtyma on poistettu onnistuneesti!'));
  }
  public static function edit($id) {
    $kauppayhtyma = Kauppayhtyma::find($id);
    $attributes = array(
      'id' => $id,
      'nimi' => $kauppayhtyma->nimi,
      'bonus' => $kauppayhtyma->bonus
    );
    View::make('/kauppayhtymat/edit.html', array('attributes' => $attributes));
  }
  public static function update($id) {
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'nimi' => $params['nimi'],
      'bonus' => $params['bonus']
    );

    $kauppayhtyma = new Kauppayhtyma($attributes);

    $errors = $kauppayhtyma->errors();
    $errors = array_merge($errors, KauppayhtymaController::validate_bonus($params['bonus']));

    if(count($errors) == 0) {
      $kauppayhtyma->update($id);

      Redirect::to('/kauppayhtymat' , array('message' => 'Kauppayhtymää on muokattu onnistuneesti.'));
    } else {
      View::make('kauppayhtymat/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }
}