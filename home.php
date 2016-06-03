<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Public Wall</title>
    <link rel="stylesheet" href="style/normalize.css">
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
                <h1 id="navLogo">MiSlice Wall</h1>
            </div>
            <div id="navRight">
                <a href="admin/index.php"><div id="btnAccount">Account</div></a>
            </div>
        </div>
        <div class="posts">
            <?php
                try {

                    $stmt = $db->query('SELECT blog_members.username, postID, postDesc, postDate FROM blog_members INNER JOIN blog_posts ON blog_members.memberID = blog_posts.memberID ORDER BY postID DESC');
                    while($row = $stmt->fetch()){
                    
                        echo '<div class="thepost">';
                            echo '<p>'.$row['username'].'</p>';
                            echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                            echo '<p>'.$row['postDesc'].'</p>';                
                            echo '<p><a href="viewpost.php?id='.$row['postID'].'"><div id="expand">Expand</div></a></p>';                
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