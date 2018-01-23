<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/kaupat', function() {
    HelloWorldController::kaupat();
  });

  $routes->get('/tuotehaku', function() {
    HelloWorldController::tuotehaku();
  });

  $routes->get('/tuotteet', function() {
    HelloWorldController::tuotteet();
  });
