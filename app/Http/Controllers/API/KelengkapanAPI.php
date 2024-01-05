<?php

namespace App\Http\Controllers\API;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;

class KelengkapanAPI extends Controller
{
    function index(Request $request)
    {
        $tahun = $request->tahun;
        $semester = $request->semester;
        $dosen_id = $request->dosen_id;
        $limit = $request->limit;
        $search = $request->search;
        $data = Jadwal::with(['uploadRps', 'uploadNilai', 'uploadAbsen', 'beritaAcara.uloadBeritaAcara', 'dosen', 'matkul'])
            ->where([
                ['tahun', $tahun],
                ['semester', $semester],
            ])->when($dosen_id, function ($query) use ($dosen_id) {
                $query->where('dosen_id', $dosen_id);
            })
            ->where(function ($query) use ($search) {
                $query->where('hari', 'like', "%$search%")
                    ->orWhereHas('matkul', function ($matkul) use ($search) {
                        $matkul->where('nama', 'like', "%$search%")
                            ->orWhere('singkat', 'like', "%$search%");
                    });
            })
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('mulai')
            ->paginate($limit);
        return new CrudResource('success', 'Data Jadwal', $data);
    }
}
