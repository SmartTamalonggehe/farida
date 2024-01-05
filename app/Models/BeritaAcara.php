<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'berita_acara';

    function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id', 'jadwal_id');
    }

    function uloadBeritaAcara()
    {
        return $this->hasOne(UploadBeritaAcara::class, 'berita_acara_id', 'id');
    }
}
