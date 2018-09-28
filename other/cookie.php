<?php
  if(isset($_POST['name'])){
    $name = htmlentities($_POST['name']);
    // Set cookie at 1 Hour
    setcookie('name', $name, time()+3600);
    setcookie('name', 'John', time()+(86400*30));
    $user = ["name"=>"Alex","email"=>"test@test.test"];
    $user = serialize($user);
    setcookie("name", $user, time()+3600);
    header('Location: page2.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form method="POST" action="">
    <input type="text" name="name" placeholder="Name"/>
    <input type="submit" name="submit" value="Submit"/>
  </form>
  <a href="page1.php">page1.php</a>
  <a href="page2.php">page2.php</a>
  <a href="page3.php">page3.php</a>
</body>
</html>