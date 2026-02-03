@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('views/css/auth.css') }}">

<div class="auth-container">
    <div class="auth-box">
        <div class="auth-header">
            <h1 class="title-with-icon">
                <!-- Icon: Pencil / Edit -->
                <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 20h9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Registrasi Akun
            </h1>
            <p>Buat akun baru untuk mengakses aplikasi</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <div class="alert-title">
                    <!-- Icon: Warning -->
                    <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 9v4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 17h.01" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                        <path d="M10.3 4.3a2 2 0 0 1 3.4 0l7.5 13a2 2 0 0 1-1.7 3H4.5a2 2 0 0 1-1.7-3l7.5-13Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Ada input yang perlu diperbaiki
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" class="auth-form">
            @csrf

            <!-- Row 2 kolom (desktop): Nama + Username -->
            <div class="form-row two-col">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap Anda"
                        autocomplete="name"
                        required
                    >
                    @error('nama')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username') }}"
                        placeholder="Username unik Anda"
                        autocomplete="username"
                        required
                    >
                    @error('username')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Minimal 3 karakter, harus unik</small>
                </div>
            </div>

            <!-- Full width -->
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email / Gmail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        autocomplete="email"
                        required
                    >
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Gunakan email aktif untuk verifikasi</small>
                </div>
            </div>

            <!-- Full width -->
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Minimal 6 karakter"
                        autocomplete="new-password"
                        required
                    >
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Gunakan kombinasi huruf & angka jika memungkinkan</small>
                </div>
            </div>

            <!-- Full width -->
            <div class="form-row">
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password Anda"
                        autocomplete="new-password"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-with-icon">
                <!-- Icon: User Plus -->
                <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20 8v6M17 11h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Daftar
            </button>

            <div class="auth-footer">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </form>
    </div>
</div>

<style>
    /* ====== General spacing (biar rapih walau auth.css beda) ====== */
    .auth-box{
        max-width: 560px;
        margin: 0 auto;
    }

    .auth-header h1{
        margin: 0 0 6px 0;
        line-height: 1.2;
    }
    .auth-header p{
        margin: 0;
        line-height: 1.5;
        opacity: .85;
    }

    /* ====== Icon ====== */
    .icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.12em;
        margin-right: .5rem;
        flex: 0 0 auto;
    }
    .title-with-icon,
    .btn-with-icon,
    .alert-title{
        display: inline-flex;
        align-items: center;
    }

    /* ====== Form ====== */
    .auth-form{
        margin-top: 18px;
        display: grid;
        gap: 14px; /* jarak antar row */
    }

    .form-row{
        display: grid;
        gap: 14px;
    }
    .form-row.two-col{
        grid-template-columns: 1fr;
    }
    @media (min-width: 768px){
        .form-row.two-col{
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
    }

    .form-group{
        display: grid;
        gap: 6px; /* label-input-hint/error rapih */
    }

    .form-group label{
        font-weight: 600;
        font-size: .95rem;
    }

    .form-control{
        width: 100%;
        padding: 11px 12px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        outline: none;
        background: #fff;
        line-height: 1.35;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .form-control:focus{
        border-color: rgba(13,110,253,.55);
        box-shadow: 0 0 0 4px rgba(13,110,253,.12);
    }

    .is-invalid{
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 4px rgba(220,53,69,.12) !important;
    }

    .form-hint{
        color: #6b7280;
        font-size: .86rem;
        line-height: 1.35;
        margin: 0;
    }
    .error-text{
        color: #dc3545;
        font-size: .86rem;
        line-height: 1.35;
        margin: 0;
    }

    /* ====== Alert ====== */
    .alert{
        padding: 14px 14px;
        border-radius: 12px;
        border: 1px solid transparent;
    }
    .alert-error{
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }
    .alert-title{
        font-weight: 700;
        margin-bottom: 8px;
    }
    .alert ul{
        margin: 0;
        padding-left: 18px;
    }
    .alert li{
        margin: 4px 0;
    }

    /* ====== Button ====== */
    .btn.btn-block{
        margin-top: 6px;
        padding: 12px 14px;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: .2px;
    }
</style>
@endsection
