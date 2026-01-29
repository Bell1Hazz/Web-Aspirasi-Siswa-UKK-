@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="admin-dashboard">
    <div class="dashboard-header">
        <h2>📊 Dashboard Admin</h2>
        <p>Ringkasan Data Aspirasi dan Pengaduan Sarana Sekolah</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon">📋</div>
            <div class="stat-info">
                <h3>{{ $totalAspi }}</h3>
                <p>Total Aspirasi</p>
            </div>
        </div>

        <div class="stat-card stat-diajukan">
            <div class="stat-icon">⏳</div>
            <div class="stat-info">
                <h3>{{ $aspilDiajukan }}</h3>
                <p>Diajukan</p>
            </div>
        </div>

        <div class="stat-card stat-diproses">
            <div class="stat-icon">⚙️</div>
            <div class="stat-info">
                <h3>{{ $aspilDiproses }}</h3>
                <p>Diproses</p>
            </div>
        </div>

        <div class="stat-card stat-selesai">
            <div class="stat-icon">✅</div>
            <div class="stat-info">
                <h3>{{ $aspilSelesai }}</h3>
                <p>Selesai</p>
            </div>
        </div>
    </div>

    <div class="action-section">
        <h3>🔧 Menu Utama</h3>
        <div class="action-buttons">
            <a href="{{ route('admin.list') }}" class="btn btn-primary btn-lg">
                📝 Kelola Daftar Aspirasi
            </a>
            <a href="{{ route('admin.list') }}?status=Diajukan" class="btn btn-warning btn-lg">
                ⏳ Aspirasi Baru
            </a>
            <a href="{{ route('admin.list') }}?status=Diproses" class="btn btn-info btn-lg">
                ⚙️ Sedang Diproses
            </a>
        </div>
    </div>

    <div class="info-section">
        <h3>📌 Petunjuk Admin</h3>
        <ul>
            <li>Pantau semua aspirasi yang masuk dari siswa</li>
            <li>Berikan feedback dan update status aspirasi</li>
            <li>Filter aspirasi berdasarkan kategori, siswa, atau tanggal</li>
            <li>Pastikan setiap aspirasi mendapat respons yang tepat dan cepat</li>
        </ul>
    </div>
</div>
@endsection
