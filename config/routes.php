<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/kauppayhtymat', function() {
    KauppayhtymaController::index();
  });

  $routes->get('/kauppayhtymat/uusi', function() {
    KauppayhtymaController::uusi_kauppayhtyma();
  });

  $routes->post('/kauppayhtymat', function() {
    KauppayhtymaController::store();
  });

  $routes->get('/kauppayhtymat/:id', function($id) {
    KauppayhtymaController::show($id);
  });

  $routes->get('/kaupat', function() {
    KauppaController::index();
  });

  $routes->post('/kaupat', function() {
    KauppaController::store();
  });

  $routes->get('/kaupat/uusi', function() {
    KauppaController::uusi_kauppa();
  });

  $routes->get('/kaupat/:id', function($id) {
    KauppaController::show($id);
  });

  $routes->get('/kaupat/:id/muokkaa', function($id){
    KauppaController::edit($id);
  });

  $routes->post('/kaupat/:id/muokkaa', function($id){
    KauppaController::update($id);
  });

  $routes->post('/kaupat/:id/poista', function($id){
    KauppaController::destroy($id);
  });

  $routes->get('/tuotehaku', function() {
    TuoteController::tuotehaku();
  });

  $routes->get('/tuotteet', function() {
    TuoteController::index();
  });

  $routes->post('/tuotteet', function() {
    TuoteController::store();
  });

  $routes->get('/tuotteet/uusi', function() {
    TuoteController::uusi_tuote();
  });

  $routes->get('/tuotteet/:id', function($id) {
    TuoteController::show($id);
  });

  $routes->post('/tuotteet/:id/poista', function($id){
    KauppaController::destroy($id);
  });

  $routes->get('/uusi_ostotapahtuma', function() {
    OstotapahtumaController::uusi_ostotapahtuma();
  });

  $routes->post('/uusi_ostotapahtuma', function() {
    OstotapahtumaController::store();
  });

  $routes->get('/kirjaudu', function(){
    // Kirjautumislomakkeen esittäminen
    KirjautumisController::login();
  });

  $routes->post('/kirjaudu', function(){
    // Kirjautumisen käsittely
    KirjautumisController::handle_login();
  });
