<?php
require_once 'config/db.php';

class Movie {
    private static $conn;
    public static function setConnection($dbConn) {
        self::$conn = $dbConn;
    }

    public static function getAll() {
        global $conn; 
        $sql = 'SELECT * FROM movies';
        $result = $conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; 
        }
    }

    public static function findById($id) {
        global $conn;
        $sql = 'SELECT * FROM movies WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public static function create($title, $genre, $director, $releaseDate, $duration, $synopsis, $poster) {
        global $conn;
        $sql = 'INSERT INTO movies (title, genre, director, release_date, duration, synopsis, poster_url) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssiss', $title, $genre, $director, $releaseDate, $duration, $synopsis, $poster);
        $stmt->execute();
    }
    

    public static function update($id, $title, $genre, $director, $releaseDate, $duration, $synopsis, $poster) {
        global $conn; 
        $sql = "UPDATE movies SET title=?, genre=?, director=?, release_date=?, duration=?, synopsis=?, poster_url=? WHERE id=?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param('sssssssi', $title, $genre, $director, $releaseDate, $duration, $synopsis, $poster, $id);
        return $stmt->execute();
    }
    

    public static function delete($id) {
        global $conn;
        $sql = 'DELETE FROM movies WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}
?>
