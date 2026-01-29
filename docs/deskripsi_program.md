# 📘 Dokumentasi Aplikasi Pengaduan Sarana Sekolah

## 📋 Daftar Isi
1. [Gambaran Umum](#gambaran-umum)
2. [Identitas Proyek](#identitas-proyek)
3. [Instalasi & Setup](#instalasi--setup)
4. [Struktur Database](#struktur-database)
5. [Struktur Folder](#struktur-folder)
6. [Panduan Penggunaan](#panduan-penggunaan)
7. [Fitur-Fitur Utama](#fitur-fitur-utama)
8. [API & Routes](#api--routes)
9. [Troubleshooting](#troubleshooting)

---

## 📍 Gambaran Umum

**Aplikasi Pengaduan Sarana Sekolah** adalah sistem web yang memungkinkan siswa untuk melaporkan masalah atau kerusakan sarana dan prasarana sekolah. Admin dapat mengelola, memproses, dan memberikan feedback terhadap setiap pengaduan yang masuk.

### Tujuan Aplikasi:
- Menyediakan media pengaduan yang efektif dan efisien
- Memudahkan admin dalam mengelola aspirasi siswa
- Memberikan transparansi status pengaduan kepada siswa
- Mempercepat proses penyelesaian masalah sarana sekolah

---

## 🔍 Identitas Proyek

| Aspek | Detail |
|-------|--------|
| **Nama Aplikasi** | Pengaduan Sarana Sekolah |
| **Framework** | Laravel 12 |
| **Database** | MySQL 8.0+ |
| **Bahasa Pemrograman** | PHP 8.2+ |
| **Untuk** | UKK RPL 2025/2026 |
| **Target Pengguna** | Siswa & Admin |
| **Status** | Production Ready |

---

## ⚙️ Instalasi & Setup

### Prasyarat:
- PHP 8.2 atau lebih tinggi
- MySQL 8.0 atau lebih tinggi
- Composer
- Node.js & npm (opsional)

### Langkah Instalasi:

#### 1. Clone atau Extract Proyek
```bash
cd /path/to/project
composer install
```

#### 2. Setup File Environment
```bash
cp .env.example .env
php artisan key:generate
```

#### 3. Konfigurasi Database di .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pps_app
DB_USERNAME=root
DB_PASSWORD=
```

#### 4. Jalankan Migrasi & Seeder
```bash
php artisan migrate
php artisan db:seed
```

#### 5. Jalankan Development Server
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

---

## 🗄️ Struktur Database

### Table: users
```sql
- id (Primary Key)
- name (Nama Lengkap)
- username (Username Unik)
- password (Hashed Password)
- role (admin/siswa)
- timestamps (created_at, updated_at)
```

### Table: kategoris
```sql
- id (Primary Key)
- nama_kategori (Nama Kategori Sarana)
- timestamps
```

### Table: aspirasis
```sql
- id (Primary Key)
- user_id (Foreign Key → users)
- kategori_id (Foreign Key → kategoris)
- judul (Judul Pengaduan)
- deskripsi (Deskripsi Lengkap)
- tanggal_pengajuan (Tanggal Pengajuan)
- status (Diajukan/Diproses/Selesai)
- timestamps
```

### Table: feedbacks
```sql
- id (Primary Key)
- aspirasi_id (Foreign Key → aspirasis)
- isi_feedback (Isi Feedback Admin)
- tanggal_feedback (Tanggal Feedback)
- timestamps
```

### Relasi Database:
- users → aspirasis (1 : Many)
- kategoris → aspirasis (1 : Many)
- aspirasis → feedbacks (1 : 1)

---

## 📁 Struktur Folder

```
project-root/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── AspirasiController.php
│   │       └── AdminController.php
│   └── Models/
│       ├── User.php
│       ├── Aspirasi.php
│       ├── Kategori.php
│       └── Feedback.php
│
├── database/
│   ├── migrations/
│   │   ├── 2024_01_29_000000_modify_users_table.php
│   │   ├── 2024_01_29_000001_create_kategoris_table.php
│   │   ├── 2024_01_29_000002_create_aspirasis_table.php
│   │   └── 2024_01_29_000003_create_feedbacks_table.php
│   └── pengaduan_sarana.sql
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── partials/
│       │   ├── header.blade.php
│       │   ├── navbar.blade.php
│       │   └── footer.blade.php
│       ├── auth/
│       │   └── login.blade.php
│       ├── siswa/
│       │   ├── index.blade.php
│       │   ├── form_aspirasi.blade.php
│       │   ├── histori.blade.php
│       │   └── detail_aspirasi.blade.php
│       └── admin/
│           ├── dashboard.blade.php
│           ├── list_aspirasi.blade.php
│           ├── detail_aspirasi.blade.php
│           └── feedback.blade.php
│
├── public/
│   └── views/
│       ├── css/
│       │   ├── style.css
│       │   └── auth.css
│       ├── siswa/
│       │   └── siswa.css
│       └── admin/
│           └── admin.css
│
├── routes/
│   └── web.php
│
├── docs/
│   ├── ERD.md
│   ├── deskripsi_program.md
│   ├── dokumentasi_fungsi.md
│   └── pengaduan_sarana.sql
│
└── README.md
```

---

## 👥 Panduan Penggunaan

### Akun Demo:

#### Admin
- **Username**: `admin`
- **Password**: `admin123`

#### Siswa
- **Username**: `siswa1` / `siswa2` / `siswa3`
- **Password**: `siswa123`

### Untuk Siswa:

1. **Login**
   - Masukkan username dan password
   - Klik tombol Login

2. **Akses Beranda**
   - Lihat statistik aspirasi Anda
   - Akses menu Form Aspirasi atau Histori

3. **Membuat Aspirasi Baru**
   - Klik "Form Aspirasi"
   - Pilih kategori sarana
   - Isi judul dan deskripsi detail
   - Klik "Kirim Aspirasi"

4. **Pantau Histori**
   - Klik "Histori Aspirasi"
   - Lihat daftar semua aspirasi yang telah dikirim
   - Pantau status dan feedback dari admin

### Untuk Admin:

1. **Akses Dashboard**
   - Lihat ringkasan total aspirasi, status aspirasi

2. **Kelola Aspirasi**
   - Klik "Daftar Aspirasi"
   - Filter berdasarkan status, kategori, siswa, atau tanggal
   - Klik "Lihat" untuk melihat detail aspirasi

3. **Berikan Feedback**
   - Dari halaman detail, klik "Feedback"
   - Isi feedback dan pilih status terbaru
   - Klik "Simpan Feedback"

---

## 🎯 Fitur-Fitur Utama

### Fitur Siswa:
- ✅ Login/Logout
- ✅ Lihat Beranda dengan Statistik
- ✅ Buat Aspirasi/Pengaduan Baru
- ✅ Lihat Histori Aspirasi
- ✅ Lihat Detail Aspirasi + Feedback Admin
- ✅ Pantau Status Aspirasi (Diajukan/Diproses/Selesai)

### Fitur Admin:
- ✅ Login/Logout
- ✅ Dashboard dengan Statistik Lengkap
- ✅ Lihat Daftar Semua Aspirasi
- ✅ Filter Aspirasi (Status, Kategori, Siswa, Tanggal, Bulan)
- ✅ Lihat Detail Aspirasi
- ✅ Berikan Feedback & Update Status
- ✅ View/Edit Feedback yang Sudah Dibuat

---

## 🛣️ API & Routes

### Public Routes:
```
GET  /                    → Redirect ke dashboard
GET  /login               → Form login
POST /login               → Proses login
```

### Siswa Routes (Protected):
```
GET  /siswa               → Beranda siswa
GET  /aspirasi/create     → Form buat aspirasi
POST /aspirasi            → Simpan aspirasi
GET  /aspirasi/histori    → Histori aspirasi
GET  /aspirasi/{id}       → Detail aspirasi
```

### Admin Routes (Protected & Admin Only):
```
GET  /admin/dashboard     → Dashboard admin
GET  /admin/aspirasi      → Daftar aspirasi dengan filter
GET  /admin/aspirasi/{id} → Detail aspirasi
GET  /admin/aspirasi/{id}/feedback → Form feedback
POST /admin/aspirasi/{id}/feedback → Simpan feedback
GET  /admin/export        → Export data (optional)
```

### Logout:
```
POST /logout              → Logout user
```

---

## 📝 Dokumentasi Fungsi

### AuthController

#### `showLoginForm()`
- **Deskripsi**: Menampilkan halaman login
- **Return**: View login.blade.php

#### `login(Request $request)`
- **Deskripsi**: Memproses login user
- **Validasi**: username & password
- **Logic**: 
  - Cari user berdasarkan username
  - Verifikasi password dengan hash
  - Login user jika valid
  - Redirect ke dashboard sesuai role

#### `logout(Request $request)`
- **Deskripsi**: Logout user
- **Logic**: Destroy session dan redirect ke login

---

### AspirasiController

#### `index()`
- **Deskripsi**: Menampilkan beranda siswa
- **Data**: Statistik aspirasi siswa
- **Return**: View siswa/index.blade.php

#### `create()`
- **Deskripsi**: Menampilkan form buat aspirasi
- **Data**: List kategori sarana
- **Return**: View siswa/form_aspirasi.blade.php

#### `store(Request $request)`
- **Deskripsi**: Menyimpan aspirasi baru
- **Validasi**: kategori_id, judul, deskripsi
- **Logic**:
  - Assign user_id dari auth
  - Set tanggal_pengajuan = hari ini
  - Set status = 'Diajukan'
  - Simpan ke database
- **Redirect**: ke route aspirasi.histori

#### `histori()`
- **Deskripsi**: Menampilkan histori aspirasi siswa
- **Data**: Semua aspirasi milik user + feedback
- **Return**: View siswa/histori.blade.php

#### `show($id)`
- **Deskripsi**: Menampilkan detail aspirasi
- **Otorisasi**: Siswa hanya bisa lihat miliknya atau admin
- **Data**: Detail aspirasi, kategori, feedback
- **Return**: View siswa/detail_aspirasi.blade.php

---

### AdminController

#### `dashboard()`
- **Deskripsi**: Menampilkan dashboard admin
- **Data**: Total, diajukan, diproses, selesai
- **Return**: View admin/dashboard.blade.php

#### `listAspirasi(Request $request)`
- **Deskripsi**: Menampilkan daftar aspirasi dengan filter
- **Filter**: status, kategori, user, tanggal, bulan
- **Pagination**: 10 item per halaman
- **Return**: View admin/list_aspirasi.blade.php

#### `detailAspirasi($id)`
- **Deskripsi**: Menampilkan detail aspirasi lengkap
- **Data**: Aspirasi, user, kategori, feedback
- **Return**: View admin/detail_aspirasi.blade.php

#### `showFeedbackForm($id)`
- **Deskripsi**: Menampilkan form feedback
- **Data**: Detail aspirasi
- **Return**: View admin/feedback.blade.php

#### `saveFeedback(Request $request, $id)`
- **Deskripsi**: Menyimpan feedback dan update status
- **Validasi**: isi_feedback, status
- **Logic**:
  - Update status aspirasi
  - Hapus feedback lama (jika ada)
  - Buat feedback baru
  - Set tanggal_feedback = hari ini
- **Redirect**: ke route admin.detail

---

## 🐛 Troubleshooting

### Error: "SQLSTATE[HY000] [2002] Connection refused"
**Solusi**: Pastikan MySQL server sudah running
```bash
# Linux
sudo service mysql start

# Windows
mysqld --install
net start MySQL
```

### Error: "Class 'App\Models\Aspirasi' not found"
**Solusi**: Jalankan `composer dump-autoload`
```bash
composer dump-autoload
```

### Error: "No routes found matching the given conditions"
**Solusi**: 
1. Pastikan routes sudah defined di `routes/web.php`
2. Clear route cache: `php artisan route:clear`
3. Jalankan: `php artisan route:cache`

### Login tidak bisa berhasil
**Solusi**:
1. Pastikan sudah migrate database
2. Pastikan users sudah tersimpan di database
3. Check password hashing dengan bcrypt
4. Verify `.env` configuration benar

### CSS tidak loading
**Solusi**:
1. Pastikan file CSS ada di `public/views/css/`
2. Clear browser cache (Ctrl+Shift+Delete)
3. Jalankan: `php artisan storage:link`
4. Check path di blade view

### Database tidak tersimpan
**Solusi**:
1. Pastikan sudah jalankan migration: `php artisan migrate`
2. Check foreign key constraints
3. Verify data validation di controller
4. Check MySQL error logs

---

## 📞 Kontak & Support

Untuk pertanyaan atau bantuan, silakan hubungi tim developer atau admin sekolah.

**Aplikasi dibuat untuk UKK RPL 2025/2026**

---

*Last Updated: 2026-01-29*
