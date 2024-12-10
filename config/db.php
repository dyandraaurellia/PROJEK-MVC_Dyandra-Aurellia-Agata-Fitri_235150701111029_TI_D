<?php
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$dbname = 'bioskop'; 

$conn = new mysqli($host, $user, $password, $dbname); // membuat koneksi dengan database

if ($conn->connect_error) { //mengecek koneksi
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
?>
