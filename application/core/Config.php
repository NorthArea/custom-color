<?php
final class Config{
  private static $config = null;
  
  public static function setInstance($config){
    if(null == self::$config){
      self::$config = parse_ini_file($config);
      self::set();
    }
  }
  
  public static function get($param){
    foreach(self::$config as $key => $value)
      if($key == $param) return self::$config[$param];
    return false;
    
  }
  
  private static function set(){
    // PHP Errors
    ini_set("display_errors", self::get('display_errors'));
    error_reporting(self::get('error_reporting'));
    ini_set('log_errors', self::get('log_errors'));
    ini_set('error_log', self::get('error_log'));
  }
  
  private function __clone() {}
  private function __construct() {}
  private function __sleep(){}
  private function __wakeup(){}
}