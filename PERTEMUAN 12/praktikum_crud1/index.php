<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Warga Desa - Sistem Informasi Desa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .navbar-brand {
            font-weight: 600;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .table thead th {
            background-color: #343a40;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 500;
            vertical-align: middle;
        }
        .table tbody td {
            vertical-align: middle;
            font-size: 0.88rem;
        }
        .badge-nik {
            font-family: monospace;
            font-size: 0.82rem;
            background-color: #e9ecef;
            color: #495057;
            padding: 3px 7px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">
            <i class="bi bi-house-door-fill me-2"></i>Sistem Informasi Desa
        </span>
        <span class="text-white-50 small">Daftar Warga</span>
    </div>
</nav>

<div class="container mb-5">

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <?php
        $pesan = $_GET['pesan'];
        $tipe  = 'success';
        $ikon  = 'check-circle-fill';
        $teks  = '';
        if ($pesan === 'tambah')  $teks = 'Data warga berhasil ditambahkan.';
        if ($pesan === 'update')  $teks = 'Data warga berhasil diperbarui.';
        if ($pesan === 'hapus')   $teks = 'Data warga berhasil dihapus.';
        ?>
        <div class="alert alert-<?= $tipe ?> alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-<?= $ikon ?> me-2"></i>
            <?= $teks ?>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Header & Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-semibold"><i class="bi bi-people-fill me-2 text-secondary"></i>Data Warga Desa</h5>
        <a href="tambah.php" class="btn btn-dark btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah Warga
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="card">
        <div class="card-body p-0">
            <?php
            include_once("config.php");

            // Fitur pencarian
            $cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';
            $where = $cari ? "WHERE nama LIKE '%$cari%' OR nik LIKE '%$cari%' OR alamat LIKE '%$cari%'" : '';

            $result = mysqli_query($conn, "SELECT * FROM warga $where ORDER BY id DESC");
            $total  = mysqli_num_rows($result);
            ?>

            <!-- Search Bar -->
            <div class="p-3 border-bottom">
                <form method="GET" action="index.php" class="d-flex gap-2">
                    <input type="text" name="cari" class="form-control form-control-sm" placeholder="Cari nama, NIK, atau alamat..." value="<?= htmlspecialchars($cari) ?>" style="max-width:300px;">
                    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
                    <?php if ($cari): ?>
                        <a href="index.php" class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg"></i></a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width:40px">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tgl Lahir</th>
                            <th>Pekerjaan</th>
                            <th>Status</th>
                            <th>No. Telepon</th>
                            <th style="width:110px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($total > 0):
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-muted"><?= $no++ ?></td>
                                <td><span class="badge-nik"><?= htmlspecialchars($row['nik']) ?></span></td>
                                <td class="fw-medium"><?= htmlspecialchars($row['nama']) ?></td>
                                <td>
                                    <?php if ($row['jenis_kelamin'] === 'Laki-laki'): ?>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-gender-male"></i> L
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-gender-female"></i> P
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['tempat_lahir']) ?>, <?= date('d/m/Y', strtotime($row['tanggal_lahir'])) ?></td>
                                <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-secondary"><?= $row['status_perkawinan'] ?></span></td>
                                <td><?= htmlspecialchars($row['no_telepon'] ?: '-') ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary py-0 px-2" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="hapus.php?id=<?= $row['id'] ?>"
                                       class="btn btn-sm btn-outline-danger py-0 px-2 ms-1"
                                       title="Hapus"
                                       onclick="return confirm('Yakin ingin menghapus data warga ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                                    <?= $cari ? 'Data tidak ditemukan untuk pencarian "<strong>' . htmlspecialchars($cari) . '</strong>"' : 'Belum ada data warga.' ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer tabel -->
            <div class="px-3 py-2 border-top text-muted small">
                Total: <strong><?= $total ?></strong> warga<?= $cari ? ' ditemukan' : ' terdaftar' ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
