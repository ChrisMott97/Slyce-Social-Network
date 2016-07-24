<div id="createPost">
    <?php
    //When the user accepts the rules, db is updated to show they're not a new user anymore
    if(isset($_POST['accept'])){
        try {
            $stmt = $db->prepare('UPDATE members SET isNew = 0 WHERE username="'.$user->get_username().'"');
            $stmt->execute();
            $isNew = 0;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    //When post button pressed, various functions then add to database
    if(isset($_POST['submit'])){
        
        $_POST = array_map( 'stripslashes', $_POST );
        $canExpand = 0;
            
        function truncate($string,$length=300,$append="&hellip;") {
            $string = trim($string);
            
            if(strlen($string) > $length) {
                $string = wordwrap($string, $length);
                $string = explode("\n", $string, 2);
                $string = $string[0] . $append;
                $GLOBALS['canExpand']=1;
            }                        
            return $string;
        }
            
        //collect form data
        $postCont = $_POST['postCont'];
        $postDesc = truncate($postCont);

        //very basic validation
            
        if($postCont ==''){
            $error[] = 'Please enter the content.';
        }

        if(!isset($error)){
            try {       
                //insert into database
                $stmt = $db->prepare('INSERT INTO posts (postDesc,postCont,postDate,username,canExpand) VALUES (:postDesc, :postCont, :postDate, :username, :canExpand)') ;
                $stmt->execute(array(
                    ':postDesc' => $postDesc,
                    ':postCont' => $postCont,
                    ':postDate' => date('Y-m-d H:i:s'),
                    ':username' => $user->get_username(),
                    ':canExpand' => $canExpand
                ));
                    
                //redirect to index page
                header("Refresh:0");
                exit;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }
    
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="error">'.$error.'</p>';
        }
    }
    
    ?>
    <script>
        <?php
            try {
                $stmt = $db->query('SELECT isNew FROM members WHERE username="'.$user->get_username().'"');
                $row = $stmt->fetch();
                $isNew = $row['isNew'];
            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        ?>
        $(document).ready (function(){
            var isNew=<?php echo json_encode($isNew);?>;
            if (isNew == 1){
                //$("#postbutton").attr({"class":"btn disabled"});
                //$("#postbutton").prop("disabled", true);
                $('#rules').openModal();
                $("#postbutton").attr({"type":"","name":"","class":"btn waves-effect waves-light tooltipped","data-position":"bottom","data-delay":50,"data-tooltip":"You can't post until you agree to the rules!"});
                $("#postbutton").text("Rules");
                $("#postbutton").attr({"id":"rulesbutton"});
                $('.tooltipped').tooltip({delay: 50});
            };
        });
        
        $("#rulesbutton").click(function(){
            $('#rules').openModal();
        });
        
        $("#agreebutton").click(function(){
            $("#rulesbutton").attr({"id":"postbutton"});
            $("#postbutton").text("Post");
            $("#postbutton").attr({"type":"submit","name":"submit","class":"btn waves-effect waves-light"});
            isNew=0;
        });
        
    </script>
    <div id="rules" class="modal">
        <div class="modal-content">
            <h4>Remember</h4>
            <ul class="collection">
                <li class="collection-item">Think before you post. Is this post going to negatively affect someone?</li>
                <li class="collection-item">Never post your own or someone else's private information, this includes passwords.</li>
                <li class="collection-item">Do not post inappropriate content, remember that there are younger users on the site.</li>
                <li class="collection-item">Violation of these rules could result in the post being deleted or the account being terminated indefinitely (until further notice).</li>
            </ul>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Disagree</a>
            <form action='' method='post'>
                <button id="agreebutton" type="accept" name="accept" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</button>
            </form>
        </div>
    </div>
    <div class="row">
        <form class="col s12" action='' method='post'>
            <div class="row">
                <div class="input-field col s12">
                  <textarea name="postCont" id="textarea1" class="materialize-textarea"><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea>
                  <label for="textarea1">Post</label>
                </div>
                <button id="postbutton" class="btn waves-effect waves-light" type="submit" name="submit">Post<i class="material-icons right">send</i></button>
            </div>
        </form>
    </div>                      
</div>