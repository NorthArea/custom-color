<?php
// PHP Errors
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('php_flag html_errors on', true);
ini_set('log_errors', false);
ini_set('error_log', __DIR__);

// PHP Errors Class Logger
require_once(__DIR__.'/application/modules/logger.php');
define('LOGGER', true); // Logger
define('LOGGER_PRINT', true); // Logger echo
define('LOGGER_PATH', __DIR__); // Logger path

// Default template
define('TEMPLATE', 'template.php');

/**
Module:
*/

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