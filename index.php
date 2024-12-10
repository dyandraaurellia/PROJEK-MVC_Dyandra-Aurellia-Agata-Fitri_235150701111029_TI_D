<?php

session_start();
$conn = require 'config/db.php';
require_once 'models/Movie.php';
Movie::setConnection($conn);

require_once 'controllers/MovieController.php';
require_once 'controllers/UserController.php';

if (!isset($_SESSION['user']) && (!isset($_GET['action']) || !in_array($_GET['action'], ['login', 'register']))) {
    header('Location: index.php?action=login');
    exit();
}

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
            $movieController->index(); 
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
    $movieController = new MovieController();
    $movieController->index();
}
?>
