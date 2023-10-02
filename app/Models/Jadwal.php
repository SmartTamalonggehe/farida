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
}
