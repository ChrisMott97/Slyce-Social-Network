<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); }
?>

<html>
<head>
    
    <title> Settings </title>
    <link rel="stylesheet" href="style/main.css">
<link rel="stylesheet" href="style/materialize.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    
    <body>
    
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<?php include('includes/navigation.php');?>
        
        <script> $(document).ready(function(){
    $('ul.tabs').tabs();
  });</script>
        
<div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a href="#test1">Edit Bio</a></li>
          <li class="tab col s3"><a href="#test2">Ed Bio</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">Edit Bio</div>
    <div id="test2" class="col s12">Ed Bio</div>
  </div>
        
        
    </body>
    
</html>