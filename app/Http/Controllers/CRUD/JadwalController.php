<?php

namespace App\Http\Controllers\CRUD;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    protected function spartaValidation($request, $id = "")
    {
        $required = "";
        if ($id == "") {
            $required = "required";
        }
        $rules = [
            'hari' => 'required',
        ];

        $messages = [
            'hari.required' => 'Hari harus diisi.',
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
        $limit = $request->limit;
        $semester = $request->semester;
        $tahun = $request->tahun;
        $search = $request->search;
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
        Jadwal::create($data_req);

        $data = Jadwal::with('dosen', 'matkul', 'ruangan', 'prodi')->latest()->first();

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
        //
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
        // return $data_req;
        $validate = $this->spartaValidation($data_req, $id);
        if ($validate) {
            return $validate;
        }

        Jadwal::find($id)->update($data_req);

        $data = Jadwal::with('dosen', 'matkul', 'ruangan', 'prodi')->find($id);

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
        $data = Jadwal::findOrFail($id);
        // delete data
        $data->delete();

        return new CrudResource('success', 'Data Berhasil Dihapus', $data);
    }
}
