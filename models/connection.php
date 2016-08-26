<?php

class Connection 
{
    
    public function create()
    {
        session_start();
        try {
            return new PDO('mysql:host=eu-cdbr-azure-west-d.cloudapp.net;dbname=slyce', 'b6cae1712ef518', 'e7617697');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
}