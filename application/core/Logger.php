<?php
class Logger {
  
    protected static $LOG_ON;
    protected static $PRINT_ON;
    
    public static $PATH;
    protected static $loggers=array();
 
    protected $name;
    protected $file;
    protected $fp;
    
    public static function PATH($arg){
      self::$PATH = $arg;
    }
 
    public function __construct($name, $file=null){
        self::$LOG_ON = Config::get('Log_errors');
        self::$PRINT_ON = Config::get('Print_errors');
        $this->name=$name;
        $this->file=$file;
        $this->open();

    }
 
    public function open(){
      
        if(self::$PATH==null || !self::$LOG_ON){
            return ;
        }
        
        $this->fp=fopen($this->file==null ? self::$PATH.'/'.$this->name.'.log' : self::$PATH.'/'.$this->file,'a+');
    }
 
    public static function getLogger($name='root',$file=null){
      
        if(!isset(self::$loggers[$name])){
            self::$loggers[$name]=new Logger($name, $file);
        }
 
        return self::$loggers[$name];
    }
 
    public function log($message){
        // Log aray
        if(!is_string($message)){
            $this->logPrint($message);
            return ;
        }
 
        $log='';
 
        $log.='['.date('D M d H:i:s Y',time()).'] ';
        if(func_num_args()>1){
            $params=func_get_args();
            $message=call_user_func_array('sprintf',$params);
        }
 
        $log.=$message;
        $log.="\n";
        
        // Write log
        $this->_write($log);
    }
 
    public function logPrint($obj){
      
          // Buffer
          ob_start();
          
          if(self::$PRINT_ON){
            print_r($obj);
          } 
          
          $ob=ob_get_clean();
          $this->log($ob);
    }
 
    protected function _write($string){
      if(self::$LOG_ON){
        fwrite($this->fp, $string);
      }
      if(self::$PRINT_ON){
        echo $string;
      }
    }
 
    public function __destruct(){
      if(self::$LOG_ON){
        fclose($this->fp);
      }
    }
}