<?php
require_once 'config/db.php'; 

class User {
    public static function create($username, $password) {
        global $conn;  
        $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $username, $password);  
        $stmt->execute();
    }

    public static function findByUsername($username) {
        global $conn;  
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);  
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();  
    }
}
?>
