<?php
$host = "localhost";
$username = "root"; // Sesuaikan username database Anda
$password = "";     // Sesuaikan password database Anda
$dbname = "bioskop"; // Sesuaikan nama database Anda

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
