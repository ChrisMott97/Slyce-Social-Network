<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Slyce Wall</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <script src="materialize-src/js/bin/materialize.js"></script>
</head>
<body>

    <div id="wrapper">
        <?php include('includes/navigation.php');?>
        <div class="posts">
           <?php include('includes/createPostForm.php');?>
            <?php
                try {

                    $stmt = $db->query('SELECT members.username, postID, postDesc, postDate, canExpand FROM members INNER JOIN posts ON members.memberID = posts.memberID ORDER BY postID DESC');
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