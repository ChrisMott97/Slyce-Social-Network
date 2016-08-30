<?php

class User {
    private $userid;
    private $username;
    private $firstname;
    private $lastname;
    private $email;
    private $isadmin;
    private $isnew;
    private $bio;
    private $password;
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getFullname(){
        return $this->firstname . ' ' . $this->lastname;
    }
    
    public function getUserID(){
        return $this->userid;
    }
}