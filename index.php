<?php
// Include class Config
if(!file_exists('config.ini')){
  exit(1);
}

# CORE
require_once('application/core/Controller.php');
require_once('application/core/Model.php');
require_once('application/core/View.php');
require_once('application/core/Logger.php');
require_once('application/core/Config.php');

// Get config
Config::setInstance('config.ini');
Logger::PATH(__DIR__);

// Get Routes
require_once('application/router.php');

# Vendor
require_once ('application/vendor/autoload.php');

// Start script
Router::start(); // запускаем маршрутизатор