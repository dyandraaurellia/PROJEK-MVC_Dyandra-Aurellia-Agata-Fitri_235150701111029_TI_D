<?php
require_once 'models/User.php';

class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            User::create($username, $password);
            header('Location: index.php');
        } else {
            require 'views/register.php';
        }
    }

    public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = User::findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user['username']; // Menyimpan username ke session
            header('Location: index.php?action=home'); // Arahkan ke halaman home
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        require 'views/login.php'; // Tampilkan halaman login
    }
}

    public function logout() {
    session_start();
    session_destroy(); // Menghancurkan sesi
    header('Location: index.php'); // Arahkan ke halaman utama setelah logout
    exit();
}

}
?>
