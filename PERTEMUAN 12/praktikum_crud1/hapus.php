<?php
// Include koneksi database
include_once("config.php");

// Validasi ID yang dikirim
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Cek apakah data ada
    $cek = mysqli_query($conn, "SELECT id FROM warga WHERE id=$id");
    if (mysqli_num_rows($cek) > 0) {
        // Hapus data
        mysqli_query($conn, "DELETE FROM warga WHERE id=$id");
        header("Location: index.php?pesan=hapus");
        exit();
    }
}

// Jika ID tidak valid / tidak ditemukan
header("Location: index.php");
exit();
?>
