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
    <div class="alert alert-success flash-alert" id="flash-alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="flash-close" onclick="closeFlash()">×</button>
    </div>
@endif


@if(session('error'))
    <div class="alert alert-error flash-alert" id="flash-alert">
        <span>{{ session('error') }}</span>
        <button type="button" class="flash-close" onclick="closeFlash()">×</button>
    </div>
@endif

        @yield('content')
    </div>

    @if(Auth::check())
        @include('partials.footer')
    @endif

    @yield('extra_js')
    <script>
function closeFlash() {
    const alert = document.getElementById('flash-alert');
    if (alert) {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => alert.remove(), 400);
    }
}

const autoFlash = document.getElementById('flash-alert');
if (autoFlash) {
    setTimeout(() => {
        closeFlash();
    }, 3000);
}
</script>
</body>
</html>
