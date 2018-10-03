<?php
class MainController extends Controller{
  
  function __construct(){
		$this->view = new View();
		$this->model = new GoogleDrive();
	}
	// Get list of a files from Google Drive
	function index(){
	  try{
  	  $GDpageSize = Config::get('GDpageSize');
  	  $data = $this->model->getData($GDpageSize);
  	  if (count($data->getFiles()) == 0) {
          throw new Exception('Error data is empty');
      } else {
  		  $this->view->generate('index.php', $data);
      }
	  } catch (Exception $e) {
      Logger::getLogger('log')->log($e);
      return false;
    }
	}
	// Output download files
	function download($request){
    if((count($request)>50) || (count($request)<1)){
      return Router::ErrorPage("POST>50 or POST<1");
    }

    $filename = $this->model->get_file($_POST);
    
    if($filename == false){
	    return Router::ErrorPage("Model return false");
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