<?php
/*
  example.ru / CONTROLLER / ACTION /
*/
class Route{

	static function start(){
		// Default controller and action name = example.ru / main / index /
		$controller_name = 'main';
		$action_name = 'index';
		
		// Expode request url by using "/"
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// Get controller name
		if ( !empty($routes[1]) ){	
			$controller_name = $routes[1];
		}
		
		// Get action name
		if ( !empty($routes[2]) ){
			$action_name = $routes[2];
		}

		// Add Model and Controller prefix
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/*
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/
    
    try{
  		// include Model
  		$model_file = strtolower($model_name).'.php';
  		$model_path = "application/models/".$model_file;
  		
  		if(file_exists($model_path))
  			include "application/models/".$model_file;

  		// include Controller
  		$controller_file = strtolower($controller_name).'.php';
  		$controller_path = "application/controllers/".$controller_file;
  		
  		if(file_exists($controller_path))
  			include "application/controllers/".$controller_file;
  		else
    		throw new Exception("Can't find controller: $controller_name");
		
  		// Create Controller object
  		$controller = new $controller_name;
  		$action = $action_name;
  		
  		if(method_exists($controller, $action))
  			// вызываем действие контроллера
  			$controller->$action();
  		else
    		throw new Exception("Can't find action: $action_name");
    		  
    } catch(Exception $e) {
      Route::ErrorPage($e);
    }
	
	}

	function ErrorPage($e){
  	  Logger::getLogger('log')->log($e);
      $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
      header('HTTP/1.1 404 Not Found');
  		header("Status: 404 Not Found");
  		header('Location:'.$host.'404');
  }
    
}
