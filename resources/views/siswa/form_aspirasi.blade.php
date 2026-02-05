@extends('layouts.app')

@section('title', 'Form Aspirasi')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2 class="heading-with-icon">
            <!-- Icon: Clipboard / Form -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M8 11h8M8 15h8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
            </svg>
            Form Pengaduan Sarana Sekolah
        </h2>
        <p>Silakan isi formulir di bawah untuk mengirimkan pengaduan Anda</p>
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

    <form method="POST" action="{{ route('aspirasi.store') }}" class="form-aspirasi" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Siswa</label>
            <input
                type="text"
                id="nama"
                name="nama"
                class="form-control"
                value="{{ Auth::user()->nama }}"
                disabled
            >
            <small class="form-text">Nama Anda yang terdaftar di sistem</small>
        </div>

        <div class="form-group">
            <label for="kategori_id">Kategori Sarana <span class="required">*</span></label>
            <select
                id="kategori_id"
                name="kategori_id"
                class="form-control @error('kategori_id') is-invalid @enderror"
                required
            >
                <option value="">-- Pilih Kategori --</option>
                @forelse($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @empty
                    <option disabled>Tidak ada kategori tersedia</option>
                @endforelse
            </select>
            @error('kategori_id')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="judul">Judul Aspirasi <span class="required">*</span></label>
            <input
                type="text"
                id="judul"
                name="judul"
                class="form-control @error('judul') is-invalid @enderror"
                placeholder="Contoh: Pintu Toilet Rusak di Gedung A"
                value="{{ old('judul') }}"
                required
            >
            @error('judul')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
    <label for="gambar">Foto Bukti (Opsional)</label>
    <input
        type="file"
        id="gambar"
        name="gambar"
        class="form-control @error('gambar') is-invalid @enderror"
        accept="image/*"
    >
    <small class="form-text">Format: JPG/PNG/WebP, maks 2MB</small>
    @error('gambar')
        <span class="error-text">{{ $message }}</span>
    @enderror
</div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Lengkap <span class="required">*</span></label>
            <textarea
                id="deskripsi"
                name="deskripsi"
                class="form-control @error('deskripsi') is-invalid @enderror"
                rows="6"
                placeholder="Jelaskan secara detail tentang masalah sarana yang Anda laporkan..."
                required
            >{{ old('deskripsi') }}</textarea>
            <small class="form-text">Berikan deskripsi yang jelas dan detail agar mudah ditindaklanjuti</small>
            @error('deskripsi')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-with-icon">
                <!-- Icon: Check Circle -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9 12.5l2 2 4-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kirim Aspirasi
            </button>

            <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-with-icon">
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
    .heading-with-icon,
    .btn-with-icon{
        display: inline-flex;
        align-items: center;
    }
</style>
@endsection
