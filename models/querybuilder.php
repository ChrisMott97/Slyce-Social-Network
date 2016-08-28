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
}