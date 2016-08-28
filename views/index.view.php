<html>

<head>
    <?php require('includes/header.php'); ?>
        <link rel='stylesheet' type='text/css' href='public/css/index.css'>
</head>

<body>
    <div class='container'>
        <div class='row'>
            <div class='col s4 offset-s4 main'>
                <span class="center title"><h1>Slyce</h1></span>
                <div class="card-panel">
                    <div class="row">
                        <form class="col s12">
                            <div class="row center">
                                <h4>Login</h4></div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" class="validate">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" class="validate">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Login
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('includes/footer.php'); ?>
</body>

</html>
