<?php

class QueryBuilder
{
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function fetchPassword($email){
        $stmt = $this->db->prepare('SELECT password FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['password'];
    }
    
    public function emailToID($email){
        $stmt = $this->db->prepare('SELECT userid FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['userid'];
    }
    
    
    public function findUser($userid){
        $stmt = $this->db->prepare('SELECT * FROM users WHERE userid = :userid');
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }
    
    public function allPosts(){
        $stmt = $this->db->prepare('SELECT * FROM posts');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function pushPost($post){
        $stmt = $this->db->prepare('INSERT INTO 
        posts (userid, postcont, postdesc, canexpand, postdate) 
        VALUES(:userid, :postcont, :postdesc, :canexpand, :postdate)');
        $stmt->bindParam(':userid', $post->getUserID());
        $stmt->bindParam(':postcont', $post->getPostCont());
        $stmt->bindParam(':postdesc', $post->getPostDesc());
        $stmt->bindParam(':canexpand', $post->getCanExpand());
        $stmt->bindParam(':postdate', $post->getPostDate());
        $stmt->execute();
    }
    
    
}