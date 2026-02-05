<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasis';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
         'gambar',
        'deskripsi',
        'tanggal_pengajuan',
        'status'
    ];

    protected $dates = [
        'tanggal_pengajuan',
        'created_at',
        'updated_at'
    ];

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi dengan Feedback
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    /**
     * Scope: Filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Filter berdasarkan siswa
     */
    public function scopeBySiswa($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope: Filter berdasarkan kategori
     */
    public function scopeByKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    /**
     * Scope: Filter berdasarkan bulan
     */
    public function scopeByBulan($query, $bulan, $tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return $query->whereMonth('tanggal_pengajuan', $bulan)
                     ->whereYear('tanggal_pengajuan', $tahun);
    }
}
