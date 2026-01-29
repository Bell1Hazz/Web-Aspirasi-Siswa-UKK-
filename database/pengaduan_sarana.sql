-- ============================================
-- DATABASE SCRIPT: Pengaduan Sarana Sekolah
-- Created: 2026-01-29
-- Laravel 12 + MySQL
-- ============================================

-- Drop existing tables if they exist
DROP TABLE IF EXISTS feedbacks;
DROP TABLE IF EXISTS aspirasis;
DROP TABLE IF EXISTS kategoris;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS cache;
DROP TABLE IF EXISTS jobs;

-- ============================================
-- TABLE: users
-- ============================================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('siswa', 'admin') NOT NULL DEFAULT 'siswa',
    remember_token VARCHAR(100),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TABLE: kategoris
-- ============================================
CREATE TABLE kategoris (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TABLE: aspirasis
-- ============================================
CREATE TABLE aspirasis (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    kategori_id BIGINT UNSIGNED NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi LONGTEXT NOT NULL,
    tanggal_pengajuan DATE NOT NULL,
    status ENUM('Diajukan', 'Diproses', 'Selesai') NOT NULL DEFAULT 'Diajukan',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (kategori_id) REFERENCES kategoris(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TABLE: feedbacks
-- ============================================
CREATE TABLE feedbacks (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    aspirasi_id BIGINT UNSIGNED NOT NULL,
    isi_feedback LONGTEXT NOT NULL,
    tanggal_feedback DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (aspirasi_id) REFERENCES aspirasis(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TABLE: cache
-- ============================================
CREATE TABLE cache (
    key VARCHAR(255) NOT NULL PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TABLE: jobs
-- ============================================
CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts TINYINT UNSIGNED NOT NULL DEFAULT 0,
    reserved_at INT UNSIGNED,
    available_at INT UNSIGNED NOT NULL,
    created_at INT UNSIGNED NOT NULL,
    INDEX queue_index (queue)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- CREATE INDEXES
-- ============================================
CREATE INDEX aspirasis_user_id_index ON aspirasis(user_id);
CREATE INDEX aspirasis_kategori_id_index ON aspirasis(kategori_id);
CREATE INDEX aspirasis_status_index ON aspirasis(status);
CREATE INDEX aspirasis_tanggal_pengajuan_index ON aspirasis(tanggal_pengajuan);
CREATE INDEX feedbacks_aspirasi_id_index ON feedbacks(aspirasi_id);

-- ============================================
-- INSERT SAMPLE DATA
-- ============================================

-- Kategori Sarana
INSERT INTO kategoris (nama_kategori, created_at, updated_at) VALUES
('Toilet/WC', NOW(), NOW()),
('Meja dan Kursi', NOW(), NOW()),
('Papan Tulis', NOW(), NOW()),
('Lampu dan Listrik', NOW(), NOW()),
('Jendela dan Pintu', NOW(), NOW()),
('Atap Gedung', NOW(), NOW()),
('Kolam/Saluran Air', NOW(), NOW()),
('Peralatan Olahraga', NOW(), NOW()),
('Perpustakaan', NOW(), NOW()),
('Lab Komputer', NOW(), NOW());

-- Users (Admin & Siswa Demo)
-- Password: admin123 (hashed dengan bcrypt)
-- Password: siswa123 (hashed dengan bcrypt)
INSERT INTO users (name, username, password, role, created_at, updated_at) VALUES
('Administrator', 'admin', '$2y$12$c9P6U3.MKlLbFl4VuUWZnuXPw8CMxfL4v1IfV7J8KH7L8zzQfhWpG', 'admin', NOW(), NOW()),
('Siswa Demo 1', 'siswa1', '$2y$12$Z1m5IHhzK7.3N2aLpQ5P9e1W5Y7B2C8xV6qM4dF1K3L5N8q9rT2Hy', 'siswa', NOW(), NOW()),
('Siswa Demo 2', 'siswa2', '$2y$12$Z1m5IHhzK7.3N2aLpQ5P9e1W5Y7B2C8xV6qM4dF1K3L5N8q9rT2Hy', 'siswa', NOW(), NOW()),
('Siswa Demo 3', 'siswa3', '$2y$12$Z1m5IHhzK7.3N2aLpQ5P9e1W5Y7B2C8xV6qM4dF1K3L5N8q9rT2Hy', 'siswa', NOW(), NOW());

-- Sample Aspirasi Data
INSERT INTO aspirasis (user_id, kategori_id, judul, deskripsi, tanggal_pengajuan, status, created_at, updated_at) VALUES
(2, 1, 'Pintu Toilet Rusak di Gedung A', 'Pintu toilet di lantai 2 gedung A tidak dapat menutup dengan sempurna. Hal ini mengganggu privasi pengguna. Mohon segera diperbaiki.', CURDATE(), 'Selesai', NOW(), NOW()),
(2, 2, 'Kursi Rusak di Kelas 10-A', 'Ada 3 kursi yang rusak dan tidak dapat digunakan di kelas 10-A. Ini mengganggu proses belajar mengajar karena ada siswa yang tidak memiliki tempat duduk.', DATE_SUB(CURDATE(), INTERVAL 5 DAY), 'Diproses', NOW(), NOW()),
(3, 3, 'Papan Tulis Tidak Bisa Dihapus di Kelas 11-B', 'Papan tulis di kelas 11-B sudah sangat kotor dan tidak bisa dibersihkan. Marker yang digunakan tidak bisa dihapus dengan baik. Silakan ganti papan tulis baru.', DATE_SUB(CURDATE(), INTERVAL 3 DAY), 'Diajukan', NOW(), NOW()),
(3, 4, 'Lampu Kelas Mati di Ruang Laboratorium', 'Beberapa lampu di ruang laboratorium IPA sudah mati dan tidak berfungsi. Hal ini membuat suasana laboratorium menjadi gelap dan mengganggu proses praktikum.', CURDATE(), 'Diajukan', NOW(), NOW()),
(4, 5, 'Jendela Rusak Gedung Perpustakaan', 'Jendela di gedung perpustakaan sudah rusak dan tidak rapat. Air hujan masuk ke dalam ruangan saat hujan deras. Perlu segera diperbaiki.', DATE_SUB(CURDATE(), INTERVAL 10 DAY), 'Selesai', NOW(), NOW());

-- Sample Feedback Data
INSERT INTO feedbacks (aspirasi_id, isi_feedback, tanggal_feedback, created_at, updated_at) VALUES
(1, 'Terima kasih atas laporannya. Tim maintenance kami telah memperbaiki pintu toilet tersebut pada hari Jumat kemarin. Silakan cek kembali dan laporkan jika ada masalah lagi.', CURDATE(), NOW(), NOW()),
(2, 'Kami telah menerima laporan Anda. Kursi yang rusak sedang dalam proses perbaikan oleh tim kami. Diperkirakan akan selesai dalam 2-3 hari ke depan. Terima kasih atas kesabarannya.', CURDATE(), NOW(), NOW()),
(5, 'Jendela perpustakaan telah kami perbaiki dan sudah rapat kembali. Terima kasih telah melaporkan masalah ini dengan cepat.', DATE_SUB(CURDATE(), INTERVAL 5 DAY), NOW(), NOW());

-- ============================================
-- CREATE VIEW (OPTIONAL)
-- ============================================
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

-- ============================================
-- SAMPLE QUERIES
-- ============================================
-- Total aspirasi per status
-- SELECT status, COUNT(*) as total FROM aspirasis GROUP BY status;

-- Aspirasi belum ada feedback
-- SELECT a.*, u.name FROM aspirasis a JOIN users u ON a.user_id = u.id WHERE a.id NOT IN (SELECT DISTINCT aspirasi_id FROM feedbacks);

-- Aspirasi per kategori
-- SELECT k.nama_kategori, COUNT(a.id) as total FROM kategoris k LEFT JOIN aspirasis a ON k.id = a.kategori_id GROUP BY k.id, k.nama_kategori;
