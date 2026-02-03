@extends('layouts.app')

@section('title', 'Daftar Aspirasi')

@section('content')
<div class="admin-list-container">
    <div class="list-header">
        <h2 class="heading-with-icon">
            <!-- Icon: Pencil/Edit -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 20h9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Daftar Aspirasi
        </h2>
        <p>Kelola dan pantau semua aspirasi yang masuk</p>
    </div>

    <div class="filter-section">
        <h3 class="heading-with-icon">
            <!-- Icon: Search -->
            <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"
                      stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            Filter Data
        </h3>

        <form method="GET" action="{{ route('admin.list') }}" class="filter-form">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="Diajukan" {{ request('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="kategori_id">Kategori:</label>
                    <select id="kategori_id" name="kategori_id" class="form-control">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="user_id">Siswa:</label>
                    <select id="user_id" name="user_id" class="form-control">
                        <option value="">-- Semua Siswa --</option>
                        @foreach($siswas as $siswa)
                            <option value="{{ $siswa->id }}" {{ request('user_id') == $siswa->id ? 'selected' : '' }}>
                                {{ $siswa->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="filter-row">
                <div class="filter-group">
                    <label for="bulan">Bulan:</label>
                    <select id="bulan" name="bulan" class="form-control">
                        <option value="">-- Semua Bulan --</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromDate(null, $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="filter-group">
                    <label for="tahun">Tahun:</label>
                    <select id="tahun" name="tahun" class="form-control">
                        <option value="">-- Semua Tahun --</option>
                        @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="filter-group filter-actions split">
    <button type="submit" class="btn btn-primary btn-with-icon">
        <!-- Icon: Search -->
        <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"
                  stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        Filter
    </button>

    <a href="{{ route('admin.list') }}" class="btn btn-secondary btn-with-icon">
        <!-- Icon: Refresh -->
        <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M21 12a9 9 0 1 1-2.64-6.36" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 3v6h-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Reset
    </a>
</div>

            </div>
        </form>
    </div>

    @if($aspirasis->isEmpty())
        <div class="empty-state">
            <p class="text-with-icon">
                <!-- Icon: Inbox/Empty -->
                <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 4h16v10l-2 6H6l-2-6V4Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 14h5l2 2h2l2-2h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Tidak ada aspirasi dengan kriteria yang Anda cari.
            </p>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasis as $index => $aspirasi)
                        <tr>
                            <td>{{ ($aspirasis->currentPage() - 1) * $aspirasis->perPage() + $index + 1 }}</td>
                            <td>
                                <strong>{{ substr($aspirasi->judul, 0, 40) }}{{ strlen($aspirasi->judul) > 40 ? '...' : '' }}</strong>
                            </td>
                            <td>{{ $aspirasi->user->nama }}</td>
                            <td>{{ $aspirasi->kategori->nama_kategori }}</td>
                            <td>{{ \Carbon\Carbon::parse($aspirasi->tanggal_pengajuan)->format('d-m-Y') }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $aspirasi->status)) }}">
                                    {{ $aspirasi->status }}
                                </span>
                            </td>
                            <td class="action-cell">
                                <a href="{{ route('admin.detail', $aspirasi->id) }}" class="btn btn-small btn-primary btn-with-icon">
                                    <!-- Icon: Eye -->
                                    <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"
                                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Lihat
                                </a>

                                <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-small btn-warning btn-with-icon">
                                    <!-- Icon: Message -->
                                    <svg class="ui-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"
                                              stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Feedback
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $aspirasis->links() }}
        </div>
    @endif
</div>

<style>
    /* util icon & alignment */
    .ui-icon{
        width: 1.05em;
        height: 1.05em;
        vertical-align: -0.15em;
        margin-right: .45rem;
        flex: 0 0 auto;
    }
    .heading-with-icon,
    .btn-with-icon,
    .text-with-icon{
        display: inline-flex;
        align-items: center;
    }

    /* filter action buttons rapi dalam satu baris */
    .filter-actions{
        display: flex;
        align-items: end;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* tombol kecil di tabel: icon lebih kecil */
    .btn.btn-small .ui-icon{
        width: 1em;
        height: 1em;
        margin-right: .35rem;
        vertical-align: -0.12em;
    }
</style>
@endsection
