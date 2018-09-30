<?php

class Controller_main extends Controller{

	function __construct(){
		$this->model = new Model_main();
		$this->view = new View();
	}
	
	function action_index(){
	  // Check limit file
	  if(isset($_GET['limit'])){
	    if(($_GET['limit'])>10 || ($_GET['limit'])<1 || !is_numeric($_GET['limit']))
	      return Route::ErrorPage("GET[limit]>10 || GET[limit]<1 or not number");
      else
	      $data = $this->model->get_data($_GET['limit']);
	  } else {
	    $data = $this->model->get_data();
	  }
	  if(!isset($data)){
	    return Route::ErrorPage("Model_main return false");
	  }
	  // Generate View
		$this->view->generate('view_main.php', $data);
	}
	
	// Output download files
	function action_download(){
    if((count($_POST)>10) || (count($_POST)<1)){
      return Route::ErrorPage404("POST>10 or POST<1");
    }
    $filename = $this->model->get_file($_POST);
    
    if($filename == false){
	    return Route::ErrorPage404("Model return false");
	  } else {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($filename).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filename));
      readfile($filename);
      
      // Clean Dir
      if (file_exists('./tmp/')) {
        foreach (glob('./tmp/*') as $file) {
          unlink($file);
        }
      }
      exit;
    }
	}
}