<?php
ini_set('display_errors', 1);
require 'includes/setup.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header('Location: index.php');
}

if(isset($_POST['bioform'])){
    $bio = $_POST['bio'];
    $query->updateUser($user->getUserID(), 'bio', $bio);
}

require 'views/settings.view.php';