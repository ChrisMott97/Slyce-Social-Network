<div id="createPost">
        <?php
        //if form has been submitted process it
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
                    $stmt = $db->prepare('INSERT INTO posts (postDesc,postCont,postDate,memberID,canExpand) VALUES (:postDesc, :postCont, :postDate, :memberID, :canExpand)') ;
                    $stmt->execute(array(
                        ':postDesc' => $postDesc,
                        ':postCont' => $postCont,
                        ':postDate' => date('Y-m-d H:i:s'),
                        ':memberID' => $user->get_user_id(),
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
          <div class="row">
            <form class="col s12">
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="textarea1" class="materialize-textarea"></textarea>
                  <label for="textarea1">Textarea</label>
                </div>
              </div>
            </form>
          </div>               
        <form action='' method='post'>
                   
            <textarea name='postCont' cols='100' rows='10' ><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>
    
            <p><input type='submit' name='submit' value='Post'></p>
    
        </form>
                
</div>