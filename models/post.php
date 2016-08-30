<?php

class Post
{
    private $postid;
    private $userid;
    private $postcont;
    private $postdesc;
    private $canexpand;
    private $postdate;
    
    private $user;
    private $query;
    
    public function __construct($user = null, $query = null){
        $this->user = $user;
        $this->query = $query;
        
    }
    
    public function setNew($postcont){
        $this->userid = $this->user->getUserID();
        $this->postcont = $postcont;
        $this->postdesc = $postcont;
        $this->canexpand = 0;
        $this->postdate = date('Y-m-d H:i:s');
    }
    
    public function setRead($postid, $userid, $postcont, $postdesc, $canexpand, $postdate){
        $this->postid = $postid;
        $this->userid = $userid;
        $this->postcont = $postcont;
        $this->postdesc = $postdesc;
        $this->canexpand = $canexpand;
        $this->postdate = $postdate;
    }
    
    public function getPostID(){
        return $this->postid;
    }
    
    public function getUserID(){
        return $this->userid;
    }
    
    public function getPostCont(){
        return $this->postcont;
    }
    
    public function getPostDesc(){
        return $this->postdesc;
    }
    
    public function getCanExpand(){
        return $this->canexpand;
    }
    
    public function getPostDate(){
        return $this->postdate;
    }
    
    public function getPostUsername(){
        return $this->query->idToUsername($this->getUserID());
    }
    
}