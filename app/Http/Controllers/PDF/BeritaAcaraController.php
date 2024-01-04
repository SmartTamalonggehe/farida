<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\BeritaAcara;
use App\Models\DetBeritaAcara;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    function index($id)
    {
        $beritaAcara = BeritaAcara::with(['jadwal.matkul', 'jadwal.ruangan', 'jadwal.prodi', 'jadwal.dosen'])
            ->findOrFail($id);
        $data = DetBeritaAcara::where('berita_acara_id', $id)->get();
        // cetak pdf
        $pdf = Pdf::loadView('cetak.beritaAcara', [
            'BA' => $beritaAcara,
            'data' => $data
        ]);
        return $pdf->stream('berita acara.pdf');
        return view('cetak.beritaAcara', [
            'BA' => $beritaAcara,
            'data' => $data
        ]);
    }
}
