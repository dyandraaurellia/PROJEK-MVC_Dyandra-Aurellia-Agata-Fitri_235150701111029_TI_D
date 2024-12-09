<?php
include_once 'models/User.php';

class UserController {
    public function home() {
        session_start();
    
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
            $loggedIn = true;
        } else {
            $loggedIn = false;
        }
    
        include 'view/home.php';
    }
    
    
    public function register() {
        $error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $userModel = new User();
            if ($userModel->checkEmail($email)) {
                $error = "Email sudah terdaftar.";
            } else {
                if ($userModel->registerUser($username, $email, $password)) {
                    header("Location: index.php?action=login");
                    exit();
                } else {
                    $error = "Gagal melakukan pendaftaran.";
                }
            }
        }
        include 'view/register.php';
    }

    public function login() {
        $error = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new User();
            if ($userModel->loginUser($username, $password)) {
                $_SESSION['username'] = $username;
                $_SESSION['loggedIn'] = true;

                header("Location: index.php?action=home");
                exit();
            } else {
                $error = "Username atau password salah.";
            }
        }
        include 'view/login.php';
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}
?>
