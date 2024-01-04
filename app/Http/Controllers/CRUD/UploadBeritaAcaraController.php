<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Models\UploadBeritaAcara;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\TOOLS\ImgToolsController;

class UploadBeritaAcaraController extends Controller
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
            'berita_acara_id' => 'required|unique:upload_berita_acara,berita_acara_id,' . $id,
        ];

        $messages = [
            'berita_acara_id.required' => 'Berita acara harus diisi.',
            'berita_acara_id.unique' => 'Matakuliah pada jadwal ini sudah ada.',
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
        $dosen_id = $request->dosen_id;
        $semester = $request->semester;
        $tahun = $request->tahun;
        $data = UploadBeritaAcara::with(['beritaAcara.jadwal.matkul', 'beritaAcara.jadwal.ruangan', 'beritaAcara.jadwal.prodi', 'beritaAcara.jadwal.dosen'])
            ->whereHas('beritaAcara.jadwal', function ($query) use ($search, $dosen_id, $tahun, $semester) {
                $query->where([
                    ['dosen_id', "like", "%$dosen_id%"],
                    ['tahun', $tahun],
                    ['semester', $semester]
                ])->where(function ($query) use ($search) {
                    $query->where('hari', 'like', "%$search%")
                        ->orWhereHas('matkul', function ($matkul) use ($search) {
                            $matkul->where('nama', 'like', "%$search%")
                                ->orWhere('singkat', 'like', "%$search%");
                        });
                });
            })
            ->paginate(10);
        return new CrudResource('success', 'Data UploadBeritaAcara', $data);
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
            $file = $this->imgController->addImage('file_berita_acara', $data_req['file']);
            $data_req['file'] = "storage/$file";
        }

        UploadBeritaAcara::create($data_req);
        $data = UploadBeritaAcara::with(['beritaAcara.jadwal.matkul', 'beritaAcara.jadwal.ruangan', 'beritaAcara.jadwal.prodi', 'beritaAcara.jadwal.dosen'])
            ->latest()->first();

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
        // return $id;
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

        $data = UploadBeritaAcara::findOrFail($id);
        // find file file
        $file = $data->file;
        // export file
        if ($request->hasFile('file')) {
            // remove file file jika ada
            if ($file) {
                File::delete($file);
            }
            $file = $this->imgController->addImage('file_berita_acara', $data_req['file']);
            $data_req['file'] = "storage/$file";
        } else {
            $data_req['file'] = $file;
        }

        $data->update($data_req);

        $data = UploadBeritaAcara::with(['beritaAcara.jadwal.matkul', 'beritaAcara.jadwal.ruangan', 'beritaAcara.jadwal.prodi', 'beritaAcara.jadwal.dosen'])->find($id);

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
        // delete data uploadBeritaAcara
        $data = UploadBeritaAcara::findOrFail($id);
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
