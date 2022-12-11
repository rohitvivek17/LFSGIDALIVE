<?php
Class Connection 
{
  
private  $server = "mysql:host=localhost;dbname=u805177495_lfs";
private  $user = "u805177495_root";
private  $pass = "5Tv&0FDyY";
private $options  = array(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES =>PDO::ATTR_EMULATE_PREPARES, 1);
protected $connect;
 
            public function openConnection()
             {
               try
                 {
          $this->connect = new PDO($this->server, $this->user,$this->pass,$this->options);
          return $this->connect;
                  }
               catch (PDOException $e)
                 {
                     echo "There is some problem in connection: " . $e->getMessage();
                 }
             }
public function closeConnection() {
     $this->connect = null;
  }
}
session_start();
?>