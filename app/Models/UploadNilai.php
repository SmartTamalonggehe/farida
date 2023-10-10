<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadNilai extends Model
{
    use HasFactory;

    protected $table = 'upload_nilai';

    function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
}
