<div id="createPost">
    <?php
    //When the user accepts the rules, db is updated to show they're not a new user anymore
    if(isset($_POST['accept'])){
        try {
            $stmt = $db->prepare('UPDATE members SET isnew = :isnew WHERE userid=:userid');
            $stmt->bindValue(':userid', $user->get_userid());
            $stmt->bindValue(':isnew', 0);
            $stmt->execute();
            $isnew = 0;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    //When post button pressed, various functions then add to database
    if(isset($_POST['submit'])){
        
        $_POST = array_map( 'stripslashes', $_POST );
        $canexpand = 0;
            
        function truncate($string,$length=300,$append="&hellip;") {
            $string = trim($string);
            
            if(strlen($string) > $length) {
                $string = wordwrap($string, $length);
                $string = explode("\n", $string, 2);
                $string = $string[0] . $append;
                $GLOBALS['canexpand']=1;
            }                        
            return $string;
        }
            
        //collect form data
        $postcont = $_POST['postcont'];
        $postcont = truncate($postcont);

        //very basic validation
            
        if($postcont ==''){
            $error[] = 'Please enter the content.';
        }

        if(!isset($error)){
            try {       
                //insert into database
                $stmt = $db->prepare('INSERT INTO posts (postdesc, postcont, postdate, userid, canexpand) VALUES (:postdesc, :postcont, :postdate, :userid, :canexpand)') ;
                $stmt->bindValue(':postdesc', $postdesc);
                $stmt->bindValue(':postcont', $postcont);
                $stmt->bindValue(':postdate', date('Y-m-d H:i:s'));
                $stmt->bindValue(':userid', $user->get_userid());
                $stmt->bindValue(':canexpand', $canexpand);
                $stmt->execute();
                    
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
                $stmt = $db->prepare('SELECT isnew FROM users WHERE userid=:userid');
                $stmt->bindValue(':userid', $user->get_userid());
                $stmt->execute();
                $row = $stmt->fetch();
                $isnew = $row['isnew'];
            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        ?>
        $(document).ready (function(){
            var isnew=<?php echo json_encode($isnew);?>;
            if (isnew == 1){
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
            isnew=0;
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
                  <textarea name="postCont" id="textarea1" class="materialize-textarea"><?php if(isset($error)){ echo $_POST['postcont'];}?></textarea>
                  <label for="textarea1">Post</label>
                </div>
                <button id="postbutton" class="btn waves-effect waves-light right" type="submit" name="submit">Post<i class="material-icons right">send</i></button>
            </div>
        </form>
    </div>                      
</div>