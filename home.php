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
    <script src="js/cards.js"></script>
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
                                        echo '<span class="card-title activator">'.$row['username'].'<i class="material-icons right">more_vert</i></span>';
                                        echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                                        echo '<p>'.$row['postDesc'].'</p>';
                                    echo '</div>';
                                    echo '<div class="card-reveal">';
                                        echo '<span class="card-title">'.$row['username'].'<i class="material-icons right">close</i></span>';
                                        echo '<p>'.$row['postCont'].'</p>';
                                    echo '</div>';
                                    //echo '<div class="card-action">';
                                        //if ($row['canExpand'] == 1) {
                                            //echo '<a href="viewpost.php?id='.$row['postID'].'"><div id="expand">Expand</div></a>';
                                        //} else {
                                            //echo '';
                                        //}
                                    //echo '</div>';
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