<?php
class GoogleDrive extends Model{
  
  public function getData($pageSize=10){
    try {
      if(($pageSize >50) || ($pageSize<=0))
        throw new Exception('Error Page size');
      $service = parent::getInstance();
      if (!$service)
        throw new Exception('Google_Client(Vendor) Error(getInstance())');
  
      // Print the names and IDs for up to 10 files.
      $optParams = array(
        'pageSize' => $pageSize,
        'fields' => 'nextPageToken, files(id, name)'
      );
      $results = $service->files->listFiles($optParams);
    } catch (Exception $e) {
      Logger::getLogger('log')->log($e);
      return false;
    }
    return $results;
  }
  
  // Get files from Google Drive
	public function get_file($arr){
	  
	  try {
	    print_r($arr);
	    /*
      if((count($arr)>50) || (count($arr)<1));
        throw new Exception("POST>50 or POST<1");
      */
      $service = parent::getInstance();
      if (!$service)
        throw new Exception('Google_Client(Vendor) Error(getInstance())');
      
      $zip = new ZipArchive();
      $filename = "./tmp/".time().".zip";
      
      // Create zip file
      if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        throw new Exception("Can't open <$filename>");
      }
      
      // Create array with file id from Google drive
      foreach($arr as $key=>$value){
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