<?php
session_start();

require './models/connection.php';
$cnnct = new Connection();
$db = $cnnct->create();//connection class used for connection to database

require './models/querybuilder.php';
$query = new QueryBuilder($db); //all SQL queries are made here - requires connection class

require './models/user.php';

require './models/post.php';

require './models/auth.php';
$auth = new Auth($query); //initial authentication - requires the query builder

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $user = $auth->fetchUser();
}
