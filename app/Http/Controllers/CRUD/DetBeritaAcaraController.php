<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Models\DetBeritaAcara;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\TOOLS\ImgToolsController;
use App\Models\BeritaAcara;

class DetBeritaAcaraController extends Controller
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
            'berita_acara_id' => 'required',
        ];

        $messages = [
            'berita_acara_id.required' => 'Berita acara harus diisi.',
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
    public function index(Request $request)
    {
        $search = $request->search;
        $data = DetBeritaAcara::where('materi', 'like', "%$search%")
            ->orderBy('tgl', 'desc')
            ->paginate(10);
        return new CrudResource('success', 'Data DetBeritaAcara', $data);
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
        // export foto
        if ($request->hasFile('foto')) {
            $foto = $this->imgController->addImage('foto_detBeritaAcara', $data_req['foto']);
            $data_req['foto'] = "storage/$foto";
        }

        DetBeritaAcara::create($data_req);
        $data = DetBeritaAcara::latest()->first();

        return new CrudResource('success', 'Data Berhasil Disimpan', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = BeritaAcara::with(['jadwal.matkul', "jadwal.dosen", "jadwal.ruangan", "jadwal.prodi"])->findOrFail($id);

        return new CrudResource('success', 'Data Berhasil Ditemukan', $data);
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
        $validate = $this->spartaValidation($data_req);
        if ($validate) {
            return $validate;
        }

        $data = DetBeritaAcara::findOrFail($id);
        // find file foto
        $foto = $data->foto;
        // export foto
        if ($request->hasFile('foto')) {
            // remove file foto jika ada
            if ($foto) {
                File::delete($foto);
            }
            $foto = $this->imgController->addImage('foto_detBeritaAcara', $data_req['foto']);
            $data_req['foto'] = "storage/$foto";
        } else {
            $data_req['foto'] = $foto;
        }

        $data->update($data_req);

        $data = DetBeritaAcara::find($id);

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
        // delete data detBeritaAcara
        $data = DetBeritaAcara::findOrFail($id);
        $foto = $data->foto;
        // remove foto foto
        if ($foto) {
            File::delete($foto);
        }
        // delete data
        $data->delete();

        return new CrudResource('success', 'Data Berhasil Dihapus', $data);
    }
}
