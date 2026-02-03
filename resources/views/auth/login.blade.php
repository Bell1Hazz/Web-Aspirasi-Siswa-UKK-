<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="{{ asset('views/css/auth.css') }}">

    <style>
        /* kecil & aman: biar icon rapi tanpa ngubah CSS kamu yang lain */
        .icon {
            width: 1.1em;
            height: 1.1em;
            vertical-align: -0.15em;
            margin-right: .4rem;
            flex: 0 0 auto;
        }
        .btn .icon {
            margin-right: .5rem;
        }
        .title-with-icon,
        .btn-with-icon {
            display: inline-flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1 class="title-with-icon">
                    <!-- Clipboard / Document Icon (SVG) -->
                    <svg class="icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M8 11h8M8 15h8M8 19h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                    Pengaduan Sarana Sekolah
                </h1>
                <p>Sistem Pengaduan Sarana dan Prasarana Sekolah</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
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
                    >
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-with-icon">
                    <!-- Lock/Login Icon (SVG) -->
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
</body>
</html>
