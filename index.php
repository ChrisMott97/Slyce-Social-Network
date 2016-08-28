<?php

require 'includes/setup.php';

if(isset($_POST['email'])){
    $auth->login($_POST['email'], $_POST['password']);
    header("Refresh:0");
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    header("Refresh:0; url=home.php");
}

require 'views/index.view.php';