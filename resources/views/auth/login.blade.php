<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="{{ asset('views/css/auth.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>📋 Pengaduan Sarana Sekolah</h1>
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

                <button type="submit" class="btn btn-primary btn-block">
                    🔐 Login
                </button>
            </form>

            <div class="login-footer">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>
