<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetBeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'det_berita_acara';

    function beritaAcara()
    {
        return $this->belongsTo(BeritaAcara::class);
    }
}
