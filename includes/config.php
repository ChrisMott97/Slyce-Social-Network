<?php
ob_start();
session_start();

//database credentials
define('DBHOST','eu-cdbr-azure-west-d.cloudapp.net');
define('DBUSER','b6cae1712ef518');
define('DBPASS','e7617697');
define('DBNAME','slyce');

$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//set timezone
date_default_timezone_set('Europe/London');

//load classes as needed
function __autoload($class) {
   
   $class = strtolower($class);

    //if call from within assets adjust the path
   $classpath = 'models/' . $class . '.class.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }     
    
    //if call from within admin adjust the path
   $classpath = '../models/' . $class . '.class.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }
    
    //if call from within admin adjust the path
   $classpath = '../../models/' . $class . '.class.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }         
     
}

$user = new User($db); 
?>