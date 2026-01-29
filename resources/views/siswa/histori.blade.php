@extends('layouts.app')

@section('title', 'Histori Aspirasi')

@section('content')
<div class="histori-container">
    <div class="histori-header">
        <h2>📜 Histori Aspirasi Anda</h2>
        <p>Pantau status pengaduan yang telah Anda kirimkan</p>
    </div>

    @if($aspirasis->isEmpty())
        <div class="empty-state">
            <p>📭 Anda belum membuat aspirasi apapun.</p>
            <a href="{{ route('aspirasi.create') }}" class="btn btn-primary">
                ➕ Buat Aspirasi Sekarang
            </a>
        </div>
    @else
        <div class="aspirasi-list">
            @foreach($aspirasis as $aspirasi)
                <div class="aspirasi-card">
                    <div class="aspirasi-header">
                        <h3>{{ $aspirasi->judul }}</h3>
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $aspirasi->status)) }}">
                            {{ $aspirasi->status }}
                        </span>
                    </div>

                    <div class="aspirasi-meta">
                        <div class="meta-item">
                            <span class="label">Kategori:</span>
                            <span class="value">{{ $aspirasi->kategori->nama_kategori }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="label">Tanggal:</span>
                            <span class="value">{{ \Carbon\Carbon::parse($aspirasi->tanggal_pengajuan)->format('d-m-Y') }}</span>
                        </div>
                    </div>

                    <div class="aspirasi-deskripsi">
                        <p>{{ substr($aspirasi->deskripsi, 0, 150) }}{{ strlen($aspirasi->deskripsi) > 150 ? '...' : '' }}</p>
                    </div>

                    @if($aspirasi->feedback)
                        <div class="feedback-section">
                            <h4>💬 Feedback Admin:</h4>
                            <p>{{ $aspirasi->feedback->isi_feedback }}</p>
                            <small>Tanggal: {{ \Carbon\Carbon::parse($aspirasi->feedback->tanggal_feedback)->format('d-m-Y') }}</small>
                        </div>
                    @else
                        <div class="no-feedback">
                            <p>⏳ Menunggu feedback dari admin...</p>
                        </div>
                    @endif

                    <div class="aspirasi-actions">
                        <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="btn btn-small btn-primary">
                            👁️ Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
