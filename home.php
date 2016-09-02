<?php
ini_set('display_errors', 1);
require 'includes/setup.php';


//If not logged in, redirect to splash page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
    header('Location: index.php');
}


//if post submitted by createpost.php form
if(isset($_POST['submit'])){
    $newpost = new Post($user); //create a new post object of things to be submitted
    $newpost->setNew($_POST['postcont']); //set new values in post object
    $query->pushPost($newpost); //push post to the database
    header('Refresh:0');
}


//on page load
$posts = $query->allPosts(); //get all posts
$i=0; //start counter for posts
foreach ($posts as $post){ //for each post in database,
    $readpost[$i] = new Post(null, $query); //create a new object
    $readpost[$i]->setRead( //set all values of the object
        $post['postid'],
        $post['userid'],
        $post['postcont'],
        $post['postdesc'],
        $post['canexpand'],
        $post['postdate']
    );
    $i++; //increase counter by one
}

require 'views/home.view.php';