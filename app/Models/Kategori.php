<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori'
    ];

    /**
     * Relasi dengan Aspirasi
     */
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class);
    }
}
