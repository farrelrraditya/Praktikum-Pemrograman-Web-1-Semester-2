<!DOCTYPE html>
<html>
<head>
    <title>Hitung IMT</title>
</head>
<body>

<?php

function hitungIMT($berat, $tinggi)
{
    $tinggiMeter = $tinggi / 100;

    $imt = $berat / ($tinggiMeter * $tinggiMeter);

    if ($imt < 18.5) {
        $kategori = "Kurus";
    } elseif ($imt >= 18.5 && $imt < 25) {
        $kategori = "Normal";
    } elseif ($imt >= 25 && $imt < 30) {
        $kategori = "Gemuk";
    } else {
        $kategori = "Obesitas";
    }

    return [$imt, $kategori];
}

$berat = 70;
$tinggi = 170;

$hasil = hitungIMT($berat, $tinggi);

?>

<h2>Hasil Perhitungan IMT</h2>

<p>Berat Badan : <?php echo $berat; ?> kg</p>
<p>Tinggi Badan : <?php echo $tinggi; ?> cm</p>
<p>Nilai IMT : <?php echo round($hasil[0], 2); ?></p>
<p>Kategori : <?php echo $hasil[1]; ?></p>

</body>
</html>