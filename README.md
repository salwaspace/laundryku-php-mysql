# LaundryKu — Sistem Informasi Pengelolaan Data Laundry

Tugas 2: **PHP murni**, **MySQL/MariaDB** (PDO), login berbasis `$_SESSION`, CRUD, validasi POST, dan antarmuka Bahasa Indonesia/English berbasis array + session.

## Jalankan di XAMPP (Windows)

1. Download dan ekstrak ZIP. Salin folder `sim-laundry` ke `C:\xampp\htdocs\sim-laundry`.
2. Jalankan **Apache** dan **MySQL** di XAMPP.
3. Masuk `http://localhost/phpmyadmin`, buka **Import**, lalu pilih `database.sql`. SQL membuat database `sim_laundry` dan tabel-tabel. Jika phpMyAdmin meminta database aktif, buat dahulu database bernama `sim_laundry`, lalu import.
4. Pastikan `config.php` berisi host `127.0.0.1`, database `sim_laundry`, user `root`, password kosong untuk XAMPP default. Jika setelan lokal berbeda, sesuaikan.
5. Buka **http://localhost/sim-laundry/login.php**.
6. Login demo **admin** / **admin123**. Akun ini untuk lokal saja, jangan digunakan di server publik.

## Apa yang bisa dilakukan?

- Login/logout dengan session, proteksi halaman CRUD.
- Tambah pesanan laundry, lihat daftar, edit, hapus (hapus via POST).
- Validasi wajib isi, kode order unik, nomor HP, dan berat positif.
- Tarif sederhana dan tetap: **Cuci Kering Rp6.000/kg**, **Cuci Setrika Rp8.000/kg**, **Setrika Saja Rp5.000/kg**. Total = berat × tarif, dihitung di server.
- Dua bahasa: pilih Indonesia/English pada bagian atas, disimpan di `$_SESSION['lang']`.

## Struktur file

- `database.sql` — database, data contoh, admin demo.
- `config.php` — koneksi PDO.
- `functions.php` — session, escape output `htmlspecialchars`, validasi input, perhitungan tarif, token CSRF.
- `translations.php` — array teks Indonesia/English.
- `login.php`, `logout.php`, `language.php` — login, logout, perubahan bahasa.
- `index.php` — dashboard dan Read.
- `create.php`, `edit.php`, `delete.php` — Create, Update, Delete.
- `laundry_form.php`, `header.php`, `footer.php`, `assets/style.css` — tampilan.

## Pengujian untuk laporan

1. Akses dashboard tanpa login → diarahkan ke `login.php`.
2. Login salah → pesan kesalahan; login `admin` / `admin123` → dashboard.
3. Tambah order `LDY-004`, nama pelanggan, nomor HP, layanan, berat `2.5`, status `Proses` → muncul di tabel.
4. Pilih Cuci Setrika dan berat `2.5` → total harus **Rp20.000**.
5. Edit status ke Selesai → tabel berubah.
6. Hapus LDY-004 → data hilang.
7. Pilih English, pindah halaman → label menjadi English, lalu pilih Indonesia.
8. Logout, akses dashboard → diminta login.

## GitHub

Buat repository **Public** bernama misalnya `sim-laundry-php`, upload isi folder beserta `database.sql`, `README.md`, dan laporan PDF final yang sudah berisi screenshot aplikasi asli. **GitHub menyimpan source code; aplikasi PHP tidak otomatis berjalan melalui GitHub Pages.** Jangan upload password asli, akun produksi, atau data pelanggan sungguhan. Akun demo lokal ini tidak untuk deployment publik.

## Catatan

Aplikasi menggunakan `password_verify()` dan hash password, PDO prepared statements, HTML escaping, serta CSRF token untuk aksi POST. Pengujian browser/database di XAMPP tetap harus dilakukan pada mesin pengguna. `database.sql` berisi data pelanggan fiktif.
