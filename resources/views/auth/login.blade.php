<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="{{ asset('views/css/auth.css') }}">

    <style>
        /* kecil & aman: icon rapi */
        .icon {
            width: 1.1em;
            height: 1.1em;
            vertical-align: -0.15em;
            margin-right: .4rem;
            flex: 0 0 auto;
        }
        .btn .icon { margin-right: .5rem; }
        .title-with-icon,
        .btn-with-icon{ display:inline-flex; align-items:center; }

        /* ===== Modern polish layer (tanpa ganti warna utama) ===== */
        :root{
            --glass-bg: rgba(255,255,255,.72);
            --glass-border: rgba(255,255,255,.55);
            --shadow-1: 0 18px 55px rgba(0,0,0,.12);
            --shadow-2: 0 10px 28px rgba(0,0,0,.10);
            --ring: rgba(0,0,0,.08);
        }

        body{
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* background accent (nggak ubah warna dasar, cuma efek) */
        body::before,
        body::after{
            content:"";
            position: fixed;
            inset: auto;
            width: 520px;
            height: 520px;
            border-radius: 50%;
            filter: blur(70px);
            opacity: .28;
            z-index: -2;
            pointer-events: none;
        }
        body::before{
            top: -140px;
            left: -160px;
            background: radial-gradient(circle at 30% 30%, rgba(0,0,0,.18), transparent 60%);
        }
        body::after{
            bottom: -160px;
            right: -180px;
            background: radial-gradient(circle at 60% 40%, rgba(0,0,0,.16), transparent 60%);
        }

        /* wrapper agar center + padding */
        .login-container{
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 28px 16px;
            position: relative;
        }

        /* glass frame tambahan (blur) */
        .login-shell{
            width: min(980px, 100%);
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 18px;
            align-items: stretch;
        }

        /* panel kiri: branding (opsional, modern) */
        .login-hero{
            border-radius: 22px;
            padding: 28px 26px;
            background: rgba(255,255,255,.35);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: var(--shadow-2);
            position: relative;
            overflow: hidden;
        }
        .login-hero::before{
            content:"";
            position:absolute;
            inset:-2px;
            background:
                radial-gradient(600px 220px at 20% 10%, rgba(255,255,255,.65), transparent 60%),
                radial-gradient(520px 240px at 80% 30%, rgba(255,255,255,.45), transparent 60%);
            z-index: 0;
            pointer-events:none;
        }
        .hero-content{
            position: relative;
            z-index: 1;
        }
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

        /* card login (kanan) */
        .login-box{
            border-radius: 22px;
            padding: 26px 24px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: var(--shadow-1);
        }

        .login-header h1{
            margin: 0 0 6px;
            font-size: 1.25rem;
            line-height: 1.25;
            letter-spacing: .2px;
        }
        .login-header p{
            margin: 0;
            opacity: .8;
        }

        /* divider halus */
        .soft-divider{
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,0,0,.10), transparent);
            margin: 16px 0 18px;
        }

        /* form polish */
        .login-form .form-group{
            margin-bottom: 14px; /* rapihin spacing */
        }
        .login-form label{
            font-weight: 600;
            font-size: .92rem;
            margin-bottom: 6px;
            display: inline-block;
        }

        .form-control{
            width: 100%;
            border-radius: 14px;
            padding: 12px 14px;
            border: 1px solid rgba(0,0,0,.10);
            background: rgba(255,255,255,.65);
            outline: none;
            transition: box-shadow .2s ease, border-color .2s ease, transform .15s ease;
        }
        .form-control:focus{
            border-color: rgba(0,0,0,.22);
            box-shadow: 0 0 0 4px rgba(0,0,0,.06);
        }

        /* button polish tanpa ganti warna utama (tetap pakai btn-primary dari auth.css) */
        .btn.btn-primary{
            border-radius: 14px;
            padding: 12px 14px;
            box-shadow: 0 10px 22px rgba(0,0,0,.12);
            transition: transform .15s ease, box-shadow .2s ease, filter .2s ease;
        }
        .btn.btn-primary:hover{
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(0,0,0,.14);
            filter: brightness(1.02);
        }
        .btn.btn-primary:active{
            transform: translateY(0px);
            box-shadow: 0 10px 22px rgba(0,0,0,.12);
        }

        .alert.alert-error{
            border-radius: 14px;
            padding: 12px 14px;
            border: 1px solid rgba(0,0,0,.10);
            background: rgba(255,255,255,.55);
            margin: 14px 0;
        }

        .login-footer{
            margin-top: 14px;
            text-align: center;
        }
        .login-footer a{
            text-decoration: none;
            font-weight: 700;
        }
        .login-footer a:hover{ text-decoration: underline; }

        /* responsif: di mobile, hero pindah ke atas */
        @media (max-width: 900px){
            .login-shell{
                grid-template-columns: 1fr;
            }
            .login-hero{
                padding: 22px 18px;
            }
            .login-box{
                padding: 22px 18px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-shell">

            <!-- Panel kiri (branding) -->
            <aside class="login-hero">
                <div class="hero-content">
                    <span class="hero-badge">
                        <!-- small icon -->
                        <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M12 16v-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M12 8h.01" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
                        </svg>
                        Portal Pengaduan Sarana
                    </span>

                    <h2 class="hero-title">Masuk untuk mengirim laporan dan memantau tindak lanjut</h2>
                    <p class="hero-desc">
                        Laporkan masalah sarana/prasarana sekolah dengan foto bukti, lalu pantau statusnya sampai selesai.
                    </p>

                    <ul class="hero-points">
                        <li><span class="dot"></span><span>Form cepat dan jelas (judul, deskripsi, foto bukti)</span></li>
                        <li><span class="dot"></span><span>Status transparan: Diajukan → Diproses → Selesai</span></li>
                        <li><span class="dot"></span><span>Feedback admin tercatat rapi di halaman detail</span></li>
                    </ul>
                </div>
            </aside>

            <!-- Panel kanan (form login) -->
            <div class="login-box">
                <div class="login-header">
                    <h1 class="title-with-icon">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M8 11h8M8 15h8M8 19h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        </svg>
                        Pengaduan Sarana Sekolah
                    </h1>
                    <p>Sistem Pengaduan Sarana dan Prasarana Sekolah</p>
                </div>

                <div class="soft-divider"></div>

                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach($errors->all() as $error)
                            <p style="margin:0 0 6px;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            placeholder="Masukkan username Anda"
                            value="{{ old('username') }}"
                            required
                            autocomplete="username"
                        >
                        @error('username')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                        >
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-with-icon">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 10h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 14v4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                        Login
                    </button>
                </form>

                <div class="login-footer">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
