<?php

class QueryBuilder
{
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function fetchPassword($email, $password){
        $stmt = $db->prepare('SELECT password FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $row = $stmt->execute();
        $row->fetch();
        return $row;
    }
    
    public function emailToID($email){
        $stmt = $db->prepare('SELECT userid FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $row = $stmt->execute();
        $row->fetch();
        return $row;
    }
    
    public function findUser($userid){
        $stmt = $db->prepare('SELECT * FROM users WHERE userid = :userid');
        $stmt->bindParam(':userid', $userid);
        $row = $stmt->execute();
        return $row->fetch(PDO::FETCH_CLASS, 'User');
    }
}