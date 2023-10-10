<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAbsen extends Model
{
    use HasFactory;

    protected $table = 'upload_absen';

    function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
}
