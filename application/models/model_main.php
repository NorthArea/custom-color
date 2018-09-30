<?php

class Model_main extends Model{
  
	// Get list of a files from Google Drive
	public function get_data($pageSize = 10){
	
    try {
      // Connect to Google Drive 
      $client = getClient();
      $service = new Google_Service_Drive($client);
      
      if (!$service || !$client) {
        throw new Exception('Connect to api is fail');
      }
      
      // Print the names and IDs for up to 10 files.
      $optParams = array(
        'pageSize' => $pageSize,
        'fields' => 'nextPageToken, files(id, name)'
      );
      $results = $service->files->listFiles($optParams);
      
    } catch(Exception $e) {
      Logger::getLogger('log')->log($e);
      return false;
    }
    		
		return $results;
	}
	
	// Get files from Google Drive
	public function get_file($arr){
	  
	  try {
  	  // Get the API client and construct the service object.
      $client = getClient();
      $service = new Google_Service_Drive($client);
      
      if (!$service) {
        throw new Exception('Connect to api is fail');
      }
      
      $zip = new ZipArchive();
      $filename = "./tmp/".time().".zip";
      
      // Create zip file
      if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        throw new Exception("Can't open <$filename>");
      }
      
      // Create array with file id from Google drive
      foreach($_POST as $key=>$value){
        if($key == "submit") break;
        $fileId = "$key";
        $content = $service->files->get($fileId, array("alt" => "media"));
        
        // Open file handle for output.
        $outHandle = fopen("./tmp/$value", "w+");
        
        // Until we have reached the EOF, read 1024 bytes at a time and write to the output file handle.
        while (!$content->getBody()->eof()) {
          fwrite($outHandle, $content->getBody()->read(1024));
        }
        
        // Close output file handle.
        fclose($outHandle);
        $zip->addFile("./tmp/$value",$value);
      }
      $zip->close();
      
      if(!file_exists($filename)){
        throw new Exception('Fail to create a file');
      }
      
	  } catch(Exception $e) {
	    Logger::getLogger('log')->log($e);
	    return false;
	  }
	  
	  return $filename;
	  
	}

}
