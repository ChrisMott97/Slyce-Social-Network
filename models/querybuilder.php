<?php

class QueryBuilder
{
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function create($table, $properties, $values){
        
        foreach($properties as $property){
            $proplist = $proplist.$property.',';
        }
        $proplist = trim($proplist, ",");
        
        foreach($properties as $property){
            $bindlist = ':'.$bindlist.$property.',';
        }
        $bindlist = trim($bindlist, ",");
        
        foreach($values as $value){
            $valuelist = $valuelist.$value.',';
        }
        $valuelist = trim($valuelist, ",");
        
        $propvalue = array_combine($properties, $values);
        
        $stmt = $this->db->prepare("INSERT INTO $table ($proplist) VALUES ($bindlist)");
        foreach($propvalue as $property => $value){
            $stmt->bindParam(':'.$property, $value);
        }
        $stmt->execute();
    }
    
    public function read($field, $table, $relation, $relvalue){
        $stmt = $this->db->prepare("SELECT $field FROM $table WHERE $relation = :$relation");
        $stmt->bindParam(":$relation", $relvalue);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row[$field];
    }
    
    public function update($table, $property, $propvalue, $relation, $relvalue){
        $stmt = $this->db->prepare("UPDATE $table SET $property = :$property WHERE $relation = :$relation");
        $stmt->bindParam(":$property", $propvalue);
        $stmt->bindParam(":$relation", $relvalue);
        $stmt->execute();
    }
    
    public function delete($table, $relation, $relvalue){
        $stmt = $this->db->prepare("DELETE FROM $table WHERE $relation = :$relation");
        $stmt->bindParam(":$relation", $relvalue);
        $stmt->execute();
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
    
    public function updateUser($userid, $property, $value){
        $stmt = $this->db->prepare('UPDATE users SET '.$property.' = :value WHERE userid = :userid');
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
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