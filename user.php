<?php
ini_set('display_errors', 1);
require 'includes/setup.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header('Location: index.php');
}

$viewusername = $_GET['u'];
$viewuserid = $query->usernameToID($viewusername);
$viewuser = $query->findUser($viewuserid);

$posts = $query->userPosts($viewuser->getUserID());

$i=0;
foreach ($posts as $post){
    $readpost[$i] = new Post(null, $query);
    $readpost[$i]->setRead(
        $post['postid'],
        $post['userid'],
        $post['postcont'],
        $post['postdesc'],
        $post['canexpand'],
        $post['postdate']
    );
    $i++;
}

require 'views/user.view.php';