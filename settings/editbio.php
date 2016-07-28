<script>
$("#editbio").hide().fadeIn(750);
</script>
<?php
if(isset($_POST['submit'])){
    try {
        $stmt = $db->prepare('UPDATE members SET bio = :bio WHERE username = :username');
        $stmt->bindValue(':username', $user->get_username());
        $stmt->bindValue(':bio', $_POST['bio']);
        $stmt->execute();
        
        //redirect to profile page
        header('Location: profile.php');
        exit;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

}
?>
<div class="wrapper">
    <div class="posts">
        <div class="row">
            <div class="input-field col s12">
                <form action='' method='post'>
                    Edit Bio: <input type="text" name="bio"><br>
                    <button class="btn waves-effect waves-light" type="submit" name="submit">Save Changes
                    <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
