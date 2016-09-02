<html>

<head>
    <?php require('includes/header.php'); ?>
    <title>Slyce Public Wall</title>
</head>

<body>
    <?php require('includes/nav.php'); ?>
    <div class='container'>
        <div class="row">
            <div class="col l3 s12 offset-l1 profile">
                <div class="row">
                    <div class="card-panel center profile">
                        <div class="row"><?= $user->getUsername(); ?></div>
                        <div class="row"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="card-panel center profile">
                        <div class="row">Bio</div>
                        <div class="divider"></div>
                        <br>
                        <div class="row"><?= $user->getBio();?></div>
                    </div>
                </div>
            </div>
            <div class="col l6 s12">
                <?php require('includes/createpost.php');
                foreach ($readpost as $post): ?>
                <div class="row">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s8">
                                <?= $post->getPostUsername();?>
                            </div>
                            <div class="col s4">
                                <?= $post->getPostDate();?>
                            </div>
                        </div>
                        <div class="divider row"></div>
                        <?= $post->getPostDesc();?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php require('includes/footer.php'); ?>
</body>

</html>
