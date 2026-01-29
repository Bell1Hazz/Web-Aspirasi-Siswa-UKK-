<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="{{ asset('views/css/style.css') }}">
    @if(Auth::user() && Auth::user()->isAdmin())
        <link rel="stylesheet" href="{{ asset('views/admin/admin.css') }}">
    @elseif(Auth::user() && Auth::user()->isSiswa())
        <link rel="stylesheet" href="{{ asset('views/siswa/siswa.css') }}">
    @endif
    @yield('extra_css')
</head>
<body>
    @if(Auth::check())
        @include('partials.navbar')
    @endif

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    @if(Auth::check())
        @include('partials.footer')
    @endif

    @yield('extra_js')
</body>
</html>
