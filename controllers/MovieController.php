<?php
require_once 'models/Movie.php';

class MovieController {
    public function index() {
        $movie = Movie::getAll(); 
        include 'views/home.php';
    }

    public function detail($id) {
        $movie = Movie::findById($id);
        require 'views/detail.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $director = $_POST['director'];
            $releaseDate = $_POST['release_date'];
            $duration = $_POST['duration'];
            $synopsis = $_POST['synopsis'];
    
            // Handle file upload
            $poster = $_FILES['poster']['name'];
            $targetDir = "uploads/"; 
            $targetFile = $targetDir . basename($poster); 
    
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
    
            if (move_uploaded_file($_FILES['poster']['tmp_name'], $targetFile)) {
                echo "File successfully uploaded.";
            } else {
                echo "File upload failed.";
            }
    
            Movie::create($title, $genre, $director, $releaseDate, $duration, $synopsis, $poster);
    
            header('Location: index.php?action=home');
            exit();
        } else {
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
        header('Location: index.php?action=home'); 
        exit();
    }    
}
?>

