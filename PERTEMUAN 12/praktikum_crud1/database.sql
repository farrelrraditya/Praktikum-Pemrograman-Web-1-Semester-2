-- =============================================
-- DATABASE: praktikum_crud1
-- Aplikasi CRUD Daftar Warga Desa
-- =============================================

CREATE DATABASE IF NOT EXISTS praktikum_crud1;
USE praktikum_crud1;

CREATE TABLE warga (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(16) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tempat_lahir VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    agama VARCHAR(20) NOT NULL,
    pekerjaan VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    no_telepon VARCHAR(15),
    status_perkawinan ENUM('Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati') NOT NULL DEFAULT 'Belum Kawin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data contoh
INSERT INTO warga (nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, pekerjaan, alamat, no_telepon, status_perkawinan) VALUES
('3301010101800001', 'Budi Santoso', 'Laki-laki', 'Sleman', '1980-01-01', 'Islam', 'Petani', 'Dusun Nglanjaran RT 01/RW 01', '081234567890', 'Kawin'),
('3301010201850002', 'Siti Rahayu', 'Perempuan', 'Bantul', '1985-02-02', 'Islam', 'Ibu Rumah Tangga', 'Dusun Nglanjaran RT 01/RW 01', '081234567891', 'Kawin'),
('3301010301900003', 'Agus Prayitno', 'Laki-laki', 'Sleman', '1990-03-03', 'Islam', 'Wiraswasta', 'Dusun Nglanjaran RT 02/RW 01', '081234567892', 'Belum Kawin');
