<div class="container">
    <div class="cover">
        <h1 class="cover-heading">Slyce</h1>
        <h2><a href="#" class="allbtns">Login</a></h2>
    </div>
    <div id="login">

        <?php

            //process login form if submitted
            if(isset($_POST['submit'])){

                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
        
                if($user->login($email,$password)){ 

                    //logged in return to index page
                    header('Location: index.php');
                    exit;
        

                } else {
                    $message = '<p class="error">Wrong email or password</p>';
                }

            }//end if submit

            if(isset($message)){ echo $message; }
            ?>

            <form action="" method="post">
                <p>
                    <input type="text" placeholder="email" name="email" value="" />
                </p>
                <p>
                    <input type="password" placeholder="password" name="password" value="" />
                </p>
                <p>
                    <input type="submit" name="submit" value="Login" />
                </p>
            </form>

    </div>

</div>
<div class="mastfoot">
    <p>Slyce Copyright &copy; 2016 </p>
    <p>Founded by Chris Mott, Alfie Llewellyn & Haydn Jones</p>
</div>
