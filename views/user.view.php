<html>

<head>
    <?php require('includes/header.php'); ?>
    <title>Slyce Public Wall</title>
</head>

<body>
    <?php require('includes/nav.php'); ?>
    <div class='.container'>
        <div class="row">
            <div class="col l2 s12 offset-l2">
                <div class="row center">
                   <div class="card"><h4><?= $viewuser->getUsername();?></h4></div>
               </div>
                <div class="row">
                    <div class="card-panel profile">
                        <div class="row">
                            <div class="profilepic"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card-panel center profile">
                        <div class="row">Bio</div>
                        <div class="divider"></div>
                        <br>
                        <div class="row"><?= $viewuser->getBio();?></div>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <?php if(isset($readpost)){foreach ($readpost as $post): ?>
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
                <?php endforeach;} ?>
            </div>
        </div>
    </div>
    <?php require('includes/footer.php'); ?>
</body>

</html>
