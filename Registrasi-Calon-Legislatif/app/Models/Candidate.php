<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    // Kolom yang dapat diisi
    protected $fillable = [
        'name', 'position', 'formulir', 'ktp', 'ijazah', 'surat_pernyataan', 'surat_bebas_narkoba', 'user_id'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


