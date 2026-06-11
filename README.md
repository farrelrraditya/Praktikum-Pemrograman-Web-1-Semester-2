# Praktikum Pemrograman Web 1 — Semester 2

Repository ini berisi kumpulan kode dan hasil praktikum mata kuliah **Praktikum Pemrograman Web 1** Semester 2, mencakup materi dari HTML dasar hingga PHP dan CRUD dengan database.

| | |
|---|---|
| **Nama** | Farrel Raditya |
| **NIM** | 25/557571/SV/26195 |
| **Kelas** | PL2B2 |
| **Dosen Pengampu** | Achmad Choirudin Emcha, S.Kom., M.Eng. |
| **Program Studi** | D-IV Teknologi Rekayasa Perangkat Lunak |
| **Institusi** | Sekolah Vokasi — Universitas Gadjah Mada |

---

## Struktur Repository

```
Praktikum-Pemrograman-Web-1-Semester-2/
│
├── PERTEMUAN 1/                    # Dasar HTML
│   ├── latihan_1.html
│   ├── latihan_2.html
│   ├── latihan_3.html
│   ├── latihan_4.html
│   ├── latihan_5.html
│   ├── latihan_6.html
│   └── latihan_7.html
│
├── PERTEMUAN 2/                    # Tabel & Layout HTML
│   ├── latihan_1.html – latihan_13.html
│   ├── pertemuan2_new.html
│   ├── pertemuan3.html
│   ├── images.jpg
│   └── pic.webp
│
├── PERTEMUAN 3/                    # Form & Input HTML
│   ├── latihan1_formulir.html
│   ├── latihan2_dropdown.html
│   ├── latihan3_radio.html
│   ├── latihan4_checkbox.html
│   ├── latihan5_isian.html
│   ├── latihan6_button.html
│   ├── latihan7_disabled.html
│   ├── latihan8_sizeplaceholder.html
│   ├── latihan9_aturaninput.html
│   ├── latihan10_autofocus.html
│   ├── latihan 11_method.html
│   ├── laithan12_formaction.html
│   ├── latihan13_SVG.html
│   ├── latihan14_lingkaran.html
│   ├── latihan15_canvas.html
│   ├── latihan16_graphics.html
│   ├── tugas1_datalist.html
│   ├── tugas1_legend.html
│   ├── tugas1_option.html
│   ├── tugas1_output.html
│   ├── tugas 2.html
│   └── action_page.php
│
├── PERTEMUAN 4/                    # CSS Dasar — Styling Form
│   ├── tugas1_datalist.html
│   ├── tugas1_legend.html
│   ├── tugas1_option.html
│   ├── tugas1_output.html
│   └── tugas 2.html
│
├── PERTEMUAN 5/                    # CSS Lanjutan — Landing Page
│   ├── main.html
│   ├── style.css
│   ├── logo.png
│   └── bg.png
│
├── PERTEMUAN 6/                    # Responsive Web Design
│   ├── index.html
│   └── styles.css
│
├── PERTEMUAN 7/                    # CSS Position, Flexbox & Animasi
│   ├── tugas1-css-position.html
│   ├── tugas2-flexbox.html
│   └── tugas3-animation.html
│
├── PERTEMUAN 8/                    # Bootstrap 5 — Dashboard
│   ├── dashboard.html
│   ├── bni.jpg
│   ├── bri.jpeg
│   └── gedung.jpg
│
├── PERTEMUAN 9/                    # Bootstrap 5 Lanjutan
│   ├── latihan_ppw9.html
│   └── tugas_ppw9.html
│
├── PERTEMUAN 10/                   # JavaScript Dasar
│   ├── no1bab10.html
│   ├── no1bab11.html
│   ├── no2bab10.html
│   ├── no2bab11.html
│   ├── no3bab11.html
│   └── kodeprogram.js
│
├── PERTEMUAN 11/                   # PHP Dasar
│   ├── bulan.php
│   ├── imt.php
│   ├── kalkulator.php
│   └── profile.php
│
└── PERTEMUAN 12/                   # PHP + MySQL — CRUD
    ├── konversi_nilai.php
    ├── pendataan_mahasiswa.php
    └── praktikum_crud1/
        ├── config.php
        ├── index.php
        ├── tambah.php
        ├── edit.php
        ├── hapus.php
        ├── database.sql
        └── README.md
```

---

## Ringkasan Materi Per Pertemuan

| Pertemuan | Topik | Teknologi |
|:---------:|-------|-----------|
| 1 | Dasar-dasar HTML — paragraf, heading, teks | HTML |
| 2 | Tabel HTML & layout berbasis tabel | HTML |
| 3 | Form & elemen input (dropdown, radio, checkbox, SVG, canvas) | HTML |
| 4 | CSS Dasar — styling form dan elemen HTML | HTML, CSS |
| 5 | CSS Lanjutan — landing page dengan Google Fonts | HTML, CSS |
| 6 | Responsive Web Design — media query, viewport, fluid layout | HTML, CSS |
| 7 | CSS Position, Flexbox, Animasi & CSS Variables | HTML, CSS |
| 8 | Bootstrap 5 — Dashboard dengan tabel dan komponen UI | HTML, CSS, Bootstrap 5 |
| 9 | Bootstrap 5 Lanjutan — Landing page responsif | HTML, CSS, Bootstrap 5 |
| 10 | JavaScript Dasar — embed, eksternal, event handling | HTML, JavaScript |
| 11 | PHP Dasar — variabel, kondisi, fungsi tanggal | PHP |
| 12 | PHP + MySQL — Aplikasi CRUD data warga | PHP, MySQL, Bootstrap 5 |

---

## Teknologi yang Digunakan

- **HTML5** — struktur halaman web
- **CSS3** — styling, Flexbox, media query, animasi, CSS Variables
- **JavaScript** — interaktivitas dan manipulasi DOM
- **Bootstrap 5** — framework CSS responsif
- **PHP** — server-side scripting
- **MySQL** — database relasional
- **XAMPP** — web server lokal (Apache + MySQL) untuk Pertemuan 11 & 12

---

## Cara Menjalankan

### Pertemuan 1–10 (Static HTML / JS)
Tidak memerlukan server. Cukup buka file `.html` langsung di browser, atau gunakan ekstensi **Live Server** di VS Code.

```bash
git clone https://github.com/farrelrraditya/Praktikum-Pemrograman-Web-1-Semester-2.git
```

### Pertemuan 11 — PHP
Memerlukan PHP. Jalankan dengan PHP built-in server:
```bash
cd "PERTEMUAN 11"
php -S localhost:8000
# Akses di http://localhost:8000
```

### Pertemuan 12 — PHP + MySQL (CRUD)
Memerlukan **XAMPP** (Apache + MySQL):
1. Aktifkan **Apache** dan **MySQL** di XAMPP Control Panel
2. Copy folder `praktikum_crud1` ke `C:\xampp\htdocs\` (Windows) atau `/opt/lampp/htdocs/` (Linux)
3. Import database: buka [phpMyAdmin](http://localhost/phpmyadmin) → tab SQL → paste isi `database.sql` → klik **Go**
4. Akses aplikasi di `http://localhost/praktikum_crud1/`

Detail lengkap ada di [`PERTEMUAN 12/praktikum_crud1/README.md`](PERTEMUAN%2012/praktikum_crud1/README.md).

---

*© 2026 Farrel Raditya — Universitas Gadjah Mada*
