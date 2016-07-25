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
        
        <div class="col">
    <div class="row s12">
      <ul class="tabs">
        <li class="tab col s3"><a href="#test1">Test 1</a></li>
        <li class="tab col s3"><a class="active" href="#test2">Test 2</a></li>
        <li class="tab col s3 disabled"><a href="#test3">Disabled Tab</a></li>
        <li class="tab col s3"><a href="#test4">Test 4</a></li>
      </ul>
    </div>
    <div id="test1" class="row s12">Test 1</div>
    <div id="test2" class="row s12">Test 2</div>
    <div id="test3" class="row s12">Test 3</div>
    <div id="test4" class="row s12"">Test 4</div>
  </div>
        
        
    </body>
    
</html>