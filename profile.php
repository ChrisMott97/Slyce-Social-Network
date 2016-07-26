<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); }

/*try {

    $stmt = $db->prepare('SELECT firstName FROM members WHERE memberID=:theid');
    $stmt->execute(array('theid' => $user->get_user_id()));
    $row = $stmt->fetch();
                    
    echo '<h1>Hello, '.$row["firstName"].'</h1>';

    } catch(PDOException $e) {
        echo $e->getMessage();
    } */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile</title>
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
    <?php include('includes/navigation.php');?>
    <div class="container">
        <div class="row">
            <div class="col s12 l10 offset-l1 profileHeader_1 center-align">
                <?php
                try {
                    $stmt = $db->query('SELECT firstName, lastName, username, bio, profilePicture FROM members WHERE username="'.$user->get_username().'"');
                    while($row = $stmt->fetch()){
                        $dp = "images/profilepics/".$row['profilePicture'];
                        $bio = $row['bio'];
                        $firstname = $row['firstName'];
                        $lastname = $row['lastName'];
                        $username = $row['username'];
                    }

                    } catch(PDOException $e) {
                    echo $e->getMessage();
                    }
                ?>
                <div class="row">
                    <div class='col s12 l3 hide-on-small-only'><div class='profilePic circle' style="background:url(<?php echo $dp; ?>); background-size: contain;"></div></div>
                    <div class='col s3 offset-s5 l3 hide-on-med-and-up'><div class='profilePic2 circle' style="background:url(<?php echo $dp; ?>); background-size: contain;"></div></div>
                    <div class='col s12 l9' id="pushdown">
                        <div class="col s6 profileName">
                            <b><?php echo $firstname.' '.$lastname; ?></b>
                        </div>
                        <div class="col s6 profileUserName">
                            <p><?php echo $username; ?></p>              
                        </div>
                        <div class="col s12 profileBioLine">
                            <div class="divider"></div>
                            <u>Bio</u>
                            <div class='bioContent'><?php echo $bio ?></div>
                            <div class="divider"></div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        <div class="row">
            <div class="col s12 l6 offset-l1 posts">
            <?php include('includes/createPostForm.php');?>
            <?php
                try {

                    $stmt = $db->query('SELECT members.username, postID, postDesc, postDate, canExpand, postCont FROM members INNER JOIN posts ON members.username = posts.username WHERE members.username="'.$user->get_username().'" ORDER BY postID DESC');
                    while($row = $stmt->fetch()){
                        echo '<div class="row">';
                            echo '<div class="col s12 m12">';
                                echo '<div class="card">';
                                    echo '<div class="card-content black-text">';
                                        echo '<span class="card-title ">'.$user->get_username().'</span>';
                                        echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                                        echo '<p>'.$row['postDesc'].'</p>';
                                    echo '</div>';
                                    echo '<div class="card-action">';
                                        echo '<a href="#"><i class="material-icons">thumb_up</i></a>';
                                        if ($row['canExpand'] == 1) {
                                            //echo '<a href="viewpost.php?id='.$row['postID'].'">Expand</a>';
                                            echo '<a href="#modal'.$row['postID'].'" class="modal-trigger">Expand</a>';
                                        } else {
                                        }
                                    echo '</div>';
                                    echo '<div id="modal'.$row['postID'].'" class="modal">';
                                        echo '<div class="modal-content">';
                                            echo '<h4>'.$user->get_username().'</h4>';
                                            echo '<p>'.$row['postCont'].'</p>';
                                        echo '</div>';
                                        echo '<div class="modal-footer">';
                                            echo '<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Return</a>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';

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