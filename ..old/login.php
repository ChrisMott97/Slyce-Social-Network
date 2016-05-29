<!DOCTYPE html>
<html>
<head>
    <title>Social Network</title>
    <link href="login.css" rel=stylesheet>
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,700,300' rel='stylesheet' type='text/css'>
</head>
    <body>
    <div class="background"></div>
    <div class="header">
        <p id="demo"><strong>Social Network</strong></p>
        </div>
    <div id="buttons">
        <form id="login" method="post" action="<?php echo htmlspecialchars("home.php");?>">
        <fieldset>
        <legend>Login:</legend>
            Username:</br>
            <input type="text" name="username" value=""></br>
            Password:</br>
            <input type="password" name="password" value=""></br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
        </form>
    </div>
    <script src="myScript.js"></script>
</html>