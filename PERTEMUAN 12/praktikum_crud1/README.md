# Praktikum CRUD - Daftar Warga Desa

Aplikasi web CRUD sederhana untuk mengelola **data warga desa** menggunakan PHP, MySQL, dan Bootstrap 5.

---

## Fitur
- **Create** – Tambah data warga baru dengan validasi input lengkap
- **Read** – Tampilkan seluruh daftar warga dalam tabel responsif, dilengkapi fitur pencarian
- **Update** – Edit data warga yang sudah tersimpan
- **Delete** – Hapus data warga dengan konfirmasi

---

## Teknologi
| Komponen | Keterangan |
|---|---|
| PHP | Server-side scripting |
| MySQL | Database |
| Bootstrap 5.3 | Frontend framework (CDN) |
| Bootstrap Icons | Icon set (CDN) |
| XAMPP | Web server lokal (Apache + MySQL) |

---

## Struktur Direktori
```
praktikum_crud1/
├── config.php      # Konfigurasi koneksi database
├── index.php       # Halaman utama – Read (daftar warga)
├── tambah.php      # Halaman tambah warga – Create
├── edit.php        # Halaman edit warga – Update
├── hapus.php       # Script hapus warga – Delete
├── database.sql    # File SQL untuk membuat database & tabel
└── README.md       # Dokumentasi proyek
```

---

## Cara Menjalankan

### 1. Persiapan
- Pastikan **XAMPP** sudah terinstall dan aktifkan **Apache** + **MySQL**

### 2. Import Database
- Buka [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Klik tab **SQL**
- Copy-paste isi file `database.sql` lalu klik **Go**

### 3. Letakkan Folder Proyek
- Copy folder `praktikum_crud1` ke:
  - `C:\xampp\htdocs\` (Windows)
  - `/opt/lampp/htdocs/` (Linux)

### 4. Akses Aplikasi
Buka browser dan akses:
```
http://localhost/praktikum_crud1/
```

---

## Konfigurasi Database
Edit file `config.php` jika diperlukan:
```php
$host     = "localhost";
$username = "root";
$password = "";           // isi jika MySQL kamu ada password
$database = "praktikum_crud1";
```

---

## Screenshot
> Tambahkan screenshot tampilan aplikasi di sini setelah dijalankan.

---

## Informasi
Dibuat untuk memenuhi tugas **Praktikum Pemrograman Web 1**.
