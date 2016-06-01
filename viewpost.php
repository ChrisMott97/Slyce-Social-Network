<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT postID, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
    header('Location: ./');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

    <div id="wrapper">

        <h1>Blog</h1>
        <hr />
        <p><a href="./">Blog Index</a></p>


        <?php    
            echo '<div>';
                echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postCont'].'</p>';                
            echo '</div>';
        ?>

    </div>


</body>
</html>