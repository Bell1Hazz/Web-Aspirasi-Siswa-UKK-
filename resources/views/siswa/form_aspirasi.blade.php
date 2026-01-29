@extends('layouts.app')

@section('title', 'Form Aspirasi')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h2>📝 Form Pengaduan Sarana Sekolah</h2>
        <p>Silakan isi formulir di bawah untuk mengirimkan pengaduan Anda</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <h4>⚠️ Terjadi Kesalahan:</h4>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('aspirasi.store') }}" class="form-aspirasi">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Siswa</label>
            <input 
                type="text" 
                id="nama" 
                name="nama" 
                class="form-control"
                value="{{ Auth::user()->name }}"
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
            <button type="submit" class="btn btn-primary">
                ✅ Kirim Aspirasi
            </button>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                ❌ Batal
            </a>
        </div>
    </form>
</div>
@endsection
