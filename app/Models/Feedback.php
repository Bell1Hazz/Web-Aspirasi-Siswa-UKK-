<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'aspirasi_id',
        'isi_feedback',
        'tanggal_feedback'
    ];

    protected $dates = [
        'tanggal_feedback',
        'created_at',
        'updated_at'
    ];

    /**
     * Relasi dengan Aspirasi
     */
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }
}
