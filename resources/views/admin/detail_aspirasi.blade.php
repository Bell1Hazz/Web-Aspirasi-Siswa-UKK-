@extends('layouts.app')

@section('title', 'Detail Aspirasi - Admin')

@section('content')
<div class="admin-detail-container">
    <div class="detail-header">
        <div>
            <h2 class="heading-with-icon">
                <!-- Icon: Clipboard -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M8 11h8M8 15h8M8 19h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
                {{ $aspirasi->judul }}
            </h2>
            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $aspirasi->status)) }}">
                {{ $aspirasi->status }}
            </span>
        </div>

        <a href="{{ route('admin.list') }}" class="btn btn-secondary btn-with-icon">
            <!-- Icon: Arrow Left -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="detail-grid">
        <div class="detail-left">
            <div class="info-section">
                <h3 class="heading-with-icon">
                    <!-- Icon: Info -->
                    <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 17v-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 7h.01" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
                        <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Informasi Pengaduan
                </h3>

                <div class="info-item">
                    <span class="label">Nama Siswa:</span>
                    <span class="value">{{ $aspirasi->user->nama }}</span>
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
                <h3 class="heading-with-icon">
                    <!-- Icon: File Text -->
                    <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-5Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 2v5h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 13h8M8 17h8M8 9h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                    Deskripsi Lengkap
                </h3>
                <div class="deskripsi-box">
                    {{ $aspirasi->deskripsi }}
                </div>
            </div>
        </div>

        <div class="detail-right">
            @if($aspirasi->feedback)
                <div class="feedback-section">
                    <h3 class="heading-with-icon">
                        <!-- Icon: Message -->
                        <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"
                                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Feedback yang Diberikan
                    </h3>

                    <div class="feedback-box">
                        <div class="feedback-meta">
                            <span class="date">
                                <!-- Icon: Calendar -->
                                <svg class="ui-icon ui-icon-sm" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M8 3v2M16 3v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M4 7h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M6 5h12a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"
                                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Tanggal: {{ \Carbon\Carbon::parse($aspirasi->feedback->tanggal_feedback)->format('d-m-Y') }}
                            </span>
                        </div>
                        <p class="feedback-text">{{ $aspirasi->feedback->isi_feedback }}</p>
                    </div>

                    <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-warning btn-block btn-with-icon">
                        <!-- Icon: Pencil -->
                        <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 20h9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5Z"
                                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Ubah Feedback
                    </a>
                </div>
            @else
                <div class="no-feedback-box">
                    <p class="text-with-icon">
                        <!-- Icon: Clock -->
                        <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Belum ada feedback untuk aspirasi ini
                    </p>

                    <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-primary btn-block btn-with-icon">
                        <!-- Icon: Plus Circle -->
                        <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 8v8M8 12h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Tambah Feedback
                    </a>
                </div>
            @endif

            <div class="action-section">
                <h3 class="heading-with-icon">
                    <!-- Icon: Wrench -->
                    <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M14.7 6.3a5 5 0 0 0-6.9 6.9l-4.4 4.4a2 2 0 0 0 2.8 2.8l4.4-4.4a5 5 0 0 0 6.9-6.9l-2.3 2.3-2.8-2.8 2.3-2.3Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Aksi Cepat
                </h3>

                <div class="quick-actions">
                    @if($aspirasi->status != 'Selesai')
                        <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-primary btn-block btn-with-icon">
                            <!-- Icon: Message -->
                            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"
                                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Beri Feedback & Update Status
                        </a>
                    @else
                        <button class="btn btn-success btn-block btn-with-icon" disabled>
                            <!-- Icon: Check Circle -->
                            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M9 12.5l2 2 4-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Sudah Selesai
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* util: ikon konsisten */
    .ui-icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.15em;
        margin-right: .5rem;
        flex: 0 0 auto;
    }
    .ui-icon-sm{
        width: .95em;
        height: .95em;
        margin-right: .35rem;
        vertical-align: -0.12em;
    }

    .heading-with-icon,
    .btn-with-icon,
    .text-with-icon{
        display: inline-flex;
        align-items: center;
    }
</style>
@endsection
