@extends('layouts.app')

@section('title', 'Detail Aspirasi')

@section('content')
<div class="detail-container">
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

        <a href="{{ route('aspirasi.histori') }}" class="btn btn-secondary btn-with-icon">
            <!-- Icon: Arrow Left -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="detail-content">
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
            {{-- FOTO BUKTI --}}
<div class="foto-section">
    <h3 class="heading-with-icon">
        <!-- Icon: Image -->
        <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6Z"
                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"
                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 16l-6-6-7 7"
                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Foto Bukti
    </h3>

    <div class="foto-box">
        <a href="{{ asset('storage/'.$aspirasi->gambar) }}" target="_blank" rel="noopener">
            <img
                src="{{ asset('storage/'.$aspirasi->gambar) }}"
                alt="Foto bukti aspirasi"
                class="foto-img"
            >
        </a>
        <small class="form-text">Klik gambar untuk melihat ukuran penuh</small>
    </div>
</div>

        </div>

        @if($aspirasi->feedback)
            <div class="feedback-section">
                <h3 class="heading-with-icon">
                    <!-- Icon: Message -->
                    <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Feedback dari Admin
                </h3>

                <div class="feedback-box">
                    <div class="feedback-meta">
                        <span class="date text-with-icon">
                            <!-- Icon: Calendar -->
                            <svg class="ui-icon ui-icon-sm" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M8 3v2M16 3v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M4 7h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M6 5h12a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"
                                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Tanggal Feedback: {{ \Carbon\Carbon::parse($aspirasi->feedback->tanggal_feedback)->format('d-m-Y') }}
                        </span>
                    </div>
                    <p class="feedback-text">{{ $aspirasi->feedback->isi_feedback }}</p>
                </div>
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
                    Aspirasi Anda belum mendapat feedback dari admin
                </p>
                <small>Status Anda: <strong>{{ $aspirasi->status }}</strong></small>
            </div>
        @endif

        <div class="timeline-section">
            <h3 class="heading-with-icon">
                <!-- Icon: Calendar -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M8 3v2M16 3v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M4 7h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M6 5h12a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Riwayat Status
            </h3>

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

<style>
    /* util icon */
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
    /* FOTO: biar gambar gak keluar box */
.foto-box{
    width: 100%;
    max-width: 100%;
    overflow: hidden;          /* kunci biar ga melewati box */
    border-radius: 14px;       /* biar sudut ikut rapi */
}

.foto-box a{
    display: block;            /* link jadi block, ikut lebar box */
    width: 100%;
}

.foto-img{
    display: block;
    width: 100%;               /* WAJIB: ikut lebar container */
    max-width: 100%;
    height: auto;              /* jaga rasio */
    object-fit: contain;       /* aman untuk berbagai ukuran */
}

</style>
@endsection
