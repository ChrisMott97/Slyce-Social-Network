<?php
//include config
require_once('includes/config.php');

//include google analytics
include_once("analyticstracking.php");

//check if already logged in
if( $user->is_logged_in() ){ header('Location: home.php'); } 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.png">

    <title>Slyce</title>
    
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,700,300' rel='stylesheet' type='text/css'>
    
    <!-- Custom styles for this template -->
    <link href="style/custom.css" rel="stylesheet">
    
    <script src="js/jquery-3.1.0.js"></script>
    
    <script src="js/custom.js"></script>
  </head>
  <body>
        <div class="container">

          <div class="cover">
            <h1 class="cover-heading">Slyce</h1>
            <h2><a href="#" class="allbtns">Login</a></h2>
          </div>
          <div id="login">

            <?php

            //process login form if submitted
            if(isset($_POST['submit'])){

                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
        
                if($user->login($email,$password)){ 

                    //logged in return to index page
                    header('Location: index.php');
                    exit;
        

                } else {
                    $message = '<p class="error">Wrong email or password</p>';
                }

            }//end if submit

            if(isset($message)){ echo $message; }
            ?>
            
            <form action="" method="post">
                <p><input type="text" placeholder="email" name="email" value=""  /></p>
                <p><input type="password"  placeholder="password" name="password" value=""  /></p>
                <p><input type="submit" name="submit" value="Login"  /></p>
            </form>

        </div>

        </div>
        <div class="mastfoot">
            <p>Slyce Copyright &copy; 2016 </p>
            <p>Founded by Chris Mott, Alfie Llewellyn  & Haydn Jones</p>
        </div>
  </body>
</html>