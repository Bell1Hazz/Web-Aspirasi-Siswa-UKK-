@extends('layouts.app')

@section('title', 'Histori Aspirasi')

@section('content')
<div class="histori-container">
    <div class="histori-header">
        <h2 class="heading-with-icon">
            <!-- Icon: History / Clock -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Histori Aspirasi Anda
        </h2>
        <p>Pantau status pengaduan yang telah Anda kirimkan</p>
    </div>

    @if($aspirasis->isEmpty())
        <div class="empty-state">
            <p class="text-with-icon">
                <!-- Icon: Inbox / Empty -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 4h16v10l-2 6H6l-2-6V4Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 14h5l2 2h2l2-2h5"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Anda belum membuat aspirasi apa pun.
            </p>

            <a href="{{ route('aspirasi.create') }}" class="btn btn-primary btn-with-icon">
                <!-- Icon: Plus Circle -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 8v8M8 12h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Buat Aspirasi Sekarang
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
                            <h4 class="heading-with-icon">
                                <!-- Icon: Message -->
                                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"
                                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Feedback Admin
                            </h4>
                            <p>{{ $aspirasi->feedback->isi_feedback }}</p>

                            <small class="text-with-icon">
                                <!-- Icon: Calendar -->
                                <svg class="ui-icon ui-icon-sm" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M8 3v2M16 3v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M4 7h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M6 5h12a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"
                                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Tanggal: {{ \Carbon\Carbon::parse($aspirasi->feedback->tanggal_feedback)->format('d-m-Y') }}
                            </small>
                        </div>
                    @else
                        <div class="no-feedback">
                            <p class="text-with-icon">
                                <!-- Icon: Clock -->
                                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Menunggu feedback dari admin...
                            </p>
                        </div>
                    @endif

                    <div class="aspirasi-actions">
                        <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="btn btn-small btn-primary btn-with-icon">
                            <!-- Icon: Eye -->
                            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"
                                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .ui-icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.15em;
        margin-right: .45rem;
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

    /* tombol kecil: ikon sedikit lebih kecil biar proporsional */
    .btn.btn-small .ui-icon{
        width: 1em;
        height: 1em;
        margin-right: .35rem;
        vertical-align: -0.12em;
    }
</style>
@endsection
