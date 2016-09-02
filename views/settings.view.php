<html>

<head>
    <?php require('includes/header.php'); ?>
    <title>Slyce Public Wall</title>
</head>

<body>
    <?php require('includes/nav.php'); ?>
    <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#editprofile">Edit Profile</a></li>
        <li class="tab col s3 disabled"><a href="#privacy">Privacy</a></li>
        <li class="tab col s3 disabled"><a href="#colours">Colours</a></li>
        <li class="tab col s3 disabled"><a href="#other">Other</a></li>
      </ul>
    </div>
    <div id="editprofile" class="col s12"><?php include('includes/settings/editprofile.php'); ?></div>
  </div>
    <div class='container'>
        <div class="row">
            <div class="col s12 l6 offset-l3 card-panel">
               
            </div>
        </div>
    </div>
    <?php require('includes/footer.php'); ?>
</body>

</html>
