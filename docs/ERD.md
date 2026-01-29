# 📊 Entity Relationship Diagram (ERD)

## Database Schema: Aplikasi Pengaduan Sarana Sekolah

```
┌─────────────────────────┐
│       USERS             │
├─────────────────────────┤
│ id (PK)                 │
│ name                    │
│ username                │
│ password                │
│ role (admin/siswa)      │
│ created_at              │
│ updated_at              │
└─────────────────────────┘
        │
        │ 1 : Many
        ├─────────────────────┐
        │                     │
        ▼                     ▼
┌──────────────────────┐  
│     ASPIRASIS        │  
├──────────────────────┤  
│ id (PK)              │  
│ user_id (FK)    ◄────┼─ 1
│ kategori_id (FK) ──┐│
│ judul              ││
│ deskripsi          ││
│ tanggal_pengajuan  ││
│ status             ││
│ created_at         ││
│ updated_at         ││
└──────────────────────┘│
        │              │
        │ 1 : 1        │
        ├───────────┐  │
        │           │  │
        ▼           │  │
┌──────────────────────┐ │
│    FEEDBACKS         │ │
├──────────────────────┤ │
│ id (PK)              │ │
│ aspirasi_id (FK) ◄───┘ │
│ isi_feedback         │  │
│ tanggal_feedback     │  │
│ created_at           │  │
│ updated_at           │  │
└──────────────────────┘  │
                          │
                    ▲─────┘
                    │
               1 : Many
                    │
        ┌───────────┘
        │
        ▼
    ┌─────────────────────┐
    │    KATEGORIS        │
    ├─────────────────────┤
    │ id (PK)             │
    │ nama_kategori       │
    │ created_at          │
    │ updated_at          │
    └─────────────────────┘

```

## Relasi Database:

### 1. Users → Aspirasis
- **Tipe**: One-to-Many (1:M)
- **Keterangan**: 
  - 1 User bisa memiliki banyak Aspirasi
  - Setiap Aspirasi milik 1 User (siswa)
- **Foreign Key**: `aspirasis.user_id` → `users.id`
- **Constraint**: ON DELETE CASCADE

### 2. Kategoris → Aspirasis
- **Tipe**: One-to-Many (1:M)
- **Keterangan**:
  - 1 Kategori bisa memiliki banyak Aspirasi
  - Setiap Aspirasi termasuk 1 Kategori
- **Foreign Key**: `aspirasis.kategori_id` → `kategoris.id`
- **Constraint**: ON DELETE CASCADE

### 3. Aspirasis → Feedbacks
- **Tipe**: One-to-One (1:1)
- **Keterangan**:
  - 1 Aspirasi memiliki 0 atau 1 Feedback
  - 1 Feedback hanya untuk 1 Aspirasi
- **Foreign Key**: `feedbacks.aspirasi_id` → `aspirasis.id`
- **Constraint**: ON DELETE CASCADE

---

## Data Flow Diagram:

```
┌─────────────┐
│   SISWA     │
└──────┬──────┘
       │
       │ Login (username, password)
       │
       ▼
┌──────────────────┐
│  AuthController  │
│  - showLoginForm │
│  - login()       │
│  - logout()      │
└──────────────────┘
       │
       ├─► Buat Aspirasi Baru
       │   - Form Aspirasi
       │   - Submit Aspirasi
       │   - Simpan ke DB
       │
       ├─► Lihat Histori
       │   - Daftar Aspirasi
       │   - Detail Aspirasi
       │   - Lihat Feedback
       │
       └─► Logout

┌──────────────┐
│    ADMIN     │
└──────┬───────┘
       │
       │ Login (username, password)
       │
       ▼
┌──────────────────┐
│ AdminController  │
│ - dashboard()    │
│ - listAspirasi() │
│ - detailAspirasi │
│ - saveFeedback() │
└──────────────────┘
       │
       ├─► Dashboard
       │   - Lihat Statistik
       │   - Total Aspirasi
       │   - Status Overview
       │
       ├─► Kelola Aspirasi
       │   - Filter Data
       │   - Lihat Detail
       │   - Beri Feedback
       │   - Update Status
       │
       └─► Logout
```

---

## Status Workflow:

```
┌──────────────┐
│   DIAJUKAN   │ (Status: Diajukan)
│ (Initial)    │ Siswa baru submit aspirasi
└──────┬───────┘
       │ Admin memberi feedback
       │ dan mengubah status
       ▼
┌──────────────┐
│  DIPROSES    │ (Status: Diproses)
│ (In Progress)│ Aspirasi sedang ditangani
└──────┬───────┘
       │ Admin memberikan feedback
       │ perkembangan/hasil perbaikan
       ▼
┌──────────────┐
│   SELESAI    │ (Status: Selesai)
│ (Completed)  │ Aspirasi sudah ditangani
└──────────────┘
```

---

## Contoh Data Hubungan:

### Users Table:
| id | name | username | role |
|----|------|----------|------|
| 1 | Admin | admin | admin |
| 2 | Andi Wijaya | siswa1 | siswa |
| 3 | Budi Santoso | siswa2 | siswa |

### Kategoris Table:
| id | nama_kategori |
|----|---------------|
| 1 | Toilet/WC |
| 2 | Meja dan Kursi |
| 3 | Papan Tulis |

### Aspirasis Table:
| id | user_id | kategori_id | judul | status |
|----|---------|-------------|-------|--------|
| 1 | 2 | 1 | Pintu Toilet Rusak | Diajukan |
| 2 | 2 | 2 | Kursi Kelas Rusak | Diproses |
| 3 | 3 | 3 | Papan Tulis Tidak Bisa Dihapus | Selesai |

### Feedbacks Table:
| id | aspirasi_id | isi_feedback | tanggal_feedback |
|----|-------------|--------------|------------------|
| 1 | 1 | Sudah diperbaiki minggu lalu | 2026-01-25 |
| 2 | 3 | Papan tulis baru sudah dipasang | 2026-01-20 |

---

## Analisis Relasi:

### Aspek Normalisasi:
- ✅ **1NF (First Normal Form)**: Setiap atribut atomic, tidak ada repeating group
- ✅ **2NF (Second Normal Form)**: Semua non-key attributes fully functional dependent
- ✅ **3NF (Third Normal Form)**: Tidak ada transitive dependency

### Integritas Data:
- ✅ **Primary Key**: Setiap tabel memiliki PK unik
- ✅ **Foreign Key**: Relasi antar tabel terenkripsi
- ✅ **Cascade Delete**: Hapus parent → child otomatis terhapus
- ✅ **Unique Constraint**: Username unique, nama_kategori unique

---

*Diagram dibuat untuk dokumentasi UKK RPL 2025/2026*
