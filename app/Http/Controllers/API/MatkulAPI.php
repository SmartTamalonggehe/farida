<?php

namespace App\Http\Controllers\API;

use App\Models\Matkul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;

class MatkulAPI extends Controller
{
    function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit;
        $data = Matkul::where('nama', 'like', "%$search%")
            ->orderBy('nama', 'asc')
            ->paginate($limit);
        return new CrudResource('success', 'Data Matkul', $data);
    }

    function all(Request $request)
    {
        $search = $request->search;
        $prodi_id = $request->prodi_id;
        $data = Matkul::where('nama', 'like', "%$search%")
            ->where('prodi_id', 'like', "%$prodi_id%")
            ->orderBy('nama', 'asc')
            ->get();
        return new CrudResource('success', 'Data Matkul', $data);
    }
}
