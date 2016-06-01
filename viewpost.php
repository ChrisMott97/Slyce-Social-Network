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
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
</head>
<body>

    <div id="wrapper">

        <h1>Post</h1>
        <hr />
        <p><a href="./">Public Wall</a></p>


        <?php    
            echo '<div>';
                echo '<p>'.date('jS M Y', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postCont'].'</p>';                
            echo '</div>';
        ?>

    </div>


</body>
</html>