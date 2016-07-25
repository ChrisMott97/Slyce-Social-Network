<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: index.php'); }
?>

<html>
<head>
    
    <title> Settings </title>
    <link rel="stylesheet" href="style/main.css">
<link rel="stylesheet" href="style/materialize.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    
    <body>
    
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<?php include('includes/navigation.php');?>
        
        <?php
if(isset($_POST['submit'])){ 

try {
  $stmt = $db->prepare('UPDATE members SET bio = :bio WHERE username = "'.$user->get_username().'"'); 
  $stmt->execute(array(
     ':bio' => $_POST['bio']
  ));
  //redirect to profile page
  header('Location: profile.php');
  exit;
} catch(PDOException $e) {
  echo $e->getMessage();
}
    
}
?>
 <div class="row">
    <div class="input-field col s6">
<form action='' method='post'>
   Edit Bio: <input type="text" name="bio"><br>
   <button class="btn waves-effect waves-light" type="submit" name="submit">Save Changes
    <i class="material-icons right">send</i>
  </button>
</form>
        </div>
        </div>
    
        
    </body>
</html>