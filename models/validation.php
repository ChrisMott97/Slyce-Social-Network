<?php

class Validation{
    private $query;
    
    public function __construct($query){
        $this->query = $query;
    }
    public function registerUsername($username){
        if($this->query->checkUsername($username)){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function registerEmail($email){
        if($this->query->checkEmail($email)){
            return false;
        }
        else{
            return true;
        }
    }
}