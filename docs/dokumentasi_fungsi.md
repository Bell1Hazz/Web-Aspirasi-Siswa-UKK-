# 📋 Dokumentasi Fungsi & Procedure

## Daftar Isi
1. [Model Functions](#model-functions)
2. [Controller Functions](#controller-functions)
3. [Helper Functions](#helper-functions)
4. [Database Procedures](#database-procedures)

---

## 🏗️ Model Functions

### User Model

```php
class User extends Authenticatable {
    
    // Relasi: User -> Aspirasi (1 : Many)
    public function aspirasis() {
        return $this->hasMany(Aspirasi::class);
    }
    
    // Check apakah user adalah admin
    public function isAdmin() {
        return $this->role === 'admin';
    }
    
    // Check apakah user adalah siswa
    public function isSiswa() {
        return $this->role === 'siswa';
    }
}
```

**Usage:**
```php
$user = Auth::user();
$isAdmin = $user->isAdmin();
$aspirasis = $user->aspirasis()->get();
```

---

### Aspirasi Model

```php
class Aspirasi extends Model {
    
    // Relasi: Aspirasi -> User (Many : 1)
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // Relasi: Aspirasi -> Kategori (Many : 1)
    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
    
    // Relasi: Aspirasi -> Feedback (1 : 1)
    public function feedback() {
        return $this->hasOne(Feedback::class);
    }
    
    // Scope: Filter berdasarkan status
    public function scopeByStatus($query, $status) {
        return $query->where('status', $status);
    }
    
    // Scope: Filter berdasarkan siswa/user
    public function scopeBySiswa($query, $userId) {
        return $query->where('user_id', $userId);
    }
    
    // Scope: Filter berdasarkan kategori
    public function scopeByKategori($query, $kategoriId) {
        return $query->where('kategori_id', $kategoriId);
    }
    
    // Scope: Filter berdasarkan bulan
    public function scopeByBulan($query, $bulan, $tahun = null) {
        $tahun = $tahun ?? date('Y');
        return $query->whereMonth('tanggal_pengajuan', $bulan)
                     ->whereYear('tanggal_pengajuan', $tahun);
    }
}
```

**Usage:**
```php
// Get aspirasi siswa dengan status tertentu
$aspilDiajukan = Aspirasi::byStatus('Diajukan')->get();

// Get aspirasi user tertentu
$myAspirasis = Aspirasi::bySiswa(Auth::id())->get();

// Get aspirasi kategori tertentu
$aspilToilet = Aspirasi::byKategori(1)->get();

// Get aspirasi bulan tertentu
$aspilDesember = Aspirasi::byBulan(12, 2026)->get();
```

---

### Kategori Model

```php
class Kategori extends Model {
    
    // Relasi: Kategori -> Aspirasi (1 : Many)
    public function aspirasis() {
        return $this->hasMany(Aspirasi::class);
    }
}
```

**Usage:**
```php
$kategori = Kategori::find(1);
$aspirasisToilet = $kategori->aspirasis()->get();
```

---

### Feedback Model

```php
class Feedback extends Model {
    
    // Relasi: Feedback -> Aspirasi (Many : 1)
    public function aspirasi() {
        return $this->belongsTo(Aspirasi::class);
    }
}
```

---

## 🎮 Controller Functions

### AuthController

#### `showLoginForm()`
```php
/**
 * Display login form
 * 
 * @return \Illuminate\View\View
 */
public function showLoginForm() {
    return view('auth.login');
}
```

**Parameter**: Tidak ada
**Return**: View
**Keterangan**: Menampilkan halaman login

---

#### `login(Request $request)`
```php
/**
 * Proses login user
 * 
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function login(Request $request) {
    $validated = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string'
    ]);

    // Cari user berdasarkan username
    $user = User::where('username', $validated['username'])->first();

    // Verifikasi password
    if (!$user || !Hash::check($validated['password'], $user->password)) {
        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    // Login user dan buat session
    Auth::login($user);
    $request->session()->regenerate();

    // Redirect berdasarkan role
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('siswa.index');
    }
}
```

**Parameter**: 
- `$request`: HTTP request dengan username & password

**Return**: Redirect Response

**Proses**:
1. Validasi input (username, password)
2. Cari user di database
3. Hash password verification
4. Jika valid: login user & regenerate session
5. Redirect ke dashboard sesuai role
6. Jika tidak valid: return error message

---

#### `logout(Request $request)`
```php
/**
 * Logout user
 * 
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
}
```

---

### AspirasiController

#### `index()`
```php
/**
 * Display siswa dashboard/home
 * 
 * @return \Illuminate\View\View
 */
public function index() {
    $user = Auth::user();
    $totalAspi = $user->aspirasis()->count();
    $aspilDiajukan = $user->aspirasis()->where('status', 'Diajukan')->count();
    $aspilDiproses = $user->aspirasis()->where('status', 'Diproses')->count();
    $aspilSelesai = $user->aspirasis()->where('status', 'Selesai')->count();

    return view('siswa.index', compact(
        'totalAspi', 'aspilDiajukan', 'aspilDiproses', 'aspilSelesai'
    ));
}
```

**Return**: View dengan statistik aspirasi

---

#### `create()`
```php
/**
 * Show form create aspirasi
 * 
 * @return \Illuminate\View\View
 */
public function create() {
    $kategoris = Kategori::all();
    return view('siswa.form_aspirasi', compact('kategoris'));
}
```

---

#### `store(Request $request)`
```php
/**
 * Save aspirasi baru
 * 
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function store(Request $request) {
    $validated = $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string'
    ]);

    $validated['user_id'] = Auth::id();
    $validated['tanggal_pengajuan'] = now()->format('Y-m-d');
    $validated['status'] = 'Diajukan';

    Aspirasi::create($validated);

    return redirect()->route('siswa.histori')
                    ->with('success', 'Aspirasi berhasil dikirim!');
}
```

**Proses Penyimpanan**:
1. Validasi: kategori_id (exists), judul, deskripsi
2. Tambah user_id dari auth
3. Set tanggal_pengajuan = hari ini
4. Set status awal = 'Diajukan'
5. Simpan ke database
6. Redirect ke histori dengan pesan sukses

---

#### `histori()`
```php
/**
 * Display aspirasi history
 * 
 * @return \Illuminate\View\View
 */
public function histori() {
    $aspirasis = Auth::user()->aspirasis()
                            ->orderBy('created_at', 'desc')
                            ->get();
    return view('siswa.histori', compact('aspirasis'));
}
```

---

#### `show($id)`
```php
/**
 * Display aspirasi detail
 * 
 * @param int $id
 * @return \Illuminate\View\View
 */
public function show($id) {
    $aspirasi = Aspirasi::findOrFail($id);
    
    // Otorisasi
    if ($aspirasi->user_id != Auth::id() && !Auth::user()->isAdmin()) {
        abort(403);
    }

    return view('siswa.detail_aspirasi', compact('aspirasi'));
}
```

---

### AdminController

#### `dashboard()`
```php
/**
 * Display admin dashboard
 * 
 * @return \Illuminate\View\View
 */
public function dashboard() {
    $totalAspi = Aspirasi::count();
    $aspilDiajukan = Aspirasi::where('status', 'Diajukan')->count();
    $aspilDiproses = Aspirasi::where('status', 'Diproses')->count();
    $aspilSelesai = Aspirasi::where('status', 'Selesai')->count();

    return view('admin.dashboard', compact(
        'totalAspi', 'aspilDiajukan', 'aspilDiproses', 'aspilSelesai'
    ));
}
```

---

#### `listAspirasi(Request $request)`
```php
/**
 * Display aspirasi list dengan filter
 * 
 * @param Request $request
 * @return \Illuminate\View\View
 */
public function listAspirasi(Request $request) {
    $query = Aspirasi::with('user', 'kategori');

    // Filter berdasarkan status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter berdasarkan kategori
    if ($request->filled('kategori_id')) {
        $query->where('kategori_id', $request->kategori_id);
    }

    // Filter berdasarkan siswa
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    // Filter berdasarkan tanggal range
    if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
        $query->whereBetween('tanggal_pengajuan', [
            $request->tanggal_dari,
            $request->tanggal_sampai
        ]);
    }

    // Filter berdasarkan bulan
    if ($request->filled('bulan') && $request->filled('tahun')) {
        $query->byBulan($request->bulan, $request->tahun);
    }

    $aspirasis = $query->orderBy('created_at', 'desc')->paginate(10);
    
    $kategoris = Kategori::all();
    $siswas = User::where('role', 'siswa')->get();

    return view('admin.list_aspirasi', compact(
        'aspirasis', 'kategoris', 'siswas'
    ));
}
```

**Filter yang tersedia**:
- Status (Diajukan, Diproses, Selesai)
- Kategori Sarana
- Nama Siswa
- Range Tanggal (dari-sampai)
- Bulan & Tahun

**Pagination**: 10 item per halaman

---

#### `detailAspirasi($id)`
```php
/**
 * Display aspirasi detail (admin view)
 * 
 * @param int $id
 * @return \Illuminate\View\View
 */
public function detailAspirasi($id) {
    $aspirasi = Aspirasi::with('user', 'kategori', 'feedback')
                         ->findOrFail($id);
    return view('admin.detail_aspirasi', compact('aspirasi'));
}
```

---

#### `showFeedbackForm($id)`
```php
/**
 * Show feedback form
 * 
 * @param int $id
 * @return \Illuminate\View\View
 */
public function showFeedbackForm($id) {
    $aspirasi = Aspirasi::findOrFail($id);
    return view('admin.feedback', compact('aspirasi'));
}
```

---

#### `saveFeedback(Request $request, $id)`
```php
/**
 * Save feedback & update status
 * 
 * @param Request $request
 * @param int $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function saveFeedback(Request $request, $id) {
    $aspirasi = Aspirasi::findOrFail($id);

    $validated = $request->validate([
        'isi_feedback' => 'required|string',
        'status' => 'required|in:Diajukan,Diproses,Selesai'
    ]);

    // Update status aspirasi
    $aspirasi->update(['status' => $validated['status']]);

    // Hapus feedback lama jika ada
    if ($aspirasi->feedback) {
        $aspirasi->feedback->delete();
    }

    // Buat feedback baru
    Feedback::create([
        'aspirasi_id' => $id,
        'isi_feedback' => $validated['isi_feedback'],
        'tanggal_feedback' => now()->format('Y-m-d')
    ]);

    return redirect()->route('admin.detail', $id)
                    ->with('success', 'Feedback berhasil disimpan!');
}
```

**Proses**:
1. Validasi: isi_feedback, status
2. Update status aspirasi
3. Hapus feedback lama (jika ada)
4. Buat feedback baru
5. Set tanggal_feedback = hari ini
6. Redirect dengan pesan sukses

---

## 🛠️ Helper Functions

### Authentication Helpers

```php
// Check apakah user sudah login
auth()->check()     // true/false

// Get authenticated user
auth()->user()      // User object

// Get specific attribute
Auth::id()          // User ID
Auth::user()->name  // User name
Auth::user()->role  // User role

// Check role
auth()->user()->isAdmin()   // true/false
auth()->user()->isSiswa()   // true/false
```

---

### Query Builder Helpers

```php
// Count records
Aspirasi::count()                   // Total semua
Aspirasi::where('status', 'Diajukan')->count()

// Get all with relationships
Aspirasi::with('user', 'kategori')->get()

// Paginate
Aspirasi::paginate(10)              // 10 item per page

// Find by ID
Aspirasi::find($id)                 // Nullable
Aspirasi::findOrFail($id)           // Throw 404

// Find by column
User::where('username', $username)->first()
Kategori::where('nama_kategori', $name)->first()

// Get distinct
Aspirasi::distinct()->pluck('status')
```

---

### Date Helpers

```php
// Current date/time
now()                       // Current Carbon instance
now()->format('Y-m-d')      // Format: 2026-01-29
date('Y')                   // Year
date('m')                   // Month

// Parse date
Carbon::parse($date)        // String to Carbon
\Carbon\Carbon::createFromDate(null, $bulan)  // Date from month

// Date arithmetic
CURDATE()                   // Current date (SQL)
DATE_SUB(CURDATE(), INTERVAL 5 DAY)  // 5 days ago
```

---

## 💾 Database Procedures

### View: v_aspirasi_summary

```sql
CREATE VIEW v_aspirasi_summary AS
SELECT 
    a.id,
    a.judul,
    u.name as nama_siswa,
    u.username,
    k.nama_kategori,
    a.tanggal_pengajuan,
    a.status,
    CASE 
        WHEN f.id IS NOT NULL THEN 'Ada'
        ELSE 'Belum Ada'
    END as feedback_status,
    DATEDIFF(NOW(), a.tanggal_pengajuan) as hari_sejak_pengajuan
FROM aspirasis a
INNER JOIN users u ON a.user_id = u.id
INNER JOIN kategoris k ON a.kategori_id = k.id
LEFT JOIN feedbacks f ON a.id = f.aspirasi_id
ORDER BY a.created_at DESC;
```

**Gunakan**: 
```php
// Query view
DB::table('v_aspirasi_summary')->get()
```

---

### Sample Queries

#### Total aspirasi per status
```sql
SELECT status, COUNT(*) as total 
FROM aspirasis 
GROUP BY status;
```

#### Aspirasi belum ada feedback
```sql
SELECT a.*, u.name 
FROM aspirasis a 
JOIN users u ON a.user_id = u.id 
WHERE a.id NOT IN (SELECT DISTINCT aspirasi_id FROM feedbacks);
```

#### Aspirasi per kategori
```sql
SELECT k.nama_kategori, COUNT(a.id) as total 
FROM kategoris k 
LEFT JOIN aspirasis a ON k.id = a.kategori_id 
GROUP BY k.id, k.nama_kategori;
```

#### Aspirasi bulan ini
```sql
SELECT * 
FROM aspirasis 
WHERE MONTH(tanggal_pengajuan) = MONTH(NOW())
AND YEAR(tanggal_pengajuan) = YEAR(NOW());
```

---

*Dokumentasi dibuat untuk UKK RPL 2025/2026*
