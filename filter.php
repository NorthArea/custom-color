<?php
  /*
  if(filter_has_var(INPUT_POST, 'data'))
    echo "Data found";
  else
    echo "No Data";
  
  if(filter_has_var(INPUT_POST, 'data')){
    $email = $_POST['data'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    echo "$email <br>";
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      echo 'email is valid';
    } else {
      echo 'email is NOT valid';
    }
  }
  
  
  $var = 23;
  if(filter_var($var, FILTER_VALIDATE_INT)){
    echo "$var is a number";
  }
  
  
  $filters = [
    "data" => FILTER_VALIDATE_EMAIL,
    "data2" => [
      "filter" => FILTER_VALIDATE_INT,
      "options" => [
        "min_range" => 1,
        "max_range" => 100
      ]
    ]
  ];
  print_r(filter_input_array(INPUT_POST, $filters));
  */
  
  $arr = [
    "name" => "Alex",
    "age" => "28",
    "email" => "adsl41c@yuasd.,df"
  ];
  
  $filters = [
    "name" => [
      "filter" => FILTER_CALLBACK,
      "options" => "ucwords"
    ],
    "age" => [
      "filter" => FILTER_VALIDATE_INT,
      "options" => [
        "min_range" => 1,
        "max_range" => 150
      ]
    ],
    "email" => FILTER_VALIDATE_EMAIL
  ];
  
  print_r(filter_var_array($arr,$filters));
?>

<form method="POST">
  <input type="text" name="data"/>
  <input type="text" name="data2"/>
  <input type="submit" value="Submit"/>
</form>