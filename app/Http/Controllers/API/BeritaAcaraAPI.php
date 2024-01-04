<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use App\Models\BeritaAcara;

class BeritaAcaraAPI extends Controller
{
    public function byDosen(Request $request)
    {
        $search = $request->search;
        $dosen_id = $request->dosen_id;
        $semester = $request->semester;
        $tahun = $request->tahun;
        $prodi_id = $request->prodi_id;
        $data = BeritaAcara::with(['jadwal.matkul', 'jadwal.ruangan', 'jadwal.prodi', 'jadwal.dosen'])
            ->whereHas('jadwal', function ($query) use ($search, $dosen_id, $semester, $tahun, $prodi_id) {
                $query->where('dosen_id', "like", "%$dosen_id%")
                    ->where('semester', $semester)
                    ->where('tahun', $tahun);
            })
            ->get();
        return new CrudResource('success', 'Data BeritaAcara', $data);
    }
}
