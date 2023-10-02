<?php

namespace App\Http\Controllers\API;

use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;

class ProdiAPI extends Controller
{
    function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit;
        $data = Prodi::where('nama', 'like', "%$search%")
            ->orderBy('nama', 'asc')
            ->paginate($limit);
        return new CrudResource('success', 'Data Prodi', $data);
    }

    function all(Request $request)
    {
        $search = $request->search;
        $data = Prodi::where('nama', 'like', "%$search%")
            ->orderBy('nama', 'asc')
            ->get();
        return new CrudResource('success', 'Data Prodi', $data);
    }
}
