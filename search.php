<?php
ini_set('display_errors', 1);
require 'includes/setup.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header('Location: index.php');
}

$users = $query->allUsers();

$i=0;
foreach ($users as $user){
    $viewuser[$i] = new User();
    $viewuser[$i]->setRead(
        $user['userid'],
        $user['username'],
        $user['firstname'],
        $user['lastname'],
        $user['email'],
        $user['isadmin'],
        $user['isnew'],
        $user['bio'],
        $user['password']
    );
    $i++;
}

require 'views/search.view.php';