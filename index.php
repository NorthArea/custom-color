<?php
// PHP Errors
ini_set('display_errors', true);
// Default template
define('TEMPLATE', 'template.php');

/**
Module:
*/

// Logger
require_once(__DIR__.'/application/modules/logger.php');
define('LOGGER', true); // Logger
define('LOGGER_PATH', __DIR__); // Logger path
define('LOGGER_PRINT', true); // Logger echo

// Google Drive vendor
require_once __DIR__.'/application/modules/google/api.php';
define('CREDENTIALS',__DIR__.'/application/modules/google/credentials.json');  // Credentials
define('TOKEN',__DIR__.'/application/modules/google/token.json');  // Token


//Core:
require_once __DIR__.'/application/core/model.php';
require_once __DIR__.'/application/core/view.php';
require_once __DIR__.'/application/core/controller.php';
require_once __DIR__.'/application/core/route.php';

// Start scritp
Route::start();