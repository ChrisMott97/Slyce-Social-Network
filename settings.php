<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); }
?>

<html>
<head>
    <title> Settings </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script>jQuery(function($) {$('.modal-trigger').leanModal();
                               $(".button-collapse").sideNav();
                             $('ul.tabs').tabs();});</script>
    <?php include('includes/navigation.php');?>
    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3"><a class="active" onclick="$('#editbio').fadeIn(750)" href="#editbio">Edit Bio</a></li>
                <li class="tab col s3"><a href="#test2">Privacy</a></li>
                <li class="tab col s3 disabled"><a href="#test3">Colours</a></li>
                <li class="tab col s3 disabled "><a href="#test4">Other</a></li>
            </ul>
        </div>
  <div id="editbio" class="col s12 l6 offset-l3"><?php include('settings/editbio.php');?></div>
  <div id="test2" class="col s12"></div>
  <div id="test3" class="col s12"></div>
  <div id="test4" class="col s12"></div>
</div>

</body>
</html>
