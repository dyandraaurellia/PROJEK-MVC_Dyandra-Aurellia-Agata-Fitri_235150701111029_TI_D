<?php
include 'config/db.php'; // Include the database connection

class User {
    private $conn;

    public function __construct() {
        $this->conn = $GLOBALS['conn']; // Using the global DB connection
    }

    // Check if email already exists
    public function checkEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Return true if email exists
    }

    // Register a new user
    public function registerUser($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        return $stmt->execute(); // Return true if successful
    }

    // Login user
    public function loginUser($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return true; // Login berhasil
            } else {
                echo "Password salah.";
            }
        } else {
            echo "Username tidak ditemukan.";
        }
        return false; // Login gagal
    }
}
?>
