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

    <!-- Bootstrap core CSS -->
    <!-- <link href="./style/bootstrap.min.css" rel="stylesheet"> -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,700,300' rel='stylesheet' type='text/css'>
    
    <!-- Custom styles for this template -->
    <link href="style/custom.css" rel="stylesheet">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    
    <script src="js/custom.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
          <div class="mastfoot">
            <p>Slyce Copyright &copy; 2016 </p>
            <p>Founded by Chris Mott, Alfie Llewellyn  & Haydn Jones</p>
          </div>
          
        </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>