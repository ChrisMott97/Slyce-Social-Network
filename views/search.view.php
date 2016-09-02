<html>

<head>
    <?php require('includes/header.php'); ?>
    <title>Slyce Public Wall</title>
</head>

<body>
    <?php require('includes/nav.php'); ?>
    <div class='container'>
        <div class="row">
            <div class="col s12 l8 offset-l2 card-panel">
               <?php foreach($viewuser as $user):?>
                    <ul class="collection">
                    <!--<li class="collection-item avatar">
                        <img src="images/yuna.jpg" alt="" class="circle">
                        <span class="title">Title</span>
                        <p>First Line <br>
                        Second Line
                        </p>
                        <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>-->
                        <li class="collection-item avatar">
                            <i class="material-icons circle">perm_identity</i>
                            <span class="title"><?= $user->getFullName(); ?></span>
                            <p><?= $user->getUsername();?></p>
                            <a href=<?= 'user.php?u='.$user->getUsername();?> class="secondary-content"><i class="material-icons">send</i></a>
                        </li>
                    </ul>
               <?php endforeach;?> 
            </div>
        </div>
    </div>
    <?php require('includes/footer.php'); ?>
</body>

</html>
