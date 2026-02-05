<nav class="navbar">
    <div class="navbar-content">
        <div class="navbar-left">
            <span class="navbar-user">
                <!-- Icon: User -->
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ Auth::user()->nama }}
                <small>({{ Auth::user()->role === 'admin' ? 'Administrator' : 'Siswa' }})</small>
            </span>
        </div>

        <div class="navbar-right">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <!-- Icon: Bar Chart / Dashboard -->
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 19V5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M8 19v-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 19V9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M16 19v-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M20 19v-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.list') }}" class="nav-link {{ Route::is('admin.list') ? 'active' : '' }}">
                    <!-- Icon: Clipboard / List -->
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M8 11h8M8 15h8M8 19h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                    Daftar Aspirasi
                </a>
                <a href="{{ route('admin.kategori.index') }}"
   class="nav-link {{ Route::is('admin.kategori.*') ? 'active' : '' }}">
    <!-- Icon: Tag / Category -->
    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M20 13l-7 7-10-10V3h7L20 13Z"
              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M7.5 7.5h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    </svg>
    Kategori
</a>

            @else
                <a href="{{ route('siswa.index') }}" class="nav-link {{ Route::is('siswa.index') ? 'active' : '' }}">
                    <!-- Icon: Home -->
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M3 10.5 12 3l9 7.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.5 10.5V21h13V10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 21v-6h4v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Beranda
                </a>

                <a href="{{ route('aspirasi.create') }}" class="nav-link {{ Route::is('aspirasi.create') ? 'active' : '' }}">
                    <!-- Icon: Plus Circle -->
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 8v8M8 12h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Form Aspirasi
                </a>

                <a href="{{ route('aspirasi.histori') }}" class="nav-link {{ Route::is('aspirasi.histori') ? 'active' : '' }}">
                    <!-- Icon: Clock / History -->
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Histori
                </a>
            @endif

            <a href="{{ route('logout') }}"
               class="nav-link nav-logout"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <!-- Icon: Logout -->
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M10 17l5-5-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 12H3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M21 3h-8a2 2 0 0 0-2 2v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11 16v3a2 2 0 0 0 2 2h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>

<style>
    /* Icon rapi dan sejajar teks */
    .nav-icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.15em;
        margin-right: .45rem;
        flex: 0 0 auto;
    }

    /* Pastikan link align center (kalau CSS navbar kamu belum) */
    .navbar-right .nav-link{
        display: inline-flex;
        align-items: center;
        gap: 0; /* gap sudah ditangani oleh margin di icon */
    }
</style>
