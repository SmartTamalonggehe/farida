<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\TOOLS\ImgToolsController;
use App\Models\BeritaAcara;
use App\Models\Jadwal;
use App\Models\UploadRps;

class UploadRPSController extends Controller
{
    public $imgController;

    public function __construct()
    {
        // memanggil controller image
        $this->imgController = new ImgToolsController();
    }
    protected function spartaValidation($request, $id = "")
    {
        $required = "";
        if ($id == "") {
            $required = "required";
        }
        $rules = [
            'jadwal_id' => 'required|unique:upload_rps,jadwal_id,' . $id,
        ];

        $messages = [
            'jadwal_id.required' => 'Jadwal harus diisi.',
            'jadwal_id.unique' => 'Matakuliah pada jadwal ini sudah ada.',
        ];
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            $message = [
                'judul' => 'Gagal',
                'type' => 'error',
                'message' => $validator->errors()->first(),
            ];
            return response()->json($message, 400);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // untuk admin
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit;
        $semester = $request->semester;
        $tahun = $request->tahun;
        $data = UploadRps::with(['jadwal.matkul', 'jadwal.ruangan', 'jadwal.prodi', 'jadwal.dosen'])
            ->whereHas('jadwal', function ($query) use ($search, $semester, $tahun) {
                $query->where(function ($query) use ($search) {
                    $query->where('hari', 'like', "%$search%")
                        ->orWhereHas('matkul', function ($mhs) use ($search) {
                            $mhs->where('nama', 'like', "%$search%")
                                ->orWhere('singkat', 'like', "%$search%");
                        });
                })
                    ->where([
                        ['semester', $semester],
                        ['tahun', $tahun],
                    ]);
            })
            ->paginate($limit);
        return new CrudResource('success', 'Data UploadRps', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_req = $request->all();
        // return $data_req;
        $validate = $this->spartaValidation($data_req);
        if ($validate) {
            return $validate;
        }
        // export file
        if ($request->hasFile('file')) {
            $file = $this->imgController->addImage('FileRps', $data_req['file']);
            $data_req['file'] = "storage/$file";
        }
        UploadRps::create($data_req);
        $data = UploadRps::with(['jadwal.matkul', 'jadwal.ruangan'])->latest()->first();
        return new CrudResource('success', 'Data Berhasil Disimpan', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // untuk dosen
    public function show($id, Request $request)
    {
        $semester = $request->semester;
        $tahun = $request->tahun;
        $jadwal_id = Jadwal::where('dosen_id', $id)->pluck('id');
        $data = UploadRps::with(['jadwal.matkul', 'jadwal.ruangan'])
            ->whereHas('jadwal', function ($query) use ($tahun, $semester) {
                $query->where([
                    ['semester', $semester],
                    ['tahun', $tahun],
                ]);
            })
            ->whereIn('jadwal_id', $jadwal_id)->get();
        return new CrudResource('success', 'Data UploadRps', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data_req = $request->all();
        // remove _method from data_req
        unset($data_req['_method']);
        // return $data_req;
        $validate = $this->spartaValidation($data_req, $id);
        if ($validate) {
            return $validate;
        }

        $data = UploadRps::findOrFail($id);
        // find file file
        $file = $data->file;
        // export file
        if ($request->hasFile('file')) {
            // remove file file jika ada
            if ($file) {
                File::delete($file);
            }
            $file = $this->imgController->addImage('FileRps', $data_req['file']);
            $data_req['file'] = "storage/$file";
        } else {
            $data_req['file'] = $file;
        }

        $data->update($data_req);

        $data = UploadRps::with(['jadwal.matkul', 'jadwal.ruangan'])->find($id);
        // jika status diterima
        if ($data->status == 'diterima') {
            // create berita acara
            BeritaAcara::create([
                'jadwal_id' => $data->jadwal_id,
            ]);
        } else {
            // delete berita acara
            BeritaAcara::where('jadwal_id', $data->jadwal_id)->delete();
        }
        return new CrudResource('success', 'Data Berhasil Diubah', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete data uploadRps
        $data = UploadRps::findOrFail($id);
        $file = $data->file;
        // remove file file
        if ($file) {
            File::delete($file);
        }
        // delete data
        $data->delete();

        return new CrudResource('success', 'Data Berhasil Dihapus', $data);
    }
}
