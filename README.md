# 📘 Aplikasi Pengaduan Sarana Sekolah

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-blue)

---

## 📋 Deskripsi Singkat

**Aplikasi Pengaduan Sarana Sekolah** adalah sistem web yang memudahkan siswa untuk melaporkan masalah sarana dan prasarana sekolah, serta membantu admin dalam mengelola dan menindaklanjuti setiap pengaduan dengan lebih efisien dan terstruktur.

### Fitur Utama:
✅ Siswa dapat membuat pengaduan sarana sekolah  
✅ Admin dapat mengelola dan memproses pengaduan  
✅ Sistem status real-time (Diajukan → Diproses → Selesai)  
✅ Feedback dari admin untuk setiap pengaduan  
✅ Filter dan pencarian pengaduan yang powerful  
✅ Dashboard dengan statistik lengkap  
✅ Interface user-friendly dan responsif  

---

## 🚀 Quick Start

### Prasyarat:
- PHP 8.2+
- MySQL 8.0+
- Composer
- Git

### Instalasi:

```bash
# 1. Clone project
git clone <repository-url>
cd Applikasi_Pengaduan_Sarana_Sekolah

# 2. Install dependencies
composer install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Configure database di .env
# DB_CONNECTION=mysql
# DB_DATABASE=pps_app
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Run migrations & seed
php artisan migrate
php artisan db:seed

# 6. Start server
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---

## 👥 Demo Akun

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | admin123 |
| Siswa | siswa1 | siswa123 |
| Siswa | siswa2 | siswa123 |
| Siswa | siswa3 | siswa123 |

---

## 📁 Struktur Project

```
Applikasi_Pengaduan_Sarana_Sekolah/
├── app/
│   ├── Http/Controllers/ (AuthController, AspirasiController, AdminController)
│   └── Models/ (User, Aspirasi, Kategori, Feedback)
│
├── database/
│   ├── migrations/
│   └── pengaduan_sarana.sql
│
├── resources/views/
│   ├── auth/ (login.blade.php)
│   ├── siswa/ (index, form_aspirasi, histori, detail_aspirasi)
│   ├── admin/ (dashboard, list_aspirasi, detail_aspirasi, feedback)
│   ├── partials/ (header, navbar, footer)
│   └── layouts/ (app.blade.php)
│
├── public/views/css/
│   ├── style.css
│   ├── auth.css
│   ├── siswa/siswa.css
│   └── admin/admin.css
│
├── routes/web.php
│
├── docs/
│   ├── deskripsi_program.md
│   ├── ERD.md
│   ├── dokumentasi_fungsi.md
│   ├── debugging.md
│   └── pengaduan_sarana.sql
│
└── README.md
```

---

## 🎯 Panduan Penggunaan

### Untuk Siswa:
1. **Login** dengan akun siswa
2. **Buat Aspirasi** via Form Aspirasi
3. **Pantau Status** di Histori Aspirasi
4. **Lihat Feedback** Admin di Detail Aspirasi

### Untuk Admin:
1. **Login** dengan akun admin
2. **Lihat Daftar** semua aspirasi
3. **Filter** berdasarkan status, kategori, siswa, atau tanggal
4. **Beri Feedback** dan update status aspirasi

---

## 🗄️ Database Schema

### Tables:
- **users** - Data pengguna (siswa & admin)
- **kategoris** - Kategori sarana sekolah
- **aspirasis** - Data pengaduan sarana
- **feedbacks** - Feedback admin untuk setiap aspirasi

### Relasi:
- users (1) → aspirasis (M)
- kategoris (1) → aspirasis (M)
- aspirasis (1) → feedbacks (1)

---

## 🔒 Security Features

- ✅ Password hashing dengan bcrypt
- ✅ Authentication middleware
- ✅ Authorization checks
- ✅ CSRF protection
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ Input validation
- ✅ Role-based access control

---

## 📊 API Routes

**Auth Routes:**
- GET `/login` - Login form
- POST `/login` - Process login
- POST `/logout` - Logout

**Siswa Routes (Protected):**
- GET `/siswa` - Dashboard siswa
- GET `/aspirasi/create` - Form aspirasi
- POST `/aspirasi` - Submit aspirasi
- GET `/aspirasi/histori` - Histori aspirasi
- GET `/aspirasi/{id}` - Detail aspirasi

**Admin Routes (Protected & Admin Only):**
- GET `/admin/dashboard` - Dashboard admin
- GET `/admin/aspirasi` - List aspirasi dengan filter
- GET `/admin/aspirasi/{id}` - Detail aspirasi
- GET `/admin/aspirasi/{id}/feedback` - Form feedback
- POST `/admin/aspirasi/{id}/feedback` - Submit feedback

---

## 🐛 Troubleshooting

**Database connection error:**
```bash
sudo service mysql start
# Verify .env configuration
```

**Migrate error:**
```bash
php artisan migrate:fresh --seed
```

**Route not found:**
```bash
php artisan route:clear
php artisan route:cache
```

Lihat [docs/debugging.md](docs/debugging.md) untuk troubleshooting lengkap

---

## 📚 Dokumentasi

- 📘 [Deskripsi Program](docs/deskripsi_program.md)
- 🗂️ [ERD Database](docs/ERD.md)
- 📝 [Dokumentasi Fungsi](docs/dokumentasi_fungsi.md)
- 🐛 [Debugging Guide](docs/debugging.md)
- 💾 [Database Script](docs/pengaduan_sarana.sql)

---

## 🛠️ Tech Stack

| Komponen | Technology |
|----------|-----------|
| Backend | Laravel 12 |
| Language | PHP 8.2+ |
| Database | MySQL 8.0+ |
| Frontend | Blade Template |
| Styling | CSS3 |

---

**Version:** 1.0.0  
**Status:** Production Ready ✅

*Dibuat untuk UKK RPL 2025/2026*
