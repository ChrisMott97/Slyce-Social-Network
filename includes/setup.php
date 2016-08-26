<?php

require './models/connection.php';
$db = new Connection();

require './models/querybuilder.php';
$query = new QueryBuilder($db);

require './models/auth.php';
$auth = new Auth($query);

if(isset($_SESSION['loggedin']) && $_SESSON['loggedin'] == true){
    $user = $auth->fetchUser();
}