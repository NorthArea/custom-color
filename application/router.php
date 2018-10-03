<?php
class Router{
  
	static function start(){

    $klein = new \Klein\Klein();
    // Routes
    // Index(MainController) & index action
    $klein->respond('GET', '/', function(){
      include('application/controllers/MainController.php');
      include('application/models/GoogleDrive.php');
      $MainController = new MainController;
      $MainController->index();
    });
    
    $klein->respond('POST', '/', function($request, $response){
      include('application/controllers/MainController.php');
      include('application/models/GoogleDrive.php');
      $MainController = new MainController;
      $MainController->download($request->params());
    });
    
    // 404
    $klein->onHttpError(function ($code, $router){
      $view = new View();
      $view->generate('404.php');
    });
    $klein->dispatch();
	}
	
	static function ErrorPage($e=null){
	    Logger::getLogger('log')->log([$e]);
      $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
      header('HTTP/1.1 404 Not Found');
  		header("Status: 404 Not Found");
  		header('Location:'.$host.'404');
  		exit();
  }

}