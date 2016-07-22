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
        return $_SESSION['username'];
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

            $stmt = $this->db->prepare('SELECT password FROM members WHERE email = :email');
            $stmt->execute(array('email' => $email));
            
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
            $stmt = $this->db->prepare('SELECT username FROM members WHERE email = :email');
            $stmt->execute(array('email' => $email));
            $row = $stmt->fetch();
            $_SESSION['username'] = $row['username'];
            return true;
        }        
    }
    
        
    public function logout(){
        session_destroy();
    }
    
}

?>