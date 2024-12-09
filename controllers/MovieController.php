<?php
// Mengimpor kelas Movie
require_once 'models/Movie.php';


class MovieController {
    
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn; // Menginisialisasi koneksi database
    }

    public function home() {
        // Ambil semua film dari database dan simpan dalam variabel
        $movies = Movie::getAllMovies($this->conn); // Pastikan fungsi ini mengembalikan data yang benar
        include 'view/home.php'; // Pastikan variabel $movies diteruskan ke view
    }
    

    public function detail($id) {
        // Method detail sebagai pengganti showMovieDetails
        if (isset($id) && !empty($id)) {
            $movie = Movie::getMovieById($id, $this->conn); // Lewatkan koneksi database
            if ($movie) {
                include 'view/detail.php'; // Pastikan file view/detail.php ada
            } else {
                echo "Film tidak ditemukan.";
            }
        } else {
            echo "ID film tidak valid.";
        }
    }

    public function addMovie() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form
            $title = $_POST['title'] ?? '';
            $genre = $_POST['genre'] ?? '';
            $director = $_POST['director'] ?? '';
            $release_date = $_POST['release_date'] ?? '';
            $poster = $_FILES['poster']['name'] ?? '';
            $target = "uploads/" . basename($poster);

            if (!empty($poster)) {
                move_uploaded_file($_FILES['poster']['tmp_name'], $target);
            }

            Movie::addMovie($title, $genre, $director, $release_date, $poster, $this->conn); // Lewatkan koneksi database
            header("Location: index.php?action=home");
            exit;
        } else {
            include 'view/addMovie.php'; // Pastikan file view/addMovie.php ada
        }
    }

    public function updateMovie($id) {
        if (isset($id) && !empty($id)) {
            $movie = Movie::getMovieById($id, $this->conn); // Lewatkan koneksi database

            if (!$movie) {
                echo "Film tidak ditemukan.";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Ambil data dari form
                $title = $_POST['title'] ?? '';
                $genre = $_POST['genre'] ?? '';
                $director = $_POST['director'] ?? '';
                $release_date = $_POST['release_date'] ?? '';
                $poster = $_FILES['poster']['name'] ?? $movie['poster_url'];
                $target = "uploads/" . basename($poster);

                if (!empty($_FILES['poster']['tmp_name'])) {
                    move_uploaded_file($_FILES['poster']['tmp_name'], $target);
                }

                Movie::updateMovie($id, $title, $genre, $director, $release_date, $poster, $this->conn); // Lewatkan koneksi database
                header("Location: index.php?action=home");
                exit;
            } else {
                include 'view/update.php'; // Pastikan file view/update.php ada
            }
        } else {
            echo "ID film tidak valid.";
        }
    }

    public function deleteMovie($id) {
        if (isset($id) && !empty($id)) {
            Movie::deleteMovie($id, $this->conn); // Lewatkan koneksi database
            header("Location: index.php?action=home");
            exit;
        } else {
            echo "ID film tidak valid.";
        }
    }
}
?>
