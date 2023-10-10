<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadRps extends Model
{
    use HasFactory;

    protected $table = 'upload_rps';

    function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id', 'jadwal_id');
    }
}
