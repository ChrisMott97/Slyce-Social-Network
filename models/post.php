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
    
    public function __construct($user = null){
        $this->user = $user;
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
    
    
}