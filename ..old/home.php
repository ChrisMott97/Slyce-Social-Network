<!DOCTYPE html>
<html>
    <body>
        <?php
//$username=$password="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
        Welcome, <?php echo $username; ?><br>
    </body>
</html>