@extends('layouts.app')

@section('title', 'Form Feedback - Admin')

@section('content')
<div class="feedback-form-container">
    <div class="form-header">
        <h2 class="heading-with-icon">
            <!-- Icon: Message -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Form Feedback Aspirasi
        </h2>
        <p>Berikan umpan balik untuk aspirasi: <strong>{{ $aspirasi->judul }}</strong></p>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <h4 class="heading-with-icon">
                <!-- Icon: Alert Triangle -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 9v4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M12 17h.01" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
                    <path d="M10.3 4.3a2 2 0 0 1 3.4 0l7.5 13a2 2 0 0 1-1.7 3H4.5a2 2 0 0 1-1.7-3l7.5-13Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Terjadi Kesalahan
            </h4>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-info-box">
        <h3 class="heading-with-icon">
            <!-- Icon: Clipboard -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M8 11h8M8 15h8M8 19h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
            </svg>
            Ringkasan Aspirasi
        </h3>

        <div class="info-grid">
            <div class="info-item">
                <span class="label">Siswa:</span>
                <span class="value">{{ $aspirasi->user->nama }}</span>
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
                <span class="label">Status Saat Ini:</span>
                <span class="value">{{ $aspirasi->status }}</span>
            </div>
        </div>
    </div>
{{-- FOTO BUKTI ASPIRASI --}}
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
        Foto Bukti Aspirasi
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

{{-- FLASH MESSAGE --}}
@if(session('success'))
    <div class="flash-message flash-success" id="flash-message">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="flash-message flash-error" id="flash-message">
        {{ session('error') }}
    </div>
@endif
    <form method="POST" action="{{ route('admin.feedback.save', $aspirasi->id) }}" class="feedback-form">
        @csrf

        <div class="form-group">
            <label for="status">Status Aspirasi <span class="required">*</span></label>
            <select
                id="status"
                name="status"
                class="form-control @error('status') is-invalid @enderror"
                required
            >
                <option value="">-- Pilih Status --</option>
                <option value="Diajukan" {{ old('status', $aspirasi->status) == 'Diajukan' ? 'selected' : '' }}>
                    Diajukan
                </option>
                <option value="Diproses" {{ old('status', $aspirasi->status) == 'Diproses' ? 'selected' : '' }}>
                    Diproses
                </option>
                <option value="Selesai" {{ old('status', $aspirasi->status) == 'Selesai' ? 'selected' : '' }}>
                    Selesai
                </option>
            </select>
            <small class="form-text">Pilih status terbaru untuk aspirasi ini</small>
            @error('status')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="isi_feedback">Isi Feedback <span class="required">*</span></label>
            <textarea
                id="isi_feedback"
                name="isi_feedback"
                class="form-control @error('isi_feedback') is-invalid @enderror"
                rows="8"
                placeholder="Berikan umpan balik yang jelas dan konstruktif untuk siswa. Jelaskan tindakan yang telah/akan diambil dan estimasi penyelesaian jika diperlukan."
                required
            >{{ old('isi_feedback', $aspirasi->feedback?->isi_feedback ?? '') }}</textarea>
            <small class="form-text">Berikan penjelasan yang detail dan membantu untuk siswa</small>
            @error('isi_feedback')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-lg btn-with-icon">
                <!-- Icon: Save -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 21v-8H7v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 3v5h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Simpan Feedback
            </button>

            <a href="{{ route('admin.detail', $aspirasi->id) }}" class="btn btn-secondary btn-lg btn-with-icon">
                <!-- Icon: X Circle -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M15 9l-6 6M9 9l6 6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Batal
            </a>
        </div>
    </form>

    <div class="help-section">
        <h3 class="heading-with-icon">
            <!-- Icon: Lightbulb -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M9 18h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M10 22h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M8 14a7 7 0 1 1 8 0c-.7.6-1 1.3-1 2H9c0-.7-.3-1.4-1-2Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Tips Memberikan Feedback yang Baik
        </h3>
        <ul>
            <li>Jelaskan apa yang Anda lakukan dalam merespons aspirasi</li>
            <li>Berikan estimasi waktu penyelesaian jika memungkinkan</li>
            <li>Gunakan bahasa yang profesional dan sopan</li>
            <li>Jika sudah selesai, berikan detail tentang hasil penyelesaian</li>
        </ul>
    </div>
    <script>
    const flash = document.getElementById('flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transform = 'translateY(-10px)';
            setTimeout(() => flash.remove(), 400);
        }, 3000);
    }
</script>
</div>

<style>
    .foto-section{
    margin: 1.25rem 0;
}
.foto-box{
    margin-top: .6rem;
}
.foto-img{
    width: 100%;
    max-width: 520px;
    height: auto;
    display: block;
    border-radius: 14px;
    border: 1px solid rgba(0,0,0,.08);
}

    /* util icon */
    .ui-icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.15em;
        margin-right: .5rem;
        flex: 0 0 auto;
    }
    .heading-with-icon,
    .btn-with-icon{
        display: inline-flex;
        align-items: center;
    }
    .btn-with-icon{
        gap: 0;
    }
</style>
@endsection
