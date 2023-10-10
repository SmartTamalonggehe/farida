<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalAPI extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit;
        $semester = $request->semester;
        $tahun = $request->tahun;
        $prodi_id = $request->prodi_id;
        $data = Jadwal::with('dosen', 'matkul', 'ruangan', 'prodi')
            ->where(function ($query) use ($search) {
                $query->where('hari', 'like', "%$search%")
                    ->orWhereHas('matkul', function ($mhs) use ($search) {
                        $mhs->where('nama', 'like', "%$search%")
                            ->orWhere('singkat', 'like', "%$search%");
                    });
            })
            ->where([
                ['semester', $semester],
                ['tahun', $tahun],
                ['prodi_id', "like", "%$prodi_id%"],
            ])
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('mulai')
            ->paginate($limit);
        return new CrudResource('success', 'Data Jadwal', $data);
    }

    public function byThnSmt(Request $request)
    {
        $search = $request->search;
        $semester = $request->semester;
        $tahun = $request->tahun;
        $prodi_id = $request->prodi_id;
        $data = Jadwal::with('dosen', 'matkul', 'ruangan', 'prodi')
            ->where(function ($query) use ($search) {
                $query->where('hari', 'like', "%$search%")
                    ->orWhereHas('matkul', function ($mhs) use ($search) {
                        $mhs->where('nama', 'like', "%$search%")
                            ->orWhere('singkat', 'like', "%$search%");
                    });
            })
            ->where([
                ['semester', $semester],
                ['tahun', $tahun],
                ['prodi_id', "like", "%$prodi_id%"],
            ])
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('mulai')
            ->get();
        return new CrudResource('success', 'Data Jadwal', $data);
    }
    public function byDosen(Request $request)
    {
        $search = $request->search;
        $semester = $request->semester;
        $tahun = $request->tahun;
        $prodi_id = $request->prodi_id;
        $dosen_id = $request->dosen_id;
        $data = Jadwal::with('dosen', 'matkul', 'ruangan', 'prodi')
            ->where(function ($query) use ($search) {
                $query->where('hari', 'like', "%$search%")
                    ->orWhereHas('matkul', function ($mhs) use ($search) {
                        $mhs->where('nama', 'like', "%$search%")
                            ->orWhere('singkat', 'like', "%$search%");
                    });
            })
            ->where([
                ['semester', $semester],
                ['tahun', $tahun],
                ['prodi_id', "like", "%$prodi_id%"],
            ])
            ->where('dosen_id', $dosen_id)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('mulai')
            ->get();
        return new CrudResource('success', 'Data Jadwal', $data);
    }
}
