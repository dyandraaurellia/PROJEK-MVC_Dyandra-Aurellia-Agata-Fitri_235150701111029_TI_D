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
            $_SESSION['user'] = $user['username']; 
            header('Location: index.php?action=home'); 
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        require 'views/login.php';
    }
}

    public function logout() {
    session_start();
    session_destroy();
    header('Location: index.php'); 
    exit();
}

}
?>
