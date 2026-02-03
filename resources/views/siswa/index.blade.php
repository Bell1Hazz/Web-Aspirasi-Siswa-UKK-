@extends('layouts.app')

@section('title', 'Beranda Siswa')

@section('content')
<div class="siswa-beranda">
    <div class="beranda-header">
        <h2 class="heading-with-icon">
            <!-- Icon: Home -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M3 10.5 12 3l9 7.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5.5 10.5V21h13V10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 21v-6h4v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Selamat Datang, {{ Auth::user()->name }}!
        </h2>
        <p>Kelola aspirasi dan pengaduan sarana sekolah Anda di sini</p>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Clipboard -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M9 3h6a2 2 0 0 1 2 2v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1V5a2 2 0 0 1 2-2Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M8 11h8M8 15h8M8 19h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>{{ $totalAspi }}</h3>
                <p>Total Aspirasi</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Clock -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>{{ $aspilDiajukan }}</h3>
                <p>Diajukan</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Settings -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.4 15a7.9 7.9 0 0 0 .1-6l-2 1.2a6.1 6.1 0 0 0-1.2-1.2L17.5 7a7.9 7.9 0 0 0-6-.1L12 9.2a6.1 6.1 0 0 0-1.7 0L9.5 6.9a7.9 7.9 0 0 0-6 .1l1.2 2a6.1 6.1 0 0 0-1.2 1.2L1.4 9a7.9 7.9 0 0 0 .1 6l2-1.2c.35.45.75.85 1.2 1.2L3.5 17a7.9 7.9 0 0 0 6 .1l.8-2.3c.56.07 1.14.07 1.7 0l.8 2.3a7.9 7.9 0 0 0 6-.1l-1.2-2c.45-.35.85-.75 1.2-1.2l2 1.2Z"
                          stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>{{ $aspilDiproses }}</h3>
                <p>Diproses</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" aria-hidden="true">
                <!-- Icon: Check Circle -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M9 12.5l2 2 4-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                          stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3>{{ $aspilSelesai }}</h3>
                <p>Selesai</p>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('aspirasi.create') }}" class="btn btn-primary btn-lg btn-with-icon">
            <!-- Icon: Plus Circle -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 8v8M8 12h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Buat Aspirasi Baru
        </a>

        <a href="{{ route('aspirasi.histori') }}" class="btn btn-secondary btn-lg btn-with-icon">
            <!-- Icon: History -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Lihat Histori Aspirasi
        </a>
    </div>

    <div class="info-box">
        <h3 class="heading-with-icon">
            <!-- Icon: Pin -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 22s7-4.5 7-11a7 7 0 1 0-14 0c0 6.5 7 11 7 11Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 11.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Panduan Penggunaan
        </h3>

        <ul>
            <li>Klik "<strong>Buat Aspirasi Baru</strong>" untuk mengirimkan pengaduan</li>
            <li>Isi detail pengaduan dengan lengkap dan jelas</li>
            <li>Pantau status pengaduan Anda di "<strong>Histori Aspirasi</strong>"</li>
            <li>Admin akan memberikan feedback dan update status pengaduan</li>
        </ul>
    </div>
</div>

<style>
    /* util icon */
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

    /* stat icon jadi badge rapi */
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
        margin-right: 0;
        width: 22px;
        height: 22px;
        vertical-align: 0;
    }
</style>
@endsection
