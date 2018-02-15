<?php
class KirjautumisController extends BaseController{
  public static function login(){
      View::make('/kirjautuminen/login.html');
  }
  public static function handle_login(){
    $params = $_POST;

    $admin = Admin::kirjaudu($params['username'], $params['password']);

    if(!$admin){
      View::make('kirjautuminen/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION['username'] = $admin->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $admin->username . '!'));
    }
  }
  public static function logout(){
    $_SESSION['admin'] = null;
    Redirect::to('/kirjaudu', array('message' => 'Olet kirjautunut ulos!'));
  }
}