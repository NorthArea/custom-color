<?php
require __DIR__ . '/google/api.php';

class Model_main{
  
	public function get_data(){
	  
    try {
      // Get the API client and construct the service object.
      $client = getClient();
      $service = new Google_Service_Drive($client);
      
      // Print the names and IDs for up to 10 files.
      $optParams = array(
        'pageSize' => 10,
        'fields' => 'nextPageToken, files(id, name)'
      );
      $results = $service->files->listFiles($optParams);
    } catch(Exception $e) {
      return false;
    }
    		
		return $results;
	}
	
	public function get_file($arr){
	  
	  try {
  	  // Get the API client and construct the service object.
      $client = getClient();
      $service = new Google_Service_Drive($client);
      
      $zip = new ZipArchive();
      $filename = "./tmp/".time().".zip";
      
      // Create zip file
      if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
          exit("Невозможно открыть <$filename>\n");
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
	  } catch(Exception $e) {
	    return false;
	  }
	  
	  return $filename;
	  
	}

}