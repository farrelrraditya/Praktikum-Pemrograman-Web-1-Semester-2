<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Mahasiswa - BAB XIII PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f0f2f5; }
        .card  { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .nav-link { color: #6c757d; }
        .nav-link.active { color: #000; font-weight: 600; }

        /* Warna predikat kelulusan */
        .predikat-cumlaude       { background: #d1fae5; border-left: 5px solid #10b981; color: #065f46; }
        .predikat-sangat-memuaskan { background: #dbeafe; border-left: 5px solid #3b82f6; color: #1e3a5f; }
        .predikat-memuaskan      { background: #fef9c3; border-left: 5px solid #eab308; color: #713f12; }
        .predikat-cukup          { background: #ffedd5; border-left: 5px solid #f97316; color: #7c2d12; }

        .result-card {
            border-radius: 10px;
            padding: 20px 24px;
        }
        .label-col { color: #6c757d; font-size: 0.85rem; }
        .value-col { font-weight: 500; }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <span class="navbar-brand fw-semibold">
            <i class="bi bi-mortarboard me-2"></i>Praktikum PPW1 – BAB XIII PHP
        </span>
        <div class="d-flex gap-3">
            <a href="konversi_nilai.php" class="nav-link">Konversi Nilai</a>
            <a href="pendataan_mahasiswa.php" class="nav-link active">Pendataan Mahasiswa</a>
        </div>
    </div>
</nav>

<div class="container mb-5" style="max-width: 600px;">

    <div class="card mb-4">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-1"><i class="bi bi-person-vcard me-2 text-secondary"></i>Form Pendataan Mahasiswa</h5>
            <p class="text-muted small mb-3">Isi semua field di bawah ini dengan data yang valid.</p>

            <?php
            // ── Daftar pilihan ──────────────────────────────────────────────
            $prodi_list = [
                'Informatika',
                'Sistem Informasi',
                'Teknik Elektro',
                'Teknik Mesin',
                'Teknik Sipil',
                'Manajemen',
                'Akuntansi',
                'Ilmu Komunikasi',
                'Hukum',
                'Kedokteran',
            ];

            // ── Fungsi sanitasi XSS ─────────────────────────────────────────
            function xss_clean($data) {
                return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
            }

            // ── Proses form ─────────────────────────────────────────────────
            $errors  = [];
            $input   = [];
            $success = false;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Ambil & sanitasi input
                $input['nama']     = xss_clean($_POST['nama']     ?? '');
                $input['nim']      = xss_clean($_POST['nim']      ?? '');
                $input['prodi']    = xss_clean($_POST['prodi']    ?? '');
                $input['ipk']      = xss_clean($_POST['ipk']      ?? '');
                $input['semester'] = xss_clean($_POST['semester'] ?? '');

                // Validasi Nama
                if (empty($input['nama'])) {
                    $errors['nama'] = 'Nama tidak boleh kosong.';
                } elseif (!preg_match('/^[a-zA-Z\s\.\']+$/', $input['nama'])) {
                    $errors['nama'] = 'Nama hanya boleh berisi huruf dan spasi.';
                } elseif (strlen($input['nama']) < 3) {
                    $errors['nama'] = 'Nama minimal 3 karakter.';
                }

                // Validasi NIM
                if (empty($input['nim'])) {
                    $errors['nim'] = 'NIM tidak boleh kosong.';
                } elseif (!preg_match('/^\d{8,12}$/', $input['nim'])) {
                    $errors['nim'] = 'NIM harus berupa angka, 8–12 digit.';
                }

                // Validasi Prodi
                if (empty($input['prodi']) || !in_array($input['prodi'], $prodi_list)) {
                    $errors['prodi'] = 'Program studi harus dipilih dari daftar yang tersedia.';
                }

                // Validasi IPK
                if ($input['ipk'] === '') {
                    $errors['ipk'] = 'IPK tidak boleh kosong.';
                } elseif (!is_numeric($input['ipk'])) {
                    $errors['ipk'] = 'IPK harus berupa angka.';
                } elseif ($input['ipk'] < 0 || $input['ipk'] > 4.00) {
                    $errors['ipk'] = 'IPK harus berada di antara 0.00 dan 4.00.';
                }

                // Validasi Semester
                if (empty($input['semester'])) {
                    $errors['semester'] = 'Semester tidak boleh kosong.';
                } elseif (!ctype_digit($input['semester']) || (int)$input['semester'] < 1 || (int)$input['semester'] > 14) {
                    $errors['semester'] = 'Semester harus berupa angka antara 1 dan 14.';
                }

                // Jika tidak ada error → tentukan predikat
                if (empty($errors)) {
                    $success = true;
                    $ipk = (float) $input['ipk'];

                    if ($ipk >= 3.51) {
                        $predikat      = 'Cumlaude';
                        $css_predikat  = 'predikat-cumlaude';
                        $icon_predikat = 'bi-trophy-fill';
                        $ket_predikat  = 'Pencapaian tertinggi, luar biasa!';
                    } elseif ($ipk >= 3.01) {
                        $predikat      = 'Sangat Memuaskan';
                        $css_predikat  = 'predikat-sangat-memuaskan';
                        $icon_predikat = 'bi-star-fill';
                        $ket_predikat  = 'Prestasi sangat baik, terus pertahankan!';
                    } elseif ($ipk >= 2.76) {
                        $predikat      = 'Memuaskan';
                        $css_predikat  = 'predikat-memuaskan';
                        $icon_predikat = 'bi-check-circle-fill';
                        $ket_predikat  = 'Memenuhi standar kelulusan dengan baik.';
                    } else {
                        $predikat      = 'Cukup';
                        $css_predikat  = 'predikat-cukup';
                        $icon_predikat = 'bi-exclamation-circle-fill';
                        $ket_predikat  = 'Lulus minimum, perlu peningkatan lebih lanjut.';
                    }
                }
            }
            ?>

            <form action="pendataan_mahasiswa.php" method="POST" novalidate>

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama"
                           class="form-control <?= isset($errors['nama']) ? 'is-invalid' : ($success ? 'is-valid' : '') ?>"
                           placeholder="Masukkan nama lengkap"
                           value="<?= $input['nama'] ?? '' ?>">
                    <?php if (isset($errors['nama'])): ?>
                        <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                    <?php endif; ?>
                </div>

                <!-- NIM -->
                <div class="mb-3">
                    <label class="form-label fw-medium">NIM <span class="text-danger">*</span></label>
                    <input type="text" name="nim"
                           class="form-control <?= isset($errors['nim']) ? 'is-invalid' : ($success ? 'is-valid' : '') ?>"
                           placeholder="Contoh: 12345678"
                           maxlength="12"
                           value="<?= $input['nim'] ?? '' ?>">
                    <?php if (isset($errors['nim'])): ?>
                        <div class="invalid-feedback"><?= $errors['nim'] ?></div>
                    <?php else: ?>
                        <div class="form-text">8–12 digit angka.</div>
                    <?php endif; ?>
                </div>

                <!-- Prodi -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Program Studi <span class="text-danger">*</span></label>
                    <select name="prodi" class="form-select <?= isset($errors['prodi']) ? 'is-invalid' : ($success ? 'is-valid' : '') ?>">
                        <option value="">-- Pilih Program Studi --</option>
                        <?php foreach ($prodi_list as $p): ?>
                            <option value="<?= $p ?>" <?= (isset($input['prodi']) && $input['prodi'] === $p) ? 'selected' : '' ?>>
                                <?= $p ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['prodi'])): ?>
                        <div class="invalid-feedback"><?= $errors['prodi'] ?></div>
                    <?php endif; ?>
                </div>

                <!-- IPK & Semester -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">IPK <span class="text-danger">*</span></label>
                        <input type="number" name="ipk" step="0.01" min="0" max="4.00"
                               class="form-control <?= isset($errors['ipk']) ? 'is-invalid' : ($success ? 'is-valid' : '') ?>"
                               placeholder="Contoh: 3.75"
                               value="<?= $input['ipk'] ?? '' ?>">
                        <?php if (isset($errors['ipk'])): ?>
                            <div class="invalid-feedback"><?= $errors['ipk'] ?></div>
                        <?php else: ?>
                            <div class="form-text">Skala 0.00 – 4.00</div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Semester <span class="text-danger">*</span></label>
                        <input type="number" name="semester" min="1" max="14"
                               class="form-control <?= isset($errors['semester']) ? 'is-invalid' : ($success ? 'is-valid' : '') ?>"
                               placeholder="Contoh: 5"
                               value="<?= $input['semester'] ?? '' ?>">
                        <?php if (isset($errors['semester'])): ?>
                            <div class="invalid-feedback"><?= $errors['semester'] ?></div>
                        <?php else: ?>
                            <div class="form-text">Semester 1 – 14</div>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 mt-1">
                    <i class="bi bi-send me-1"></i>Kirim Data
                </button>

            </form>
        </div>
    </div>

    <!-- ── Hasil ─────────────────────────────────────────────────────────── -->
    <?php if ($success): ?>

        <div class="result-card <?= $css_predikat ?> mb-3">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="bi <?= $icon_predikat ?> fs-5"></i>
                <span class="fw-semibold fs-5">Predikat: <?= $predikat ?></span>
            </div>
            <div class="small mb-1 fst-italic"><?= $ket_predikat ?></div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-3"><i class="bi bi-person-lines-fill me-2 text-secondary"></i>Data Mahasiswa</h6>
                <table class="table table-sm mb-0">
                    <tbody>
                        <tr>
                            <td class="label-col" style="width:35%">Nama Lengkap</td>
                            <td class="value-col">: <?= $input['nama'] ?></td>
                        </tr>
                        <tr>
                            <td class="label-col">NIM</td>
                            <td class="value-col">: <?= $input['nim'] ?></td>
                        </tr>
                        <tr>
                            <td class="label-col">Program Studi</td>
                            <td class="value-col">: <?= $input['prodi'] ?></td>
                        </tr>
                        <tr>
                            <td class="label-col">IPK</td>
                            <td class="value-col">: <?= number_format((float)$input['ipk'], 2) ?></td>
                        </tr>
                        <tr>
                            <td class="label-col">Semester</td>
                            <td class="value-col">: <?= $input['semester'] ?></td>
                        </tr>
                        <tr>
                            <td class="label-col">Predikat Kelulusan</td>
                            <td class="value-col fw-semibold">: <?= $predikat ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel referensi predikat -->
        <div class="card mt-3">
            <div class="card-body p-3">
                <p class="small fw-medium text-muted mb-2">Tabel Referensi Predikat Kelulusan</p>
                <table class="table table-sm table-bordered mb-0 small">
                    <thead class="table-dark">
                        <tr><th>Rentang IPK</th><th>Predikat</th></tr>
                    </thead>
                    <tbody>
                        <tr class="<?= $predikat === 'Cumlaude' ? 'fw-bold' : '' ?>">
                            <td>3.51 – 4.00</td><td>Cumlaude</td>
                        </tr>
                        <tr class="<?= $predikat === 'Sangat Memuaskan' ? 'fw-bold' : '' ?>">
                            <td>3.01 – 3.50</td><td>Sangat Memuaskan</td>
                        </tr>
                        <tr class="<?= $predikat === 'Memuaskan' ? 'fw-bold' : '' ?>">
                            <td>2.76 – 3.00</td><td>Memuaskan</td>
                        </tr>
                        <tr class="<?= $predikat === 'Cukup' ? 'fw-bold' : '' ?>">
                            <td>0.00 – 2.75</td><td>Cukup</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <?php elseif (!empty($errors)): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Mohon perbaiki kesalahan berikut:</strong>
            <ul class="mb-0 mt-1">
                <?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
