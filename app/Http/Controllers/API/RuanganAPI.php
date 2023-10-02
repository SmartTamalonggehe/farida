<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use App\Models\Ruangan;

class RuanganAPI extends Controller
{
    function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit;
        $data = Ruangan::where('nama', 'like', "%$search%")
            ->orderBy('nama', 'asc')
            ->paginate($limit);
        return new CrudResource('success', 'Data Ruangan', $data);
    }

    function all(Request $request)
    {
        $search = $request->search;
        $data = Ruangan::where('nama', 'like', "%$search%")
            ->orderBy('nama', 'asc')
            ->get();
        return new CrudResource('success', 'Data Ruangan', $data);
    }
}
