<html>

<head>
    <?php require('includes/header.php'); ?>
</head>

<body>
    <?php require('includes/nav.php'); ?>
        <div class='container'>
            <div class="row">
                <div class="col s6 offset-s3">
                    <?php require('includes/createpost.php'); ?>
                    <?php foreach ($readpost as $post): ?>
                        <div class="row">
                           <div class="card">
                               <?= $post->getPostCont(); ?>
                           </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php require('includes/footer.php'); ?>
</body>

</html>
