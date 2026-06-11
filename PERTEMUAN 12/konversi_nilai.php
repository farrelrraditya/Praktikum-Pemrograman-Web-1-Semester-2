<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Nilai - BAB XIII PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f0f2f5; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }

        /* Warna per grade */
        .grade-a { background-color: #d1fae5; border-left: 5px solid #10b981; color: #065f46; }
        .grade-b { background-color: #dbeafe; border-left: 5px solid #3b82f6; color: #1e3a5f; }
        .grade-c { background-color: #fef9c3; border-left: 5px solid #eab308; color: #713f12; }
        .grade-d { background-color: #ffedd5; border-left: 5px solid #f97316; color: #7c2d12; }
        .grade-e { background-color: #fee2e2; border-left: 5px solid #ef4444; color: #7f1d1d; }

        .grade-box {
            border-radius: 10px;
            padding: 24px 28px;
            margin-top: 20px;
        }
        .grade-letter {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1;
        }
        .nav-link { color: #6c757d; }
        .nav-link.active { color: #000; font-weight: 600; }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <span class="navbar-brand fw-semibold">
            <i class="bi bi-mortarboard me-2"></i>Praktikum PPW1 – BAB XIII PHP
        </span>
        <div class="d-flex gap-3">
            <a href="konversi_nilai.php" class="nav-link active">Konversi Nilai</a>
            <a href="pendataan_mahasiswa.php" class="nav-link">Pendataan Mahasiswa</a>
        </div>
    </div>
</nav>

<div class="container mb-5" style="max-width: 520px;">

    <div class="card mb-4">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-1"><i class="bi bi-calculator me-2 text-secondary"></i>Konversi Nilai</h5>
            <p class="text-muted small mb-3">Masukkan nilai angka (0–100) untuk mengetahui grade huruf dan deskripsinya.</p>

            <form action="konversi_nilai.php" method="POST" novalidate>
                <div class="mb-3">
                    <label class="form-label fw-medium">Nilai Angka</label>
                    <input type="number" name="nilai" class="form-control form-control-lg"
                           placeholder="Contoh: 85"
                           min="0" max="100"
                           value="<?= isset($_POST['nilai']) ? htmlspecialchars($_POST['nilai']) : '' ?>"
                           required>
                    <div class="form-text">Masukkan angka antara 0 sampai 100.</div>
                </div>
                <button type="submit" class="btn btn-dark w-100">
                    <i class="bi bi-arrow-right-circle me-1"></i>Konversi
                </button>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nilai_input = $_POST['nilai'];

        // Validasi: harus angka dan dalam rentang 0-100
        if (!is_numeric($nilai_input)) {
            echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Input harus berupa angka!</div>';
        } elseif ($nilai_input < 0 || $nilai_input > 100) {
            echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Nilai harus berada di antara 0 hingga 100!</div>';
        } else {
            $nilai = (float) $nilai_input;

            // Tentukan grade dan deskripsi
            if ($nilai >= 80) {
                $grade       = 'A';
                $deskripsi   = 'Sangat Baik — Prestasi luar biasa, pertahankan terus!';
                $css_class   = 'grade-a';
                $icon        = 'bi-trophy-fill';
            } elseif ($nilai >= 70) {
                $grade       = 'B';
                $deskripsi   = 'Baik — Hasil yang memuaskan, terus tingkatkan!';
                $css_class   = 'grade-b';
                $icon        = 'bi-star-fill';
            } elseif ($nilai >= 60) {
                $grade       = 'C';
                $deskripsi   = 'Cukup — Memenuhi standar kelulusan minimum.';
                $css_class   = 'grade-c';
                $icon        = 'bi-check-circle-fill';
            } elseif ($nilai >= 50) {
                $grade       = 'D';
                $deskripsi   = 'Kurang — Di bawah standar, perlu perbaikan.';
                $css_class   = 'grade-d';
                $icon        = 'bi-exclamation-circle-fill';
            } else {
                $grade       = 'E';
                $deskripsi   = 'Tidak Lulus — Nilai tidak memenuhi syarat kelulusan.';
                $css_class   = 'grade-e';
                $icon        = 'bi-x-circle-fill';
            }
            ?>

            <div class="grade-box <?= $css_class ?>">
                <div class="d-flex align-items-center gap-3">
                    <div class="grade-letter"><?= $grade ?></div>
                    <div>
                        <div class="fw-semibold fs-5">Nilai: <?= $nilai ?></div>
                        <div class="d-flex align-items-center gap-1 mt-1">
                            <i class="bi <?= $icon ?>"></i>
                            <span><?= $deskripsi ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel referensi grade -->
            <div class="card mt-4">
                <div class="card-body p-3">
                    <p class="small fw-medium text-muted mb-2">Tabel Referensi Grade</p>
                    <table class="table table-sm table-bordered mb-0 small">
                        <thead class="table-dark">
                            <tr>
                                <th>Rentang Nilai</th>
                                <th>Grade</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="<?= $grade === 'A' ? 'fw-bold' : '' ?>">
                                <td>80 – 100</td><td>A</td><td>Sangat Baik</td>
                            </tr>
                            <tr class="<?= $grade === 'B' ? 'fw-bold' : '' ?>">
                                <td>70 – 79</td><td>B</td><td>Baik</td>
                            </tr>
                            <tr class="<?= $grade === 'C' ? 'fw-bold' : '' ?>">
                                <td>60 – 69</td><td>C</td><td>Cukup</td>
                            </tr>
                            <tr class="<?= $grade === 'D' ? 'fw-bold' : '' ?>">
                                <td>50 – 59</td><td>D</td><td>Kurang</td>
                            </tr>
                            <tr class="<?= $grade === 'E' ? 'fw-bold' : '' ?>">
                                <td>0 – 49</td><td>E</td><td>Tidak Lulus</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
        }
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
