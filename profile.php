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
</head>
<body>

    <div id="wrapper">
        <?php include('includes/navigation.php');?>
        <div id="profileHeader_1">
            <?php
                try {

                    $stmt = $db->query('SELECT profilePicture FROM members WHERE memberID='.$user->get_user_id());
                    while($row = $stmt->fetch()){
                        $dp = "images/profilepics/".$row['profilePicture'];
                    }

                    } catch(PDOException $e) {
                    echo $e->getMessage();
                    }
            ?>
            <div id='profilePic' style="background:url(<?php echo $dp; ?>); background-size: contain;"></div>
            <?php
                try {

                    $stmt = $db->query('SELECT firstName, lastName, username FROM members WHERE memberID='.$user->get_user_id());
                    while($row = $stmt->fetch()){
                        echo '<div id="profileUserName">';
                            echo '<p>'.$row['username'].'</p>';               
                        echo '</div>';
                        echo '<div id="profileName">';
                            echo '<h1>'.$row['firstName'].' '.$row['lastName'].'</h1>';
                        echo '</div>';
                    }

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            ?>
        </div>
        <div class="posts">
            <?php include('includes/createPostForm.php');?>
            <?php
                try {

                    $stmt = $db->query('SELECT members.username, postID, postDesc, postDate, canExpand FROM members INNER JOIN posts ON members.memberID = posts.memberID WHERE members.memberID='.$user->get_user_id().' ORDER BY postID DESC');
                    while($row = $stmt->fetch()){
                        echo '<div class="row">';
                            echo '<div class="col s12 m12">';
                                echo '<div class="card">';
                                    echo '<div class="card-content black-text">';
                                        echo '<span class="card-title">'.$row['username'].'</span>';
                                        echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                                        echo '<p>'.$row['postDesc'].'</p>';
                                    echo '</div>';
                                    echo '<div class="card-action">';
                                        echo '<a href="#">Like</a>';
                                        if ($row['canExpand'] == 1) {
                                            echo '<a href="viewpost.php?id='.$row['postID'].'">Expand</a>';
                                        } else {
                                        }
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


</body>
</html>