<?php
    function checkExists($postIDvar){
        global $user;
        global $db;
        try {
            $stmtLike = $db->query('SELECT username, postID FROM likes WHERE username="'.$user->get_username().'" AND postID='.$postIDvar.'');
            $rowLike = $stmtLike->fetch();
            return $rowLike;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    function countLikes($postIDvar){
        global $user;
        global $db;
        try {
            $stmtLikeCheck = $db->query('SELECT COUNT(username) AS likeCount FROM likes WHERE postID='.$postIDvar.'');
            $rowLikeCheck = $stmtLikeCheck->fetch();
            return $rowLikeCheck[0];
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    if(isset($_GET['like'])){
        $likePost = $_GET['like'];
        if(checkExists($likePost)==""){
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