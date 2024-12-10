<?php
require_once 'models/Movie.php';

class MovieController {
    public function index() {
        $movie = Movie::getAll(); // Ambil semua data film
        include 'views/home.php'; // Kirim data ke view
    }

    public function detail($id) {
        $movie = Movie::findById($id);
        require 'views/detail.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $director = $_POST['director'];
            $releaseDate = $_POST['release_date'];
            $duration = $_POST['duration'];
            $synopsis = $_POST['synopsis'];
    
            // Handle file upload
            $poster = $_FILES['poster']['name'];
            $targetDir = "uploads/"; // Direktori tempat file di-upload
            $targetFile = $targetDir . basename($poster); // Path lengkap untuk file yang di-upload
    
            // Pastikan direktori 'uploads/' ada, jika belum buat
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
    
            // Upload file ke direktori 'uploads/'
            if (move_uploaded_file($_FILES['poster']['tmp_name'], $targetFile)) {
                echo "File successfully uploaded.";
            } else {
                echo "File upload failed.";
            }
    
            // Panggil method untuk menyimpan data film ke database
            Movie::create($title, $genre, $director, $releaseDate, $duration, $synopsis, $poster);
    
            // Redirect ke halaman utama setelah berhasil menambahkan film
            header('Location: index.php?action=home');
            exit();
        } else {
            // Tampilkan form untuk menambahkan film
            require_once 'views/addMovie.php';
        }
    }
    
    
    public function update($id) {
        $movie = Movie::findById($id);
        if (!$movie) {
            die('Movie not found!');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $director = $_POST['director'];
            $releaseDate = $_POST['release_date'];
            $duration = $_POST['duration'];  
            $synopsis = $_POST['synopsis'];  

            $poster = $movie['poster_url'];

            if (!empty($_FILES['poster']['name'])) {
                $poster = $_FILES['poster']['name'];
                move_uploaded_file($_FILES['poster']['tmp_name'], "uploads/" . $poster);
            }

            Movie::update($id, $title, $genre, $director, $releaseDate, $duration, $synopsis, $poster);
            header('Location: index.php');
        } else {
            require 'views/update.php';
        }
    }

    public function delete($id) {
        Movie::delete($id);
        header('Location: index.php?action=home'); // Arahkan ke halaman daftar film setelah delete
        exit();
    }    
}
?>

