@extends('layouts.app')

@section('title', 'Detail Aspirasi')

@section('content')
<div class="detail-container">
    <div class="detail-header">
        <div>
            <h2>📋 {{ $aspirasi->judul }}</h2>
            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $aspirasi->status)) }}">
                {{ $aspirasi->status }}
            </span>
        </div>
        <a href="{{ route('aspirasi.histori') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="detail-content">
        <div class="info-section">
            <h3>ℹ️ Informasi Pengaduan</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Nama Siswa:</span>
                    <span class="value">{{ $aspirasi->user->name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Kategori:</span>
                    <span class="value">{{ $aspirasi->kategori->nama_kategori }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Tanggal Pengajuan:</span>
                    <span class="value">{{ \Carbon\Carbon::parse($aspirasi->tanggal_pengajuan)->format('d-m-Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Status:</span>
                    <span class="value status-text">{{ $aspirasi->status }}</span>
                </div>
            </div>
        </div>

        <div class="deskripsi-section">
            <h3>📝 Deskripsi Lengkap</h3>
            <div class="deskripsi-box">
                {{ $aspirasi->deskripsi }}
            </div>
        </div>

        @if($aspirasi->feedback)
            <div class="feedback-section">
                <h3>💬 Feedback dari Admin</h3>
                <div class="feedback-box">
                    <div class="feedback-meta">
                        <span class="date">Tanggal Feedback: {{ \Carbon\Carbon::parse($aspirasi->feedback->tanggal_feedback)->format('d-m-Y') }}</span>
                    </div>
                    <p class="feedback-text">{{ $aspirasi->feedback->isi_feedback }}</p>
                </div>
            </div>
        @else
            <div class="no-feedback-box">
                <p>⏳ Aspirasi Anda belum mendapat feedback dari admin</p>
                <small>Status Anda: <strong>{{ $aspirasi->status }}</strong></small>
            </div>
        @endif

        <div class="timeline-section">
            <h3>📅 Riwayat Status</h3>
            <div class="timeline">
                <div class="timeline-item {{ $aspirasi->status == 'Diajukan' ? 'active' : 'completed' }}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>Diajukan</h4>
                        <p>{{ \Carbon\Carbon::parse($aspirasi->tanggal_pengajuan)->format('d-m-Y') }}</p>
                    </div>
                </div>
                <div class="timeline-item {{ $aspirasi->status == 'Diproses' ? 'active' : ($aspirasi->status == 'Selesai' ? 'completed' : '') }}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>Diproses</h4>
                        <p>Menunggu penindaklanjutan...</p>
                    </div>
                </div>
                <div class="timeline-item {{ $aspirasi->status == 'Selesai' ? 'completed' : '' }}">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>Selesai</h4>
                        <p>Terselesaikan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
