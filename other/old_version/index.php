<?php
  // Google vendor
  require_once __DIR__ . '/vendor/autoload.php';
  // Google api with the authorized client object
  require_once __DIR__ . '/vendor/api.php';

  // Get the API client and construct the service object.
  $client = getClient();
  $service = new Google_Service_Drive($client);
  
  // Get names and IDs for up to 10 files.
  $optParams = array(
    'pageSize' => 10,
    'fields' => 'nextPageToken, files(id, name)'
  );
  $results = $service->files->listFiles($optParams);
  
  // !Submit Form!
  if (isset($_POST['submit'])) {
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
    
    // Send zip file
    if (file_exists($filename)) {
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm"></div>
      <div class="col-sm">
        <form action="" method="POST">
          <div class="checkbox">
            <label>
              <input type="checkbox" class="check" id="checkAll"> Check All
            </label>
          </div>
          <?php foreach ($results as $item):?>
            <div class="form-group form-check">
              <input class="form-check-input check" type="checkbox" value="<?=$item->getName()?>" name="<?=$item->getId()?>">
              <label class="form-check-label" for="<?=$item->getId()?>">
                <?=$item->getName()?>
              </label>
            </div>
          <?php endforeach?>
          <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        </form>
    </div>
    <div class="col-sm"></div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script>
    $("#checkAll").click(function () {
      $(".check").prop('checked', $(this).prop('checked'));
    });
  </script>
</body>
</html>