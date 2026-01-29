<nav class="navbar">
    <div class="navbar-content">
        <div class="navbar-left">
            <span class="navbar-user">
                👤 {{ Auth::user()->name }} 
                <small>({{ Auth::user()->role === 'admin' ? 'Administrator' : 'Siswa' }})</small>
            </span>
        </div>
        <div class="navbar-right">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a>
                <a href="{{ route('admin.list') }}" class="nav-link {{ Route::is('admin.list') ? 'active' : '' }}">📝 Daftar Aspirasi</a>
            @else
                <a href="{{ route('siswa.index') }}" class="nav-link {{ Route::is('siswa.index') ? 'active' : '' }}">🏠 Beranda</a>
                <a href="{{ route('aspirasi.create') }}" class="nav-link {{ Route::is('aspirasi.create') ? 'active' : '' }}">➕ Form Aspirasi</a>
                <a href="{{ route('aspirasi.histori') }}" class="nav-link {{ Route::is('aspirasi.histori') ? 'active' : '' }}">📜 Histori</a>
            @endif
            <a href="{{ route('logout') }}" class="nav-link nav-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>
