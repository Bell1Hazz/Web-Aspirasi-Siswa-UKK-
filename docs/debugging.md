# 🐛 Debugging & Troubleshooting Guide

## Daftar Error & Solusi

---

## 1. Database Connection Error

### Error Message:
```
SQLSTATE[HY000] [2002] Connection refused
SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'
```

### Penyebab:
- MySQL server tidak running
- Konfigurasi database di `.env` salah
- MySQL username/password tidak sesuai

### Solusi:

#### A. Cek MySQL Status
**Linux:**
```bash
sudo service mysql status
sudo service mysql start      # Start MySQL
sudo service mysql restart    # Restart MySQL
```

**Windows:**
```bash
mysqld --install
net start MySQL
# atau gunakan Services app
```

**macOS:**
```bash
brew services start mysql
```

#### B. Verify `.env` Configuration
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pps_app
DB_USERNAME=root
DB_PASSWORD=              # kosong jika tidak ada password
```

#### C. Test MySQL Connection
```bash
# Linux/macOS
mysql -h 127.0.0.1 -u root -p

# Windows (Command Prompt)
mysql -h 127.0.0.1 -u root -p
```

---

## 2. Database Not Found

### Error Message:
```
SQLSTATE[HY000] [1049] Unknown database 'pps_app'
```

### Penyebab:
- Database belum dibuat
- Migration belum dijalankan

### Solusi:

#### A. Create Database
```bash
mysql -u root -p
mysql> CREATE DATABASE pps_app;
mysql> exit;
```

#### B. Jalankan Migration
```bash
php artisan migrate
```

#### C. Atau Import SQL File
```bash
mysql -u root -p pps_app < database/pengaduan_sarana.sql
```

---

## 3. Table Not Found

### Error Message:
```
SQLSTATE[42S02]: Table 'pps_app.aspirasis' doesn't exist
```

### Penyebab:
- Migration belum dijalankan
- Rollback migration tidak sengaja

### Solusi:

```bash
# Check migration status
php artisan migrate:status

# Fresh migration (hapus & buat ulang)
php artisan migrate:fresh

# Jika ingin seed data juga
php artisan migrate:fresh --seed
```

---

## 4. Class Not Found Error

### Error Message:
```
Class 'App\Models\Aspirasi' not found
Class 'App\Http\Controllers\AspirasiController' not found
```

### Penyebab:
- File model/controller tidak ada
- Autoload cache tidak di-refresh
- Namespace salah

### Solusi:

```bash
# Dump autoload
composer dump-autoload
composer dump-autoload --optimize  # Dengan optimization

# Clear cache
php artisan cache:clear
php artisan config:clear
```

---

## 5. Route Not Found

### Error Message:
```
Target class [App\Http\Controllers\AuthController] does not exist.
No routes found matching the given conditions.
```

### Penyebab:
- Route tidak terdaftar di `routes/web.php`
- Controller tidak ditemukan
- Route cache error

### Solusi:

#### A. Verify Route Definition
```bash
# Lihat semua route
php artisan route:list

# Filter route tertentu
php artisan route:list --name=login
```

#### B. Clear Route Cache
```bash
php artisan route:clear
php artisan route:cache
```

#### C. Check `routes/web.php`
```php
// Pastikan import controller ada
use App\Http\Controllers\AuthController;

// Pastikan route didefinisikan
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
```

---

## 6. Login Failed

### Error Message:
```
Username atau password salah
```

### Penyebab:
- User tidak ada di database
- Password tidak match
- Username field salah

### Solusi:

#### A. Check User di Database
```bash
# Using Tinker
php artisan tinker
>>> User::all()
>>> User::where('username', 'admin')->first()
```

#### B. Verify Password Hash
```php
// Tinker
>>> use Illuminate\Support\Facades\Hash;
>>> Hash::make('admin123')  // Generate hash
>>> Hash::check('admin123', $hashedPassword)  // Verify
```

#### C. Create User dengan Hash Password
```bash
php artisan tinker
>>> use App\Models\User;
>>> use Illuminate\Support\Facades\Hash;
>>> User::create([
    'name' => 'Admin',
    'username' => 'admin',
    'password' => Hash::make('admin123'),
    'role' => 'admin'
]);
```

---

## 7. View File Not Found

### Error Message:
```
View [siswa.index] not found.
View [auth.login] not found.
```

### Penyebab:
- File blade tidak ada di `resources/views`
- Path view salah
- Nama file typo

### Solusi:

#### A. Check Struktur Folder
```
resources/views/
├── auth/
│   └── login.blade.php
├── siswa/
│   ├── index.blade.php
│   ├── form_aspirasi.blade.php
│   ├── histori.blade.php
│   └── detail_aspirasi.blade.php
└── admin/
    ├── dashboard.blade.php
    ├── list_aspirasi.blade.php
    ├── detail_aspirasi.blade.php
    └── feedback.blade.php
```

#### B. Verify View Directive
```blade
{{-- Correct --}}
@extends('layouts.app')
@include('partials.navbar')

{{-- Wrong --}}
@extends('app.layouts')
@include('navbar.partials')
```

---

## 8. CSS/JS Not Loading

### Error Message:
```
Failed to load resource: the server responded with a status of 404 (Not Found)
```

### Penyebab:
- File CSS/JS path salah
- File tidak ada
- Browser cache

### Solusi:

#### A. Check File Path
```blade
{{-- Correct path --}}
<link rel="stylesheet" href="{{ asset('views/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('views/siswa/siswa.css') }}">

{{-- Wrong --}}
<link rel="stylesheet" href="views/css/style.css">
<link rel="stylesheet" href="/css/style.css">
```

#### B. Verify File Exists
```
public/views/
├── css/
│   ├── style.css
│   └── auth.css
├── siswa/
│   └── siswa.css
└── admin/
    └── admin.css
```

#### C. Clear Browser Cache
- Press: `Ctrl + Shift + Delete` (Windows/Linux)
- Press: `Cmd + Shift + Delete` (macOS)
- Select: Clear browsing data → All time

#### D. Hard Refresh
- Press: `Ctrl + F5` (Windows/Linux)
- Press: `Cmd + Shift + R` (macOS)

---

## 9. Foreign Key Constraint Error

### Error Message:
```
SQLSTATE[HY000]: General error: 1030 Got error 28 from storage engine
SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row
```

### Penyebab:
- Foreign key value tidak ada di parent table
- Foreign key constraint error
- Data consistency issue

### Solusi:

#### A. Check Foreign Key Definition
```php
// Migration harus benar
$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
$table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
```

#### B. Fresh Migrate (Jika development)
```bash
php artisan migrate:fresh --seed
```

#### C. Verify Data Integrity
```bash
php artisan tinker
>>> Aspirasi::where('user_id', 999)->exists()  // Check invalid FK
>>> Kategori::find(999)  // Check kategori exists
```

---

## 10. Permission Denied Error

### Error Message:
```
The server returned a "403 Forbidden" response
Access denied
```

### Penyebab:
- User tidak punya role yang tepat
- Authorization check gagal
- Middleware tidak bekerja

### Solusi:

#### A. Check Middleware
```php
// Pastikan middleware di controller
public function __construct() {
    $this->middleware('auth');
}
```

#### B. Verify Authorization Logic
```php
// Check di controller
if ($aspirasi->user_id != Auth::id() && !Auth::user()->isAdmin()) {
    abort(403);  // Forbidden
}
```

#### C. Check Role
```bash
php artisan tinker
>>> Auth::user()->role
>>> Auth::user()->isAdmin()
```

---

## 11. Session/Authentication Issues

### Error Message:
```
User not authenticated
Session expired
```

### Penyebab:
- Session timeout
- Database session tidak enabled
- .env SESSION_DRIVER salah

### Solusi:

#### A. Check Session Configuration
```
SESSION_DRIVER=database      // Correct untuk app ini
SESSION_DRIVER=file          // Wrong
CACHE_STORE=database         // Verify cache
```

#### B. Create Session Table
```bash
php artisan session:table
php artisan migrate
```

#### C. Clear Session Cache
```bash
php artisan cache:clear
php artisan session:clear
```

---

## 12. Validation Error

### Error Message:
```
The given data was invalid.
The {field} field is required.
```

### Penyebab:
- Input validation gagal
- Field name salah
- Data format tidak sesuai

### Solusi:

#### A. Check Validation Rules
```php
$validated = $request->validate([
    'kategori_id' => 'required|exists:kategoris,id',
    'judul' => 'required|string|max:255',
    'deskripsi' => 'required|string'
]);
```

#### B. Display Validation Errors di View
```blade
@if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@error('kategori_id')
    <span class="error">{{ $message }}</span>
@enderror
```

#### C. Send Form Data Correctly
```blade
<form method="POST" action="{{ route('aspirasi.store') }}">
    @csrf
    <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
    <textarea name="deskripsi" required></textarea>
</form>
```

---

## 13. Blade Compilation Error

### Error Message:
```
ParseError: syntax error, unexpected T_VARIABLE
```

### Penyebab:
- Syntax error di blade template
- Unclosed tag atau bracket
- Invalid PHP expression

### Solusi:

```blade
{{-- Wrong --}}
@if($user->isAdmin
<p>Admin</p>
@endif

{{-- Correct --}}
@if($user->isAdmin())
    <p>Admin</p>
@endif

{{-- Wrong --}}
<p>{{ $user->name }</p>

{{-- Correct --}}
<p>{{ $user->name }}</p>
```

---

## 14. Pagination Error

### Error Message:
```
Call to a member function links() on null
```

### Penyebab:
- Query tidak di-paginate dengan benar
- Variable null

### Solusi:

```php
// Wrong
$aspirasis = Aspirasi::get();
$aspirasis->links();  // Error

// Correct
$aspirasis = Aspirasi::paginate(10);
$aspirasis->links();  // OK
```

---

## 15. Relationship Not Working

### Error Message:
```
Call to undefined relationship
```

### Penyebab:
- Relationship method tidak didefinisikan di model
- Nama relationship salah
- Relationship type error

### Solusi:

```php
// Model: User.php
public function aspirasis() {
    return $this->hasMany(Aspirasi::class);  // 1:M
}

// Model: Aspirasi.php
public function user() {
    return $this->belongsTo(User::class);    // Inverse
}

// Usage:
$user->aspirasis()->get();           // OK
$aspirasi->user->name;               // OK
```

---

## Testing & Verification Checklist

### Pre-Deployment Checklist
- ✅ Database migrated
- ✅ All tables created
- ✅ Sample data seeded
- ✅ Routes all working
- ✅ Views rendering correctly
- ✅ CSS/JS loading
- ✅ Login working (admin & siswa)
- ✅ CRUD operations working
- ✅ Relationships working
- ✅ Validations working
- ✅ Authentication middleware working
- ✅ Authorization checks working

---

## Debug Mode

### Enable Debug Mode
```
APP_DEBUG=true    # .env
```

### Disable Debug Mode (Production)
```
APP_DEBUG=false   # .env
```

### View Debug Information
```bash
php artisan tinker
>>> config('app.debug')
```

---

*Troubleshooting guide untuk UKK RPL 2025/2026*
