@extends('layouts.app')

@section('title', 'Form Feedback - Admin')

@section('content')
<div class="feedback-form-container">
    <div class="form-header">
        <h2>💬 Form Feedback Aspirasi</h2>
        <p>Berikan umpan balik untuk aspirasi: <strong>{{ $aspirasi->judul }}</strong></p>
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

    <div class="form-info-box">
        <h3>📋 Ringkasan Aspirasi</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Siswa:</span>
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
                <span class="label">Status Saat Ini:</span>
                <span class="value">{{ $aspirasi->status }}</span>
            </div>
        </div>
    </div>

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
                    ⏳ Diajukan
                </option>
                <option value="Diproses" {{ old('status', $aspirasi->status) == 'Diproses' ? 'selected' : '' }}>
                    ⚙️ Diproses
                </option>
                <option value="Selesai" {{ old('status', $aspirasi->status) == 'Selesai' ? 'selected' : '' }}>
                    ✅ Selesai
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
            <button type="submit" class="btn btn-primary btn-lg">
                💾 Simpan Feedback
            </button>
            <a href="{{ route('admin.detail', $aspirasi->id) }}" class="btn btn-secondary btn-lg">
                ❌ Batal
            </a>
        </div>
    </form>

    <div class="help-section">
        <h3>💡 Tips Memberikan Feedback yang Baik</h3>
        <ul>
            <li>Jelaskan apa yang Anda lakukan dalam merespons aspirasi</li>
            <li>Berikan estimasi waktu penyelesaian jika memungkinkan</li>
            <li>Gunakan bahasa yang profesional dan sopan</li>
            <li>Jika sudah selesai, berikan detail tentang hasil penyelesaian</li>
        </ul>
    </div>
</div>
@endsection
