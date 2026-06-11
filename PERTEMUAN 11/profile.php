<!DOCTYPE html>
<html>
<head>
    <title>Profil Mahasiswa</title>
</head>
<body>
<?php
$nama = "Farrel Raditya";
$nim = "23xxxxxxxx";
$prodi = "Teknologi Rekayasa Perangkat Lunak";
$asalKota = "Batang";
?>
<h2>Profil Mahasiswa</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Data</th>
        <th>Keterangan</th>
    </tr>
    <tr>
        <td>Nama</td>
        <td><?php echo $nama; ?></td>
    </tr>
    <tr>
        <td>NIM</td>
        <td><?php echo $nim; ?></td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td><?php echo $prodi; ?></td>
    </tr>
    <tr>
        <td>Asal Kota</td>
        <td><?php echo $asalKota; ?></td>
    </tr>
</table>
</body>
</html>