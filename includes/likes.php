<?php
    function checkExists($postIDvar){
        global $user;
        global $db;
        try {
            $stmt = $db->prepare('SELECT username, postID FROM likes WHERE username=:username AND postID=:postID');
            $stmt->bindValue(':username', $user->get_username());
            $stmt->bindValue(':postID', $postIDvar);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    function countLikes($postIDvar){
        global $user;
        global $db;
        try {
            $stmt = $db->prepare('SELECT COUNT(username) AS likeCount FROM likes WHERE postID=:postID');
            $stmt->bindValue(':postID', $postIDvar);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row[0];
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    if(isset($_GET['like'])){
        $likePost = $_GET['like'];
        if(checkExists($likePost)==""){
            try {
                $stmt = $db->prepare('INSERT INTO likes (username, postID) VALUES (:username, :postID)');
                $stmt->bindValue(':username', $user->get_username());
                $stmt->bindValue(':postID', $likePost);
                $stmt->execute();
                
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