<?php
ini_set('display_errors', 1);
require_once 'application/logger.php';
Logger::$PATH = dirname(__FILE__);
require_once 'application/views/view.php';
require_once 'application/route.php';
Route::start(); // запускаем маршрутизатор