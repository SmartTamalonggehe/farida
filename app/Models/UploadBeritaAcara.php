<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadBeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'upload_berita_acara';

    function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
}
