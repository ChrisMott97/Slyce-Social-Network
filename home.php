<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Slyce Wall</title>
    <link rel="stylesheet" href="style/main.css">
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>

    <div id="wrapper">
        <div id="nav">
            <div id="navLeft">
                <a href="admin/logout.php"><div id="btnLogout">Logout</div></a>
            </div>
            <div id="navCenter">
                <h1 id="navLogo">Slyce</h1>
            </div>
            <div id="navRight">
                <a href="profile.php"><div id="btnProfile">Profile</div></a>
            </div>
        </div>
        <div class="posts">
           <?php include('includes/createPostForm.php');?>
            <?php
                try {

                    $stmt = $db->query('SELECT members.username, postID, postDesc, postDate, canExpand FROM members INNER JOIN posts ON members.memberID = posts.memberID ORDER BY postID DESC');
                    while($row = $stmt->fetch()){
                    
                        echo '<div class="thepost">';
                            echo '<p>'.$row['username'].'</p>';
                            echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                            echo '<p>'.$row['postDesc'].'</p>';
                            if ($row['canExpand'] == 1) {
                                echo '<p><a href="viewpost.php?id='.$row['postID'].'"><div id="expand">Expand</div></a></p>';
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