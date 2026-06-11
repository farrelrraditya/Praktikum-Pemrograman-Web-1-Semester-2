<!DOCTYPE html>
<html>
<head>
    <title>Bulan dan Sisa Hari</title>
</head>
<body>

<?php

$namaBulan = date("F");

$hariIni = date("d");

$totalHari = date("t");

$sisaHari = $totalHari - $hariIni;

?>

<h2>Informasi Bulan Sekarang</h2>

<p>Nama Bulan : <?php echo $namaBulan; ?></p>
<p>Sisa Hari di Bulan Ini : <?php echo $sisaHari; ?> hari</p>

</body>
</html>
