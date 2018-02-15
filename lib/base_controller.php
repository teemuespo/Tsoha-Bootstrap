<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Katsotaan onko user-avain sessiossa
      if(isset($_SESSION['admin'])){
        $admin_id = $_SESSION['admin'];
        // Pyydetään Admin-mallilta käyttäjä session mukaisella id:llä
        $admin = Admin::find($admin_id);

        return $admin;
      }

      // Käyttäjä ei ole kirjautunut sisään
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
      if(!isset($_SESSION['admin'])){
      Redirect::to('/kirjaudu', array('message' => 'Kirjaudu ensin sisään!'));
    }
    }

  }
