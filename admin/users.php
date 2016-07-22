<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['deluser'])){ 

    //if user id is 1 ignore
    if($_GET['deluser'] !='thatpianoguyx'){

        $stmt = $db->prepare('DELETE FROM members WHERE username = :username') ;
        $stmt->execute(array(':username' => $_GET['deluser']));

        header('Location: users.php?action=deleted');
        exit;

    }
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
  <script language="JavaScript" type="text/javascript">
  function deluser(u, title)
  {
      if (confirm("Are you sure you want to delete '" + title + "'"))
      {
          window.location.href = 'users.php?deluser=' + u;
      }
  }
  </script>
</head>
<body>

    <div id="wrapper">

    <?php include('menu.php');?>

    <?php 
    //show message from add / edit page
    if(isset($_GET['action'])){ 
        echo '<h3>User '.$_GET['action'].'.</h3>'; 
    } 
    ?>

    <table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php
        try {

            $stmt = $db->query('SELECT username, firstName, lastName, email FROM members ORDER BY username');
            while($row = $stmt->fetch()){
                
                echo '<tr>';
                echo '<td>'.$row['firstName'].'</td>';
                echo '<td>'.$row['lastName'].'</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                ?>

                <td>
                    <a href="edit-user.php?u=<?php echo $row['username'];?>">Edit</a> 
                    <?php if($row['username'] != 1){?>
                        | <a href="javascript:deluser('<?php echo $row['username'];?>','<?php echo $row['username'];?>')">Delete</a>
                    <?php } ?>
                </td>
                
                <?php 
                echo '</tr>';

            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    ?>
    </table>

    <p><a href='add-user.php'>Add User</a></p>

</div>

</body>
</html>