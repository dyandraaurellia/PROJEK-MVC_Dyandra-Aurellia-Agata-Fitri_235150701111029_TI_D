<?php

session_start();
$conn = require 'config/db.php';
require_once 'models/Movie.php';
// Set koneksi database ke Movie class
Movie::setConnection($conn);

// Include controllers
require_once 'controllers/MovieController.php';
require_once 'controllers/UserController.php';
// Jika pengguna belum login dan mencoba mengakses selain login atau register, arahkan ke halaman login
if (!isset($_SESSION['user']) && (!isset($_GET['action']) || !in_array($_GET['action'], ['login', 'register']))) {
    header('Location: index.php?action=login');
    exit();
}

// Jika pengguna sudah login dan mencoba mengakses login atau register, arahkan ke halaman home
if (isset($_SESSION['user']) && isset($_GET['action']) && in_array($_GET['action'], ['login', 'register'])) {
    header('Location: index.php?action=home');
    exit();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'login':
            $userController = new UserController();
            $userController->login();
            break;

        case 'register':
            $userController = new UserController();
            $userController->register();
            break;

        case 'home':
            $movieController = new MovieController();
            $movieController->index(); // Memanggil halaman home
            break;

        case 'detail':
            $movieController = new MovieController();
            if (isset($_GET['id'])) {
                $movieController->detail($_GET['id']);
            } else {
                echo "ID tidak ditemukan.";
            }
            break;

        case 'addMovie':
            $movieController = new MovieController();
            $movieController->add();
            break;

        case 'update':
                // Menangani action update
                if (isset($_GET['id'])) {
                    $movieController = new MovieController();
                    $movieController->update($_GET['id']);
                } else {
                    echo "ID tidak ditemukan.";
                }
                break;

        case 'delete':
            $movieController = new MovieController();
            if (isset($_GET['id'])) {
                $movieController->delete($_GET['id']);
            } else {
                echo "ID tidak ditemukan.";
            }
            break;

        case 'logout':
            $userController = new UserController();
            $userController->logout();
            break;

        default:
            echo "Action tidak valid.";
            break;
    }
} else {
    // Default ke halaman home
    $movieController = new MovieController();
    $movieController->index();
}
?>
