# 💊 FarmasiApp - Sistem Informasi Apotek Modern

FarmasiApp adalah platform manajemen apotek berbasis web yang dirancang dengan antarmuka **Ultra-Clean** dan *user-friendly*. Aplikasi ini memungkinkan admin mengelola inventaris obat secara efisien dan memudahkan pelanggan untuk melakukan pembelian obat secara online.

## 🚀 Fitur Utama

- **Dashboard Admin**: Manajemen stok obat (CRUD) dengan sistem *Popup/Modal*.
- **E-Katalog**: Pencarian obat yang cepat dan filter kategori.
- **Sistem Keranjang**: Penambahan item ke keranjang belanja dengan konfirmasi keamanan.
- **Manajemen Pesanan**: Pelacakan status pesanan secara real-time.
- **Role Access**: Pembedaan hak akses antara Admin dan Pembeli.
- **Responsive Design**: Tampilan optimal di perangkat desktop maupun mobile.

## 🛠️ Tech Stack

- **Framework:** Laravel 9
- **Frontend:** Tailwind CSS, Vite, Inter Fonts
- **Database:** MySQL
- **Icons & UI:** Heroicons, Lucide Icons

## 📋 Prasyarat Instalasi

Sebelum menjalankan proyek ini, pastikan komputer Anda sudah terpasang:
- PHP >= 8.1
- Composer
- Node.js & NPM
- XAMPP / Laragon (untuk MySQL server)

## 💻 Langkah Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek di perangkat lokal Anda:

### 1. Clone Repositori
```bash
git clone https://github.com/cardfrans/farmasiapp.git
cd farmasiapp

2. Instal Dependency PHP (Composer)
Bash
composer install
3. Instal Dependency Frontend (NPM)
Bash
npm install
4. Konfigurasi Lingkungan (.env)
Salin file .env.example menjadi .env dan sesuaikan pengaturan database Anda.

Bash
cp .env.example .env
Buka file .env, lalu sesuaikan bagian berikut:

Code snippet
DB_DATABASE=farmasi_db
DB_USERNAME=root
DB_PASSWORD=
5. Generate Application Key
Bash
php artisan key:generate
6. Migrasi Database & Seeding
Pastikan MySQL sudah berjalan, buat database baru dengan nama farmasi_db, lalu jalankan:

Bash
php artisan migrate --seed
> Note: --seed akan otomatis membuat akun Admin default: admin@apotek.com (password: password123)

7. Hubungkan Folder Storage (Sangat Penting)
Agar gambar obat yang diunggah muncul di halaman web, buat symlink folder storage:

Bash
php artisan storage:link
8. Jalankan Aplikasi
Buka dua terminal dan jalankan perintah berikut secara bersamaan:

Terminal 1 (Server PHP):

Bash
php artisan serve
Terminal 2 (Vite/Assets):

Bash
npm run dev
Aplikasi sekarang dapat diakses melalui browser di: http://127.0.0.1:8000

