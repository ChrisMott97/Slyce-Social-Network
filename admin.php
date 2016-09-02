<?php
ini_set('display_errors', 1);
require 'includes/setup.php';


//If not logged in, redirect to splash page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header('Location: index.php');
}

if(isset($_POST['createuser'])){
    $newuser = new User();
    if($check->registerUsername($_POST['username']) && $check->registerEmail($_POST['email'])){
        $newuser->create(
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['username'],
            $_POST['password'],
            $_POST['email']
        ); 
        $query->pushUser($newuser); 
        header('Refresh:0');
    }
    
}

require 'views/admin.view.php';