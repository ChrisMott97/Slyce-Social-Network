<?php

class User{

    private $db;
    
    public function __construct($db){
        $this->db = $db; 
    }


    public function is_logged_in(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            return true;
        }        
    }
    
    public function get_username(){
        $stmt = $this->db->prepare('SELECT username FROM users WHERE userid = :userid');
            $stmt->bindValue(':userid', $_SESSION['userid']);
            $stmt->execute();
            $row = $stmt->fetch();
        return $row['username'];
    }
    
    public function get_userid(){
        return $_SESSION['userid'];
    }

    public function create_hash($value)
    {
        return $hash = crypt($value, '$2a$12.substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22)');
    }

    private function verify_hash($password,$hash)
    {
        return $hash == crypt($password, $hash);
    }

    private function get_user_hash($email){    

        try {

            //echo $this->create_hash('demo');

            $stmt = $this->db->prepare('SELECT password FROM users WHERE email = :email');
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            
            $row = $stmt->fetch();
            return $row['password'];

        } catch(PDOException $e) {
            echo '<p class="error">'.$e->getMessage().'</p>';
        }
    }

    
    public function login($email,$password){    

        $hashed = $this->get_user_hash($email);
        
        if($this->verify_hash($password,$hashed) == 1){
            
            $_SESSION['loggedin'] = true;
            
            $stmt = $this->db->prepare('SELECT userid FROM users WHERE email = :email');
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch();
            $_SESSION['userid'] = $row['userid'];
            return true;
        }        
    }
    
        
    public function logout(){
        session_destroy();
    }
    
}

?>