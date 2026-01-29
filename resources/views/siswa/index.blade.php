@extends('layouts.app')

@section('title', 'Beranda Siswa')

@section('content')
<div class="siswa-beranda">
    <div class="beranda-header">
        <h2>🏠 Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p>Kelola aspirasi dan pengaduan sarana sekolah Anda di sini</p>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-content">
                <h3>{{ $totalAspi }}</h3>
                <p>Total Aspirasi</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-content">
                <h3>{{ $aspilDiajukan }}</h3>
                <p>Diajukan</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⚙️</div>
            <div class="stat-content">
                <h3>{{ $aspilDiproses }}</h3>
                <p>Diproses</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-content">
                <h3>{{ $aspilSelesai }}</h3>
                <p>Selesai</p>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('aspirasi.create') }}" class="btn btn-primary btn-lg">
            ➕ Buat Aspirasi Baru
        </a>
        <a href="{{ route('aspirasi.histori') }}" class="btn btn-secondary btn-lg">
            📜 Lihat Histori Aspirasi
        </a>
    </div>

    <div class="info-box">
        <h3>📌 Panduan Penggunaan</h3>
        <ul>
            <li>Klik "<strong>Buat Aspirasi Baru</strong>" untuk mengirimkan pengaduan</li>
            <li>Isi detail pengaduan dengan lengkap dan jelas</li>
            <li>Pantau status pengaduan Anda di "<strong>Histori Aspirasi</strong>"</li>
            <li>Admin akan memberikan feedback dan update status pengaduan</li>
        </ul>
    </div>
</div>
@endsection
