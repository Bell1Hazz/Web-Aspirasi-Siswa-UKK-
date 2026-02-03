@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="admin-dashboard">
    <div class="dashboard-header">
        <h2 class="heading-with-icon">
            <!-- Icon: Bar Chart -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4 19V5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M8 19v-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M12 19V9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M16 19v-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M20 19v-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            Dashboard Admin
        </h2>
        <p>Ringkasan Data Aspirasi dan Pengaduan Sarana Sekolah</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Clipboard -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M8 11h8M8 15h8M8 19h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $totalAspi }}</h3>
                <p>Total Aspirasi</p>
            </div>
        </div>

        <div class="stat-card stat-diajukan">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Clock -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $aspilDiajukan }}</h3>
                <p>Diajukan</p>
            </div>
        </div>

        <div class="stat-card stat-diproses">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Settings -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.4 15a7.9 7.9 0 0 0 .1-6l-2 1.2a6.1 6.1 0 0 0-1.2-1.2L17.5 7a7.9 7.9 0 0 0-6-.1L12 9.2a6.1 6.1 0 0 0-1.7 0L9.5 6.9a7.9 7.9 0 0 0-6 .1l1.2 2a6.1 6.1 0 0 0-1.2 1.2L1.4 9a7.9 7.9 0 0 0 .1 6l2-1.2c.35.45.75.85 1.2 1.2L3.5 17a7.9 7.9 0 0 0 6 .1l.8-2.3c.56.07 1.14.07 1.7 0l.8 2.3a7.9 7.9 0 0 0 6-.1l-1.2-2c.45-.35.85-.75 1.2-1.2l2 1.2Z"
                          stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $aspilDiproses }}</h3>
                <p>Diproses</p>
            </div>
        </div>

        <div class="stat-card stat-selesai">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Check Circle -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M9 12.5l2 2 4-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $aspilSelesai }}</h3>
                <p>Selesai</p>
            </div>
        </div>
    </div>

    <div class="action-section">
        <h3 class="heading-with-icon">
            <!-- Icon: Wrench -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M14.7 6.3a5 5 0 0 0-6.9 6.9l-4.4 4.4a2 2 0 0 0 2.8 2.8l4.4-4.4a5 5 0 0 0 6.9-6.9l-2.3 2.3-2.8-2.8 2.3-2.3Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Menu Utama
        </h3>

        <div class="action-buttons">
            <a href="{{ route('admin.list') }}" class="btn btn-primary btn-lg btn-with-icon">
                <!-- Icon: Clipboard / Edit -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M8 11h8M8 15h8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
                Kelola Daftar Aspirasi
            </a>

            <a href="{{ route('admin.list') }}?status=Diajukan" class="btn btn-warning btn-lg btn-with-icon">
                <!-- Icon: Clock -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Aspirasi Baru
            </a>

            <a href="{{ route('admin.list') }}?status=Diproses" class="btn btn-info btn-lg btn-with-icon">
                <!-- Icon: Settings -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.4 15a7.9 7.9 0 0 0 .1-6l-2 1.2a6.1 6.1 0 0 0-1.2-1.2L17.5 7a7.9 7.9 0 0 0-6-.1L12 9.2a6.1 6.1 0 0 0-1.7 0L9.5 6.9a7.9 7.9 0 0 0-6 .1l1.2 2a6.1 6.1 0 0 0-1.2 1.2L1.4 9a7.9 7.9 0 0 0 .1 6l2-1.2c.35.45.75.85 1.2 1.2L3.5 17a7.9 7.9 0 0 0 6 .1l.8-2.3c.56.07 1.14.07 1.7 0l.8 2.3a7.9 7.9 0 0 0 6-.1l-1.2-2c.45-.35.85-.75 1.2-1.2l2 1.2Z"
                          stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Sedang Diproses
            </a>
        </div>
    </div>

    <div class="info-section">
        <h3 class="heading-with-icon">
            <!-- Icon: Pin -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 22s7-4.5 7-11a7 7 0 1 0-14 0c0 6.5 7 11 7 11Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 11.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Petunjuk Admin
        </h3>
        <ul>
            <li>Pantau semua aspirasi yang masuk dari siswa</li>
            <li>Berikan feedback dan update status aspirasi</li>
            <li>Filter aspirasi berdasarkan kategori, siswa, atau tanggal</li>
            <li>Pastikan setiap aspirasi mendapat respons yang tepat dan cepat</li>
        </ul>
    </div>
</div>

<style>
    /* icon konsisten untuk halaman dashboard */
    .ui-icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.15em;
        margin-right: .5rem;
        flex: 0 0 auto;
    }
    .heading-with-icon,
    .btn-with-icon{
        display: inline-flex;
        align-items: center;
    }

    /* stat icon rapi (bukan emoji lagi) */
    .stat-icon{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(0,0,0,.06);
    }
    .stat-icon .ui-icon{
        margin-right: 0; /* icon di dalam badge */
        width: 22px;
        height: 22px;
    }

    /* tombol icon rapi */
    .action-buttons .btn{
        display: inline-flex;
        align-items: center;
        gap: 0;
    }
</style>
@endsection
