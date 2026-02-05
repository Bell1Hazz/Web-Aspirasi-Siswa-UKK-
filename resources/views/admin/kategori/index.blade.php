@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Kategori</h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th style="width:80px;">ID</th>
                        <th>Nama Kategori</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $k)
                        <tr>
                            <td>{{ $k->id }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td>
                                <a href="{{ route('admin.kategori.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.kategori.destroy', $k->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">Belum ada kategori</td></tr>
                    @endforelse
                </tbody>
            </table>

            {{ $kategoris->links() }}
        </div>
    </div>
</div>
@endsection
