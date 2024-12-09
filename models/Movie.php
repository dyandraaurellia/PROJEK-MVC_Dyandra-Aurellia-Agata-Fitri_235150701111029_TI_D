<?php

class Movie {
    // Menambahkan film baru ke database
    public static function addMovie($conn, $title, $genre, $director, $release_date, $poster_url) {
        $sql = "INSERT INTO movies (title, genre, director, release_date, poster_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $genre, $director, $release_date, $poster_url);
        if ($stmt->execute()) {
            return true;
        } else {
            // Jika terjadi kesalahan saat eksekusi, tampilkan pesan error
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    // Mengambil semua film dari database
    public static function getAllMovies($conn) {
        $sql = "SELECT * FROM movies";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Mengambil semua hasil query dan mengembalikannya dalam bentuk array
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; // Kembalikan array kosong jika tidak ada hasil
        }
    }

    // Mengambil film berdasarkan ID
    public static function getMovieById($conn, $id) {
        $sql = "SELECT * FROM movies WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Mengupdate detail film
    public static function updateMovie($conn, $id, $title, $genre, $director, $release_date, $poster_url) {
        $sql = "UPDATE movies SET title = ?, genre = ?, director = ?, release_date = ?, poster_url = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $genre, $director, $release_date, $poster_url, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    // Menghapus film berdasarkan ID
    public static function deleteMovie($conn, $id) {
        $sql = "DELETE FROM movies WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }
}
?>
