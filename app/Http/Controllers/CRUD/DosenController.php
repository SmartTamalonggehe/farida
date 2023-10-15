<?php

namespace App\Http\Controllers\CRUD;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\TOOLS\ImgToolsController;
use App\Http\Controllers\CRUD\DosenLoginController;

class DosenController extends Controller
{
    public $imgController;
    public $dosenLogin;

    public function __construct()
    {
        // memanggil controller image
        $this->imgController = new ImgToolsController();
        // memanggil controller dosen login
        $this->dosenLogin = new DosenLoginController();
    }
    protected function spartaValidation($request, $id = "")
    {
        $required = "";
        if ($id == "") {
            $required = "required";
        }
        $rules = [
            'nama' => 'required',
        ];

        $messages = [
            'nama.required' => 'Nama dosen harus diisi.',
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
        $data = Dosen::with('prodi')
            ->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('NIDN', 'like', "%$search%")
                    ->orWhereHas('prodi', function ($prodi) use ($search) {
                        $prodi->where('nama', 'like', "%$search%");
                    });
            })
            ->orderBy('nama', 'asc')
            ->paginate(10);
        return new CrudResource('success', 'Data Dosen', $data);
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
            $foto = $this->imgController->addImage('foto_dosen', $data_req['foto']);
            $data_req['foto'] = "storage/$foto";
        }
        // make id dosen form time
        $data_req['id'] = time();
        Dosen::create($data_req);
        $data = Dosen::with(['prodi'])->latest()->first();
        // menyimpan data login dosen
        $this->dosenLogin->store($data_req);

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
        return $this->dosenLogin->show($id);
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

        $data = Dosen::findOrFail($id);
        // find file foto
        $foto = $data->foto;
        // export foto
        if ($request->hasFile('foto')) {
            // remove file foto jika ada
            if ($foto) {
                File::delete($foto);
            }
            $foto = $this->imgController->addImage('foto_dosen', $data_req['foto']);
            $data_req['foto'] = "storage/$foto";
        } else {
            $data_req['foto'] = $foto;
        }

        $data->update($data_req);

        $data = Dosen::find($id);

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
        // delete data dosenlogin
        $this->dosenLogin->destroy($id);
        // delete data dosen
        $data = Dosen::findOrFail($id);
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
