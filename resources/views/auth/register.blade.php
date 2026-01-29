@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('views/css/auth.css') }}">

<div class="auth-container">
    <div class="auth-box">
        <div class="auth-header">
            <h1>📝 Registrasi Akun</h1>
            <p>Buat akun baru untuk mengakses aplikasi</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" class="auth-form">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}"
                    required
                    placeholder="Masukkan nama lengkap Anda"
                >
                @error('nama')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}"
                    required
                    placeholder="Username unik Anda"
                >
                @error('username')
                    <span class="error-text">{{ $message }}</span>
                @enderror
                <small class="form-hint">Username harus unik, min 3 karakter</small>
            </div>

            <!-- Email / Gmail -->
            <div class="form-group">
                <label for="email">Email / Gmail</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required
                    placeholder="Masukkan email Anda"
                >
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
                <small class="form-hint">Gunakan email yang masih aktif</small>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror"
                    required
                    placeholder="Minimal 6 karakter"
                >
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
                <small class="form-hint">Password harus minimal 6 karakter</small>
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="form-control"
                    required
                    placeholder="Ulangi password Anda"
                >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">
                Daftar
            </button>

            <div class="auth-footer">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </form>
    </div>
</div>

<style>
    .form-hint {
        display: block;
        color: #666;
        font-size: 0.85rem;
        margin-top: 5px;
    }

    .error-text {
        color: #dc3545;
        font-size: 0.875rem;
        display: block;
        margin-top: 5px;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert li {
        margin: 5px 0;
    }
</style>
@endsection
