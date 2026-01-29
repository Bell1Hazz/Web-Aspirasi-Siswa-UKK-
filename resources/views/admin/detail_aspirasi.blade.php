@extends('layouts.app')

@section('title', 'Detail Aspirasi - Admin')

@section('content')
<div class="admin-detail-container">
    <div class="detail-header">
        <div>
            <h2>📋 {{ $aspirasi->judul }}</h2>
            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $aspirasi->status)) }}">
                {{ $aspirasi->status }}
            </span>
        </div>
        <a href="{{ route('admin.list') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="detail-grid">
        <div class="detail-left">
            <div class="info-section">
                <h3>ℹ️ Informasi Pengaduan</h3>
                <div class="info-item">
                    <span class="label">Nama Siswa:</span>
                    <span class="value">{{ $aspirasi->user->name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Username:</span>
                    <span class="value">{{ $aspirasi->user->username }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Kategori:</span>
                    <span class="value">{{ $aspirasi->kategori->nama_kategori }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Tanggal Pengajuan:</span>
                    <span class="value">{{ \Carbon\Carbon::parse($aspirasi->tanggal_pengajuan)->format('d-m-Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Status Saat Ini:</span>
                    <span class="value status-text">{{ $aspirasi->status }}</span>
                </div>
            </div>

            <div class="deskripsi-section">
                <h3>📝 Deskripsi Lengkap</h3>
                <div class="deskripsi-box">
                    {{ $aspirasi->deskripsi }}
                </div>
            </div>
        </div>

        <div class="detail-right">
            @if($aspirasi->feedback)
                <div class="feedback-section">
                    <h3>💬 Feedback yang Diberikan</h3>
                    <div class="feedback-box">
                        <div class="feedback-meta">
                            <span class="date">Tanggal: {{ \Carbon\Carbon::parse($aspirasi->feedback->tanggal_feedback)->format('d-m-Y') }}</span>
                        </div>
                        <p class="feedback-text">{{ $aspirasi->feedback->isi_feedback }}</p>
                    </div>
                    <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-warning btn-block">
                        ✏️ Ubah Feedback
                    </a>
                </div>
            @else
                <div class="no-feedback-box">
                    <p>⏳ Belum ada feedback untuk aspirasi ini</p>
                    <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-primary btn-block">
                        ➕ Tambah Feedback
                    </a>
                </div>
            @endif

            <div class="action-section">
                <h3>🔧 Aksi Cepat</h3>
                <div class="quick-actions">
                    @if($aspirasi->status != 'Selesai')
                        <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-primary btn-block">
                            💬 Beri Feedback & Update Status
                        </a>
                    @else
                        <button class="btn btn-success btn-block" disabled>
                            ✅ Sudah Selesai
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
