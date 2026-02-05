@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Data Kategori</h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle kategori-table mb-0">
    <thead>
        <tr>
            <th class="text-center col-id">ID</th>
            <th class="col-nama">Nama Kategori</th>
            <th class="text-center col-aksi">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($kategoris as $k)
            <tr>
                <td class="text-center col-id">
                    <span class="id-pill">{{ $k->id }}</span>
                </td>

                <td class="col-nama">
                    <span class="kategori-text">{{ $k->nama_kategori }}</span>
                </td>

                <td class="text-center col-aksi">
                    <div class="aksi-wrap">
                        <a href="{{ route('admin.kategori.edit', $k->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.kategori.destroy', $k->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center py-4 text-muted">
                    Belum ada kategori
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<style>
    /* Lebar kolom konsisten */
    .kategori-table .col-id { width: 110px; }      /* diperlebar */
    .kategori-table .col-aksi { width: 210px; }

    /* Header rapi */
    .kategori-table thead th{
        white-space: nowrap;
        vertical-align: middle;
        padding: 12px 14px;
    }

    /* Isi tabel rapi */
    .kategori-table tbody td{
        vertical-align: middle;
        padding: 12px 14px; /* padding lebih lega */
    }

    /* ID biar "lega" dan tidak dempet border */
    .id-pill{
        display: inline-block;
        min-width: 56px;         /* bikin angka punya ruang */
        padding: 6px 10px;       /* ruang dalam */
        line-height: 1;
        letter-spacing: .5px;    /* angka tidak dempet */
        font-weight: 600;
    }

    /* Nama kategori tidak mepet */
    .kategori-text{
        display: inline-block;
        padding-left: 6px;
    }

    /* Tombol aksi sejajar */
    .aksi-wrap{
        display: inline-flex;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
        justify-content: center;
    }
    .aksi-wrap form { margin: 0; }
</style>

            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $kategoris->links() }}
            </div>

        </div>
    </div>
</div>

<style>
    /* Lebar kolom konsisten */
    .kategori-table .col-id { width: 90px; }
    .kategori-table .col-aksi { width: 210px; }

    /* Header rapi */
    .kategori-table thead th{
        white-space: nowrap;
        vertical-align: middle;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    /* Isi tabel rapi */
    .kategori-table tbody td{
        vertical-align: middle;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    /* Nama kategori tidak mepet border */
    .kategori-text{
        display: inline-block;
        padding-left: 6px;
    }

    /* Tombol aksi sejajar, ga turun ke bawah */
    .aksi-wrap{
        display: inline-flex;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
        justify-content: center;
    }

    /* Biar form tombol hapus tidak bikin tinggi beda */
    .aksi-wrap form { margin: 0; }
</style>
@endsection
