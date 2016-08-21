<?php require_once('includes/config.php');

//check if already logged in
if( $user->is_logged_in() ){ header('Location: home.php'); } ?>
<html>

    <head>
        <?php require('includes/header.php'); ?>
            <title>Slyce</title>
    </head>

    <body>
        <?php require('views/index.view.php'); ?>
    </body>

</html>
