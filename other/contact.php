<?php
  $msg="";
  $msgClass="";
  
  // Check for Submit
  if(filter_has_var(INPUT_POST, 'submit')){
    
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Check Require fields
    if(!empty($name) && !empty($email) && !empty($message)){
      // Validate email
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $msg = "Please use a valid email";
        $msgClass ="alert-danger";
      } else {
        // Passed
        $toEmail = "adsl41c@yandex.ru";
        $subject = "Contact Request $name";
        $body = "<h2>Contact Request</h2>
          <h4>Name</h4>$name<p></p>
          <h4>Email</h4>$email<p></p>
          <h4>Message</h4>$message<p></p>
        ";
        // Email Headers
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .="Content-type:text/html; charset=UTF-8"."\r\n";
        // Additional Header
        $headers .= "From: $name <$email>"."\r\n";
        if(mail($toEmail,$subject,$body,$headers)){
          $msg = "Your email has been sent.";
          $msgClass ="alert-success";
        } else {
          $msg = "Your email was not sent.";
          $msgClass ="alert-danger";
        }
      }
    } elseif(empty($name)) {
      // Failed
      $msg = "Please, enter a name";
      $msgClass ="alert-danger";
    } elseif(empty($email)) {
      // Failed
      $msg = "Please, enter an email";
      $msgClass ="alert-danger";
    } elseif(empty($message)) {
      // Failed
      $msg = "Please, enter a message";
      $msgClass ="alert-danger";
    } else {
      // Failed
      $msg = "Please, fill all fields";
      $msgClass ="alert-danger";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Starter Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
      body {
        padding-top: 5rem;
      }
      .starter-template {
        padding: 3rem 1.5rem;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <main role="main" class="container">
      <div id="error"></div>
      <?php if($msg != ""):?>
        <div role="alert" class="alert <?=$msgClass?>">
          <?=$msg?>
          <button class="close" type="button" aria-label="Close" onClick="hello(this)"><span aria-hidden="true">&times;</span></button></div>
        </div>
      <?php endif?>
      
      <form method="post" onsubmit="return validation()">
        <div class="form-group">
          <label>Name</label>
          <input id="name" type="text" class="form-control" name="name" value="<?= isset($_POST['name'])?$name:""?>">
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input id="email" type="email" class="form-control" name="email" value="<?= isset($_POST['email'])?$email:""?>">
        </div>
        <div class="form-group">
          <label>Example textarea</label>
          <textarea id="message" class="form-control" name="message" rows="3"><?= isset($_POST['message'])?$message:""?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </main><!-- /.container -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
      function validation (){
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();
        
        function error(message) {
          $('#error').html('<div class="alert alert-danger error">' + message + '<button class="close" type="button" aria-label="Close" onClick="hello(this)"><span aria-hidden="true">&times;</span></button></div>');
        }

        if (name.length < 1) {
          error('Please, enter a name.');
          return false
        }
        if (email.length < 1) {
          error('Please, enter an email.');
          return false
        } else {
          var regEx = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
          var validEmail = regEx.test(email);
          if (!validEmail) {
            error('Please, enter valid email.');
            return false
          }
        }
        if (message.length < 1) {
          error('Please, enter a message.');
          return false
        }
      }
    </script>
    <script>
      function hello(arg){
        arg.parentNode.remove()
      }
    </script>
    <script>
      $(".message").fadeTo(3500, 500).slideUp(500, function(){
          $(".message").slideUp(500);
      });
    </script>
  </body>
</html>