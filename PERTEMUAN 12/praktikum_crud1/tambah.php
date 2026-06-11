<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Warga - Sistem Informasi Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f0f2f5; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a href="index.php" class="navbar-brand text-decoration-none">
            <i class="bi bi-house-door-fill me-2"></i>Sistem Informasi Desa
        </a>
    </div>
</nav>

<div class="container mb-5" style="max-width: 700px;">

    <div class="d-flex align-items-center mb-3">
        <a href="index.php" class="btn btn-sm btn-outline-secondary me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h5 class="mb-0 fw-semibold">Tambah Data Warga</h5>
    </div>

    <?php
    include_once("config.php");

    $errors = [];
    $input  = [];

    if (isset($_POST['submit'])) {
        // Ambil & bersihkan input
        $input['nik']               = trim($_POST['nik']);
        $input['nama']              = trim($_POST['nama']);
        $input['jenis_kelamin']     = $_POST['jenis_kelamin'];
        $input['tempat_lahir']      = trim($_POST['tempat_lahir']);
        $input['tanggal_lahir']     = $_POST['tanggal_lahir'];
        $input['agama']             = trim($_POST['agama']);
        $input['pekerjaan']         = trim($_POST['pekerjaan']);
        $input['alamat']            = trim($_POST['alamat']);
        $input['no_telepon']        = trim($_POST['no_telepon']);
        $input['status_perkawinan'] = $_POST['status_perkawinan'];

        // Validasi
        if (empty($input['nik']))               $errors[] = "NIK tidak boleh kosong.";
        elseif (!preg_match('/^\d{16}$/', $input['nik'])) $errors[] = "NIK harus 16 digit angka.";

        if (empty($input['nama']))              $errors[] = "Nama tidak boleh kosong.";
        if (empty($input['jenis_kelamin']))     $errors[] = "Jenis kelamin harus dipilih.";
        if (empty($input['tempat_lahir']))      $errors[] = "Tempat lahir tidak boleh kosong.";
        if (empty($input['tanggal_lahir']))     $errors[] = "Tanggal lahir tidak boleh kosong.";
        if (empty($input['agama']))             $errors[] = "Agama tidak boleh kosong.";
        if (empty($input['pekerjaan']))         $errors[] = "Pekerjaan tidak boleh kosong.";
        if (empty($input['alamat']))            $errors[] = "Alamat tidak boleh kosong.";
        if (!empty($input['no_telepon']) && !preg_match('/^[0-9+\-\s]{6,15}$/', $input['no_telepon']))
            $errors[] = "Format nomor telepon tidak valid.";

        // Cek NIK duplikat
        if (empty($errors)) {
            $nik_cek = mysqli_real_escape_string($conn, $input['nik']);
            $cek = mysqli_query($conn, "SELECT id FROM warga WHERE nik='$nik_cek'");
            if (mysqli_num_rows($cek) > 0) {
                $errors[] = "NIK sudah terdaftar di sistem.";
            }
        }

        // Simpan data
        if (empty($errors)) {
            $nik               = mysqli_real_escape_string($conn, $input['nik']);
            $nama              = mysqli_real_escape_string($conn, $input['nama']);
            $jenis_kelamin     = mysqli_real_escape_string($conn, $input['jenis_kelamin']);
            $tempat_lahir      = mysqli_real_escape_string($conn, $input['tempat_lahir']);
            $tanggal_lahir     = mysqli_real_escape_string($conn, $input['tanggal_lahir']);
            $agama             = mysqli_real_escape_string($conn, $input['agama']);
            $pekerjaan         = mysqli_real_escape_string($conn, $input['pekerjaan']);
            $alamat            = mysqli_real_escape_string($conn, $input['alamat']);
            $no_telepon        = mysqli_real_escape_string($conn, $input['no_telepon']);
            $status_perkawinan = mysqli_real_escape_string($conn, $input['status_perkawinan']);

            $sql = "INSERT INTO warga (nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, pekerjaan, alamat, no_telepon, status_perkawinan)
                    VALUES ('$nik','$nama','$jenis_kelamin','$tempat_lahir','$tanggal_lahir','$agama','$pekerjaan','$alamat','$no_telepon','$status_perkawinan')";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php?pesan=tambah");
                exit();
            } else {
                $errors[] = "Gagal menyimpan data: " . mysqli_error($conn);
            }
        }
    }
    ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terdapat kesalahan:</strong>
            <ul class="mb-0 mt-1">
                <?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body p-4">
            <form action="tambah.php" method="POST" novalidate>

                <div class="row g-3">

                    <!-- NIK -->
                    <div class="col-12">
                        <label class="form-label fw-medium">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control"
                               placeholder="16 digit angka" maxlength="16"
                               value="<?= htmlspecialchars($input['nik'] ?? '') ?>" required>
                        <div class="form-text">Nomor Induk Kependudukan (16 digit).</div>
                    </div>

                    <!-- Nama -->
                    <div class="col-12">
                        <label class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control"
                               placeholder="Nama sesuai KTP"
                               value="<?= htmlspecialchars($input['nama'] ?? '') ?>" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki"  <?= (isset($input['jenis_kelamin']) && $input['jenis_kelamin'] === 'Laki-laki')  ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan"  <?= (isset($input['jenis_kelamin']) && $input['jenis_kelamin'] === 'Perempuan')  ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Agama <span class="text-danger">*</span></label>
                        <select name="agama" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $agama_list = ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'];
                            foreach ($agama_list as $ag):
                                $sel = (isset($input['agama']) && $input['agama'] === $ag) ? 'selected' : '';
                            ?>
                                <option value="<?= $ag ?>" <?= $sel ?>><?= $ag ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir" class="form-control"
                               placeholder="Kota/Kabupaten"
                               value="<?= htmlspecialchars($input['tempat_lahir'] ?? '') ?>" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                               value="<?= htmlspecialchars($input['tanggal_lahir'] ?? '') ?>" required>
                    </div>

                    <!-- Status Perkawinan -->
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Status Perkawinan <span class="text-danger">*</span></label>
                        <select name="status_perkawinan" class="form-select" required>
                            <?php
                            $status_list = ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'];
                            foreach ($status_list as $st):
                                $sel = (isset($input['status_perkawinan']) && $input['status_perkawinan'] === $st) ? 'selected' : '';
                            ?>
                                <option value="<?= $st ?>" <?= $sel ?>><?= $st ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="pekerjaan" class="form-control"
                               placeholder="Contoh: Petani, PNS, dll"
                               value="<?= htmlspecialchars($input['pekerjaan'] ?? '') ?>" required>
                    </div>

                    <!-- No. Telepon -->
                    <div class="col-md-6">
                        <label class="form-label fw-medium">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control"
                               placeholder="08xxxxxxxxxx"
                               value="<?= htmlspecialchars($input['no_telepon'] ?? '') ?>">
                    </div>

                    <!-- Alamat -->
                    <div class="col-12">
                        <label class="form-label fw-medium">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3"
                                  placeholder="Nama jalan / dusun, RT/RW"><?= htmlspecialchars($input['alamat'] ?? '') ?></textarea>
                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">
                    <button type="submit" name="submit" class="btn btn-dark">
                        <i class="bi bi-save me-1"></i>Simpan
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
