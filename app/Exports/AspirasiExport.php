<?php

namespace App\Exports;

use App\Models\Aspirasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AspirasiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Aspirasi::with(['user', 'kategori']);

        if ($this->request->status) {
            $query->where('status', $this->request->status);
        }

        if ($this->request->kategori_id) {
            $query->where('kategori_id', $this->request->kategori_id);
        }

        if ($this->request->user_id) {
            $query->where('user_id', $this->request->user_id);
        }

        if ($this->request->bulan) {
            $query->whereMonth('tanggal_pengajuan', $this->request->bulan);
        }

        if ($this->request->tahun) {
            $query->whereYear('tanggal_pengajuan', $this->request->tahun);
        }

        return $query->orderBy('tanggal_pengajuan', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Nama Siswa',
            'Kategori',
            'Tanggal Pengajuan',
            'Status'
        ];
    }

    public function map($aspirasi): array
    {
        return [
            $aspirasi->judul,
            $aspirasi->user->nama,
            $aspirasi->kategori->nama_kategori,
            $aspirasi->tanggal_pengajuan,
            $aspirasi->status
        ];
    }
}