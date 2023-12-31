<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    function uploadRps()
    {
        return $this->hasOne(UploadRps::class, 'jadwal_id', 'id');
    }

    function uploadNilai()
    {
        return $this->hasOne(UploadNilai::class, 'jadwal_id', 'id');
    }

    function uploadAbsen()
    {
        return $this->hasOne(UploadAbsen::class, 'jadwal_id', 'id');
    }

    function beritaAcara()
    {
        return $this->hasOne(BeritaAcara::class, 'jadwal_id', 'id');
    }
}
