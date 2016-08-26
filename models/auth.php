<?php

class Auth
{
    private $query;
    
    public function __construct($query){
        $this->query = $query;
    }
    
    public function login($email, $password){
        $hashed = $this->query->fetchPassword();
        if($hashed && password_verify($password, $hashed)){
            $_SESSION['userid'] = $this->query->emailToID($email);
            $_SESSION['loggedin'] = true;
            return true;
        }
        else{
            echo 'Authentication Error!';
        }
    }
    
    public function isLoggedIn(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function logout(){
        $_SESSION['loggedin'] = false;
        $_SESSION['userid'] = false;
        session_unset();
        session_destroy();
        header('Location: /index.php');
    }
    
    public function fetchUser(){
        return $this->query->findUser($_SESSION['userid']);
    }
}