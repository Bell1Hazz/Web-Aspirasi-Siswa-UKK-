@extends('layouts.app')

@section('title', 'Daftar Aspirasi')

@section('content')
<div class="admin-list-container">
    <div class="list-header">
        <h2>📝 Daftar Aspirasi</h2>
        <p>Kelola dan pantau semua aspirasi yang masuk</p>
    </div>

    <div class="filter-section">
        <h3>🔍 Filter Data</h3>
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
                                {{ $siswa->name }}
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

                <div class="filter-group">
                    <button type="submit" class="btn btn-primary">🔍 Filter</button>
                    <a href="{{ route('admin.list') }}" class="btn btn-secondary">🔄 Reset</a>
                </div>
            </div>
        </form>
    </div>

    @if($aspirasis->isEmpty())
        <div class="empty-state">
            <p>📭 Tidak ada aspirasi dengan kriteria yang Anda cari.</p>
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
                            <td>{{ $aspirasi->user->name }}</td>
                            <td>{{ $aspirasi->kategori->nama_kategori }}</td>
                            <td>{{ \Carbon\Carbon::parse($aspirasi->tanggal_pengajuan)->format('d-m-Y') }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $aspirasi->status)) }}">
                                    {{ $aspirasi->status }}
                                </span>
                            </td>
                            <td class="action-cell">
                                <a href="{{ route('admin.detail', $aspirasi->id) }}" class="btn btn-small btn-primary">
                                    👁️ Lihat
                                </a>
                                <a href="{{ route('admin.feedback.form', $aspirasi->id) }}" class="btn btn-small btn-warning">
                                    💬 Feedback
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
@endsection
