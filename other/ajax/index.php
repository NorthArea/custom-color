<?php
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Search user</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    body{
      padding-top:50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Search user</h1>
    <form>
      <label for="formGroupExampleInput">Search user:</label>
      <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Please, input a name" onkeyup="show(this.value)">
    </form>
      <label for="formGroupExampleInput">suggestion: <span id="output"></span></label>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script>
    function show(str){
      var output = document.getElementById('output');
      console.log(str);
      if(str.length ===0) return output.innerHTML = '';
      // AJAX request
      var xhttp = new XMLHttpRequest()
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          output.innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "suggestion.php?q="+str, true);
      xhttp.send();
    }
  </script>
</body>
</html>