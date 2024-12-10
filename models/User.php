<?php
require_once 'config/db.php';  // Menyertakan file koneksi database

class User {
    public static function create($username, $password) {
        global $conn;  // Menggunakan koneksi yang sudah disertakan
        $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $username, $password);  // Binding parameter untuk query
        $stmt->execute();
    }

    public static function findByUsername($username) {
        global $conn;  // Menggunakan koneksi yang sudah disertakan
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);  // Binding parameter untuk query
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();  // Mengembalikan data pengguna jika ada
    }
}
?>
