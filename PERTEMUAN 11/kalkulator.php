<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator JavaScript</title>
</head>
<body>

    <h2>Kalkulator Sederhana</h2>

    <label>Bilangan Pertama :</label>
    <input type="number" id="angka1">
    <br><br>

    <label>Bilangan Kedua :</label>
    <input type="number" id="angka2">
    <br><br>

    <button onclick="tambah()">Tambah</button>
    <button onclick="kurang()">Kurang</button>
    <button onclick="kali()">Kali</button>
    <button onclick="bagi()">Bagi</button>

    <h3>Hasil : <span id="hasil"></span></h3>

    <script>

        function tambah() {

            let angka1 = parseFloat(document.getElementById("angka1").value);
            let angka2 = parseFloat(document.getElementById("angka2").value);

            let hasil = angka1 + angka2;

            document.getElementById("hasil").innerHTML = hasil;
        }

        function kurang() {

            let angka1 = parseFloat(document.getElementById("angka1").value);
            let angka2 = parseFloat(document.getElementById("angka2").value);

            let hasil = angka1 - angka2;

            document.getElementById("hasil").innerHTML = hasil;
        }

        function kali() {

            let angka1 = parseFloat(document.getElementById("angka1").value);
            let angka2 = parseFloat(document.getElementById("angka2").value);

            let hasil = angka1 * angka2;

            document.getElementById("hasil").innerHTML = hasil;
        }

        function bagi() {

            let angka1 = parseFloat(document.getElementById("angka1").value);
            let angka2 = parseFloat(document.getElementById("angka2").value);

            let hasil = angka1 / angka2;

            document.getElementById("hasil").innerHTML = hasil;
        }

    </script>

</body>
</html>