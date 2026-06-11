<?php
// Konfigurasi koneksi database
$host     = "localhost";
$username = "root";
$password = ""; // Sesuaikan jika MySQL kamu punya password
$database = "praktikum_crud1";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset agar karakter khusus tidak error
mysqli_set_charset($conn, "utf8");
?>
