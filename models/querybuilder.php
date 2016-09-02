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
    
    public function idToUsername($userid){
        $stmt = $this->db->prepare('SELECT username FROM users WHERE userid = :userid');
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['username'];
    }
    
    public function usernameToID($username){
        $stmt = $this->db->prepare('SELECT userid FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
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
    
    public function checkUsername($username){
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function checkEmail($email){
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function allPosts(){
        $stmt = $this->db->prepare('SELECT * FROM posts ORDER BY postid DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function allUsers(){
        $stmt = $this->db->prepare('SELECT * FROM users ORDER BY userid DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function userPosts($userid){
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE userid = :userid ORDER BY postid DESC');
        $stmt->bindParam(':userid', $userid);
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
    
    public function pushUser($user){
        $stmt = $this->db->prepare('INSERT INTO 
        users (firstname, lastname, username, password, email) 
        VALUES(:firstname, :lastname, :username, :password, :email)');
        $stmt->bindParam(':firstname', $user->getFirstname());
        $stmt->bindParam(':lastname', $user->getLastname());
        $stmt->bindParam(':username', $user->getUsername());
        $stmt->bindParam(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->execute();
    }
    
    
}