<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Slyce Wall</title>
    <link rel="stylesheet" href="style/main.css">
    <link type="text/css" rel="stylesheet" href="style/materialize.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
    
</head>
<body>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script>jQuery(function($) {$('.modal-trigger').leanModal();
                               $(".button-collapse").sideNav();});
    </script>
    <?php include('includes/navigation.php');
    function checkExists($postIDvar, $dbe, $usere){
        try {
            $stmtLike = $dbe->query('SELECT username, postID FROM likes WHERE username="'.$usere->get_username().'" AND postID='.$postIDvar.'');
            $rowLike = $stmtLike->fetch();
            return $rowLike;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    if(isset($_GET['like'])){
        $likePost = $_GET['like'];
        if(checkExists($likePost, $db, $user)==""){
            try {
            $stmtLike = $db->prepare('INSERT INTO likes (username, postID) VALUES (:username, :postID)');
            $stmtLike->execute(array(
                    ':username' => $user->get_username(),
                    ':postID' => $likePost
                ));
                header("Refresh:0");
                exit;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            
        }
    } else {
        
    }
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col l6 s12 offset-l3 posts">
               <?php include('includes/createPostForm.php');
                    try {
                        $stmt = $db->query('SELECT members.username, postID, postDesc, postDate, canExpand, postCont FROM members INNER JOIN posts ON members.username = posts.username ORDER BY postID DESC');
                        while($row = $stmt->fetch()){
                            echo '<div class="row">';
                                echo '<div class="col s12 m12">';
                                    echo '<div class="card">';
                                        echo '<div class="card-content black-text">';
                                            echo '<span class="card-title "><a href="user.php?u='.$row['username'].'">'.$row['username'].'</a></span>';
                                            echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                                            echo '<p>'.$row['postDesc'].'</p>';
                                        echo '</div>';
                                        echo '<div class="card-action">';
                                            if (checkExists($row['postID'], $db, $user)==""){
                                                echo '<a href="?like='.$row['postID'].'"><i class="material-icons tooltipped" data-position="left" data-delay=50 data-tooltip="Like!">thumb_up</i></a>';
                                            } else {
                                                echo '<i class="material-icons disabled">thumb_up</i>';
                                            }
                                            
                                            if ($row['canExpand'] == 1) {
                                                //echo '<a href="viewpost.php?id='.$row['postID'].'">Expand</a>';
                                                echo '<a href="#modal'.$row['postID'].'" class="modal-trigger">Expand</a>';
                                            }
                                        echo '</div>';
                                        echo '<div id="modal'.$row['postID'].'" class="modal">';
                                            echo '<div class="modal-content">';
                                                echo '<h4><a href="user.php?u='.$row['username'].'">'.$row['username'].'</a></h4>';
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