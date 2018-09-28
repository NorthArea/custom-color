<?php
class Person {
  private $name;
  private $email;
  
  private static $limitAge = 18;
  
  public function __construct($name, $email){
    $this->name = $name;
    $this->email = $email;
    echo __CLASS__." created<br>";
  }
  
  public function __destruct(){
    echo __CLASS__." destroy<br>";
  }
  
  public function getNeme(){
    return $this->name;
  }
  public function getEmail(){
    return $this->email;
  }
  public function setNeme($name){
    $this->name = $name;
    return true;
  }
  public function setEmail($email){
    $this->email = $email;
    return true;
  }
  public function getLimitAge(){
    return self::$limitAge;
  }
}

echo Person::getLimitAge();

/*
$person1 = new Person('Alex','test@test.ru');
echo $person1->getNeme()."<br>";
echo $person1->setNeme('Ivan')."<br>";
echo $person1->getNeme()."<br>";
unset($person1);
*/

class Customer extends Person{
  private $balance;
  public function __construct($name, $email, $balance){
    parent::__construct($name, $email);
    $this->balance = $balance;
    echo __CLASS__." was created<br>";
  }
  public function getBalance(){
    return $this->balance;
  }
  public function setbalance($balance){
    $this->balance = $balance;
    return true;
  }
}

//$cystomer1 = new Customer("Vita","test@test.test", 4000);