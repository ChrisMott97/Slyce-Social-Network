<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

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
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="/style/main.css">
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>

    <div id="wrapper">
        <div id="nav">
            <div id="navLeft">
                <a href="/admin/logout.php"><div id="btnLogout">Logout</div></a>
            </div>
            <div id="navCenter">
                <h1 id="navLogo">Profile</h1>
            </div>
            <div id="navRight">
                <a href="/home.php"><div id="btnNewsFeed">News Feed</div></a>
            </div>
        </div>
        <div id="profileHeader_1">
            <?php
                try {

                    $stmt = $db->query('SELECT profilePicture FROM members WHERE memberID='.$user->get_user_id());
                    while($row = $stmt->fetch()){
                        $dp = "/images/profilepics/".$row['profilePicture'];
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
            <?php include('../includes/createPostForm.php');?>
            <?php
                try {

                    $stmt = $db->query('SELECT members.username, postID, postDesc, postDate, canExpand FROM members INNER JOIN posts ON members.memberID = posts.memberID WHERE members.memberID='.$user->get_user_id().' ORDER BY postID DESC');
                    while($row = $stmt->fetch()){
                    
                        echo '<div class="thepost">';
                            echo '<p>'.$row['username'].'</p>';
                            echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                            echo '<p>'.$row['postDesc'].'</p>';                
                            if ($row['canExpand'] == 1) {
                                echo '<p><a href="/viewpost.php?id='.$row['postID'].'"><div id="expand">Expand</div></a></p>';
                            } else {
                                echo '';
                            }                
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