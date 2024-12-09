<?php

// Include controller
include 'controllers/MovieController.php';
include 'controllers/UserController.php';

session_start();

// Periksa apakah ada action di parameter URL
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
            $movieController = new MovieController($conn); // Pass koneksi ke konstruktor
            $movieController->home();
            break;

        case 'detail':
            $movieController = new MovieController($conn); // Pass koneksi ke konstruktor
            $movieController->detail($_GET['id']);
            break;

        case 'addMovie':
            $movieController = new MovieController($conn); // Pass koneksi ke konstruktor
            $movieController->addMovie();
            break;

        case 'updateMovie':
            $movieController = new MovieController($conn); // Pass koneksi ke konstruktor
            $movieController->updateMovie();
            break;

        case 'deleteMovie':
            $movieController = new MovieController($conn); // Pass koneksi ke konstruktor
            $movieController->deleteMovie($_GET['id']);
            break;

        case 'logout':
            $userController = new UserController();
            $userController->logout();
            break;
    }
} else {
    header('Location: view/login.php');
    // Jika tidak ada action, arahkan ke halaman home
    $movieController = new MovieController($conn); // Pass koneksi ke konstruktor
    $movieController->home();
}
?>
