<?php
ini_set('display_errors', 1);
require 'includes/setup.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header('Location: index.php');
}

require 'views/home.view.php';