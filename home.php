<?php

require 'includes/setup.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header("Refresh:0; url=index.php");
}

require 'views/home.view.php';