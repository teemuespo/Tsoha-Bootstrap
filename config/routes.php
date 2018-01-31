<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/kaupat', function() {
    HelloWorldController::kaupat();
    KauppaController::index();
  });

  $routes->get('/tuotehaku', function() {
    HelloWorldController::tuotehaku();
  });

  $routes->get('/tuotteet', function() {
    HelloWorldController::tuotteet();
    TuoteController::index();
  });

  $routes->get('/kauppayhtymat', function() {
    HelloWorldController::kauppayhtymat();
    KauppayhtymaController::index();
  });

  $routes->post('/kaupat', function() {
    KauppaController::store();
  });

  $routes->get('/kaupat/uusi', function() {
    HelloWorldController::uusi_kauppa();
  });

  $routes->get('/kauppayhtymat/:id', function($id) {
    KauppayhtymaController::show($id);
  });

  $routes->get('/tuotteet/uusi', function() {
    HelloWorldController::uusi_kauppa();
  });

  $routes->get('/kauppayhtymat/uusi', function() {
    HelloWorldController::uusi_kauppayhtyma();
  });
