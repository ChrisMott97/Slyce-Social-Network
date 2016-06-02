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
        <div class="nav">
            <h1><img src="images/favicon2.png">MiSlice Wall</h1>
        </div>
        <div class="posts">
            <?php
                try {

                    $stmt = $db->query('SELECT postID, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
                    while($row = $stmt->fetch()){
                    
                        echo '<div>';
                            echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                            echo '<p>'.$row['postDesc'].'</p>';                
                            echo '<p><a href="viewpost.php?id='.$row['postID'].'">Expand</a></p>';                
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