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
    
    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getEmail(){
        return $this->email;
    }
    
    public function getFullname(){
        return $this->firstname . ' ' . $this->lastname;
    }
    
    public function getBio(){
        return $this->bio;
    }
    
    public function getUserID(){
        return $this->userid;
    }
    
    public function create($firstname, $lastname, $username, $password, $email){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;    
    }
    
    public function setRead($userid, $username, $firstname, $lastname, $email, $isadmin, $isnew, $bio, $password){
        $this->userid = $userid;
        $this->username = $username;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->isadmin = $isadmin;
        $this->isnew = $isnew;
        $this->bio = $bio;
        $this->password = $password;
        
    }
}