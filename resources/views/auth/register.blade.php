@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('views/css/auth.css') }}">

<div class="auth-container auth-modern">
    <div class="auth-shell">

        {{-- Panel kiri (Hero) --}}
        <aside class="auth-hero">
            <div class="hero-content">
                <span class="hero-badge">
                    <!-- Icon: Info -->
                    <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M12 16v-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 8h.01" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
                    </svg>
                    Portal Pengaduan Sarana
                </span>

                <h2 class="hero-title">Buat akun untuk mulai mengirim pengaduan</h2>
                <p class="hero-desc">
                    Daftar sekali, lalu kamu bisa mengirim laporan dengan foto bukti dan memantau statusnya sampai selesai.
                </p>

                <ul class="hero-points">
                    <li><span class="dot"></span><span>Input cepat: nama, username, email</span></li>
                    <li><span class="dot"></span><span>Password aman & konfirmasi</span></li>
                    <li><span class="dot"></span><span>Setelah daftar, langsung bisa login</span></li>
                </ul>
            </div>
        </aside>

        {{-- Panel kanan (Form) --}}
        <div class="auth-box auth-card">
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
                <p>Buat akun baru untuk mengakses Website</p>
            </div>

            <div class="soft-divider"></div>

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
                         <small class="form-hint">Masukan Nama Lengkap Anda</small>
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
</div>

<style>
    /* ===== Icon (konsisten) ===== */
    .icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.12em;
        margin-right: .5rem;
        flex: 0 0 auto;
    }
    .title-with-icon,
    .btn-with-icon,
    .alert-title{ display:inline-flex; align-items:center; }

    /* ===== Background (samakan dengan login) ===== */
    body{
        background:
            radial-gradient(800px 400px at 15% 15%, rgba(255,255,255,0.12), transparent 60%),
            radial-gradient(600px 300px at 85% 25%, rgba(255,255,255,0.10), transparent 60%),
            linear-gradient(135deg, var(--primary-color), #0056b3);
        overflow-x: hidden;
    }

    /* ===== Shell 2 panel ===== */
    .auth-modern{ width: 100%; }
    .auth-shell{
        width: min(980px, 100%);
        display: grid;
        grid-template-columns: 1.05fr .95fr;
        gap: 18px;
        align-items: stretch;
        padding: 0 8px;
    }

    /* ===== Hero kiri (selaras login) ===== */
    .auth-hero{
        border-radius: 22px;
        padding: 28px 26px;
        background: rgba(255,255,255,.35);
        border: 1px solid rgba(255,255,255,.45);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 10px 28px rgba(0,0,0,.10);
        position: relative;
        overflow: hidden;
    }
    .auth-hero::before{
        content:"";
        position:absolute;
        inset:-2px;
        background:
            radial-gradient(600px 220px at 20% 10%, rgba(255,255,255,.65), transparent 60%),
            radial-gradient(520px 240px at 80% 30%, rgba(255,255,255,.45), transparent 60%);
        pointer-events:none;
        z-index: 0;
    }
    .hero-content{ position: relative; z-index: 1; }

    .hero-badge{
        display:inline-flex;
        align-items:center;
        gap: 10px;
        padding: 8px 12px;
        border-radius: 999px;
        border: 1px solid rgba(0,0,0,.08);
        background: rgba(255,255,255,.55);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        font-size: .92rem;
    }
    .hero-title{
        margin: 14px 0 8px;
        font-size: 1.55rem;
        line-height: 1.25;
        letter-spacing: .2px;
    }
    .hero-desc{
        margin: 0;
        opacity: .85;
        line-height: 1.6;
        font-size: .98rem;
    }
    .hero-points{
        margin: 18px 0 0;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 10px;
    }
    .hero-points li{
        display:flex;
        gap: 10px;
        align-items:flex-start;
        padding: 10px 12px;
        border-radius: 14px;
        background: rgba(255,255,255,.45);
        border: 1px solid rgba(0,0,0,.06);
    }
    .dot{
        width: 10px;
        height: 10px;
        border-radius: 99px;
        margin-top: 6px;
        background: rgba(0,0,0,.25);
        flex: 0 0 auto;
    }

    /* ===== Card kanan (form) ===== */
    .auth-card{
        max-width: none; /* biar ngikut grid */
        background: rgba(255,255,255,0.86);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.45);
        border-radius: 22px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.6);
    }
    .soft-divider{
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0,0,0,0.10), transparent);
        margin: 16px 0 18px;
    }

    /* ===== Form rapi (ngikut register kamu) ===== */
    .auth-form{ margin-top: 0; display: grid; gap: 14px; }
    .form-row{ display: grid; gap: 14px; }
    .form-row.two-col{ grid-template-columns: 1fr; }
    @media (min-width: 768px){
        .form-row.two-col{ grid-template-columns: 1fr 1fr; gap: 16px; }
    }

    .form-group{ display:grid; gap: 6px; }
    .form-group label{ font-weight: 600; font-size: .95rem; }

    .form-control{
        width: 100%;
        padding: 11px 12px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        outline: none;
        background: rgba(255,255,255,.95);
        line-height: 1.35;
        transition: border-color .15s ease, box-shadow .15s ease, transform .12s ease;
    }
    .form-control:focus{
        transform: translateY(-1px);
        border-color: rgba(13,110,253,.55);
        box-shadow: 0 0 0 4px rgba(13,110,253,.12);
    }

    .form-hint{ color:#6b7280; font-size:.86rem; line-height:1.35; margin:0; }
    .error-text{ color:#dc3545; font-size:.86rem; line-height:1.35; margin:0; }

    .btn.btn-block{
        margin-top: 6px;
        padding: 12px 14px;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: .2px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.18);
        transition: transform .15s ease, box-shadow .2s ease, filter .2s ease;
    }
    .btn.btn-block:hover{
        transform: translateY(-1px);
        box-shadow: 0 14px 32px rgba(0,0,0,0.22);
        filter: brightness(1.02);
    }
    .btn.btn-block:active{
        transform: translateY(0px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.18);
    }

    .auth-footer{
        text-align: center;
        margin-top: 6px;
        padding-top: 18px;
        border-top: 1px dashed rgba(0,0,0,0.12);
    }

    /* ===== Responsive: hero jadi atas ===== */
    @media (max-width: 900px){
        .auth-shell{ grid-template-columns: 1fr; }
        .auth-hero{ padding: 22px 18px; }
        .auth-card{ padding: 22px 18px; }
    }
</style>
@endsection
