# 📝 Panduan Registrasi & Login

## Fitur Baru

Sistem aplikasi Pengaduan Sarana Sekolah telah diperbarui dengan fitur-fitur berikut:

### ✨ Fitur Registrasi
- User (Siswa) dapat mendaftar sendiri tanpa perlu admin membuat akun
- Validasi lengkap untuk nama, username, email, dan password
- Password hashing dengan bcrypt untuk keamanan
- Auto-login setelah registrasi berhasil

### 🔐 Fitur Login Fleksibel
- Login bisa menggunakan **username** ATAU **email/gmail**
- Keamanan password dengan hash comparison
- Session management yang proper

### 👥 Manajemen Admin
- Admin account dibuat otomatis via seeder
- Tidak ditampilkan di halaman login
- Data admin disimpan di database melalui `php artisan db:seed`

---

## Panduan Penggunaan

### Untuk User Baru (Siswa)

#### 1. **Registrasi Akun**
```
URL: /register
```

**Langkah-langkah:**
1. Buka halaman registrasi di `/register`
2. Isi form dengan data berikut:
   - **Nama Lengkap**: Nama asli siswa
   - **Username**: Username unik (min 3 karakter)
   - **Email/Gmail**: Email aktif untuk recovery password nantinya
   - **Password**: Password minimal 6 karakter
   - **Konfirmasi Password**: Ulangi password untuk verifikasi

3. Klik tombol "Daftar"
4. Jika berhasil, user otomatis login dan diarahkan ke dashboard siswa

#### 2. **Login dengan Username**
```
URL: /login
Username: (username yang didaftar saat registrasi)
Password: (password yang dibuat saat registrasi)
```

#### 3. **Login dengan Email/Gmail**
```
URL: /login
Username: (gunakan email Anda)
Password: (password Anda)
```

---

### Untuk Admin

#### Admin Accounts (dari Seeder)
```
Admin 1:
├── Nama: Admin Sekolah
├── Username: admin
├── Email: admin@sekolah.com
└── Password: admin123

Admin 2:
├── Nama: Admin Wakil
├── Username: admin2
├── Email: admin2@sekolah.com
└── Password: admin123
```

#### Cara Membuat Admin Account
1. Edit file: `database/seeders/UserSeeder.php`
2. Tambahkan user baru dengan `role: 'admin'`
3. Run command:
   ```bash
   php artisan db:seed --class=UserSeeder
   ```

---

## Validasi Form

### Registrasi Validasi

| Field | Rule | Pesan Error |
|-------|------|-------------|
| Nama | required, max 100 | Nama lengkap harus diisi |
| Username | required, min 3, max 50, unique | Username minimal 3 karakter, harus unik |
| Email | required, email, unique | Format email tidak valid, email sudah terdaftar |
| Password | required, min 6, confirmed | Password minimal 6 karakter, konfirmasi tidak cocok |

### Login Validasi

| Field | Rule | Pesan Error |
|-------|------|-------------|
| Username/Email | required | Username/Email harus diisi |
| Password | required | Password harus diisi |

---

## Database Structure

### Users Table
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'siswa') DEFAULT 'siswa',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## Authentication Flow

### Registration Flow
```
User visits /register
    ↓
Fill registration form
    ↓
Submit to POST /register
    ↓
Validate input (RegisterController@register)
    ↓
Hash password
    ↓
Create user in database (role: siswa)
    ↓
Auto-login user
    ↓
Redirect to /siswa (dashboard siswa)
```

### Login Flow
```
User visits /login
    ↓
Enter username/email and password
    ↓
Submit to POST /login
    ↓
Check database (username OR email match)
    ↓
Verify password with Hash::check()
    ↓
If valid: create session and login
    ↓
Redirect based on role:
├─ admin → /admin/dashboard
└─ siswa → /siswa
```

---

## File-File Penting

### New Files
- `app/Http/Controllers/RegisterController.php` - Menangani registrasi
- `resources/views/auth/register.blade.php` - Form registrasi
- `database/seeders/UserSeeder.php` - Seed user (admin) accounts
- `database/seeders/KategoriSeeder.php` - Seed kategori sarana

### Modified Files
- `app/Http/Controllers/AuthController.php` - Update login untuk email/username
- `resources/views/auth/login.blade.php` - Hapus demo credentials, tambah link register
- `routes/web.php` - Tambah register routes
- `public/views/css/auth.css` - Tambah styling untuk register page

---

## Setup Instructions

### 1. Fresh Migration & Seed
```bash
# Reset database dan run migrations + seeders
php artisan migrate:fresh --seed
```

### 2. Manual Setup
```bash
# Hanya migration
php artisan migrate

# Run seeders terpisah
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=KategoriSeeder
```

### 3. Troubleshooting

**Error: "SQLSTATE[HY000]: General error"**
- Pastikan database sudah dibuat
- Check `.env` database configuration

**Error: "User already exists"**
- Hapus user duplikat di database
- Atau gunakan `php artisan migrate:fresh --seed`

---

## Security Notes

✅ **Good Practices:**
- Password di-hash dengan bcrypt
- CSRF protection di semua form
- SQL injection prevention (Eloquent ORM)
- Input validation di semua endpoint
- Email uniqueness validation

⚠️ **Best Practices (Optional):**
- Tambahkan email verification untuk registrasi
- Implementasi "forgot password" functionality
- Rate limiting untuk login attempts
- Two-factor authentication (2FA)

---

## Demo Accounts

### Admin Accounts (built-in dari seeder)
```
Admin 1: admin / admin123
Admin 2: admin2 / admin123
```

### Sample Siswa Accounts (dari seeder)
```
Siswa 1: budi / siswa123
Siswa 2: siti / siswa123
Siswa 3: ahmad / siswa123
```

---

## Pertanyaan Umum (FAQ)

**Q: Bagaimana jika user lupa password?**
A: Saat ini belum ada fitur reset password. Implementasi di masa depan.

**Q: Apakah username bisa diubah setelah registrasi?**
A: Belum ada. Sistem saat ini tidak memperbolehkan edit username.

**Q: Dapatkah user yang sama login di beberapa device?**
A: Ya, Laravel memperbolehkan multiple sessions per user.

**Q: Bagaimana cara membuat admin baru?**
A: Edit `database/seeders/UserSeeder.php` dan tambahkan user dengan `role: 'admin'`.

---

*Last Updated: 29 Januari 2026*
