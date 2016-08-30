<?php
ini_set('display_errors', 1);
require 'includes/setup.php';

if(isset($_POST['submit'])){
    $auth->login($_POST['email'], $_POST['password']);
    header("Refresh:0");
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    header('Location: home.php');
}

require 'views/index.view.php';