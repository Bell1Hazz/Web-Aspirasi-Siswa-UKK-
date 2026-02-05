@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Tambah Kategori</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           value="{{ old('nama_kategori') }}"
                           class="form-control @error('nama_kategori') is-invalid @enderror"
                           placeholder="Contoh: Ruang Kelas">
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
