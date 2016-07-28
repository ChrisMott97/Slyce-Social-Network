<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script>jQuery(function($) {$('.modal-trigger').leanModal();
                               $(".button-collapse").sideNav();});</script>

    <div id="wrapper">
        <?php include('includes/navigation.php');?>
        <div class="row">
        <div class="col s12 l8 offset-l2 posts">
            <?php
                try {
                    $stmt = $db->prepare('SELECT firstName, lastName, username, profilePicture FROM members ORDER BY username ASC');
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach($result as $row){
                        echo '<ul class="collection">';
                            echo '<li class="collection-item avatar">';
                            echo '<img src="images/profilepics/'.$row["profilePicture"].'" alt="" class="circle">';
                            echo '<span class="title">'.$row['firstName'].' '.$row['lastName'].'</span>';
                            echo '<p><br>'.$row['username'].'</p>';
                            echo '<a href="user.php?u='.$row['username'].'" class="secondary-content"><i class="material-icons">navigate_next</i></a>';
                            echo '</li>';
                        echo '</ul>';
                    }

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            ?>
        </div>
        </div>
    </div>


</body>
</html>