<?php
  session_start();
  if(isset($_POST['submit'])){
    session_destroy();
    // Start the session
    session_start();
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    header("Location page2.php");
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
  <?php if(isset($_SESSION['name'])){?>
    <h2>Hello <?=$_SESSION['name']?>!!</h2>
  <?php }?>
  <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    <input type="text" name="name" placeholder="Name"/>
    <input type="text" name="email" placeholder="Email"/>
    <input type="submit" name="submit" value="Submit"/>
  </form>
  <a href="page1.php">page1.php</a>
  <a href="page2.php">page2.php</a>
  <a href="page3.php">page3.php</a>
</body>
</html>