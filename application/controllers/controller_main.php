<?php
class Controller_main{
  
  function __construct(){
		$this->model = new Model_main();
		$this->view = new View();
	}
	
	// Output list files
	function action_index(){
	  $data = $this->model->get_data();
	  if($data == false){
	    Route::ErrorPage404();
	  } else {
		  $this->view->generate('view_main.php', 'view_template.php',$data);
	  }
	}
	
	// Output download files
	function action_download(){
    if(count($_POST)>10) return Route::ErrorPage404();
    $filename = $this->model->get_file($_POST);
    
    if($filename == false){
	    Route::ErrorPage404();
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