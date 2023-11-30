<?php

namespace App\Http\Controllers\CRUD;

use App\Models\User;
use App\Models\DosenLogin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CrudResource;
use App\Models\UserToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DosenLoginController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit;
        $data = DosenLogin::with('dosen')
            ->whereHas('dosen', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->paginate($limit);
        return new CrudResource('success', 'Data DosenLogin', $data);
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
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data_req = $request;
            // membuat password
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz-_#@';
            $password = '';
            for ($i = 0; $i < 8; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $password .= $characters[$index];
            }
            // membuang karakter setelah , dan .
            $remove_koma = str_replace(['.', ','], '', $data_req['nama']);
            $slug = Str::slug($remove_koma, '_'); // Membuat slug dari nama (misalnya: john-doe)
            $email = Str::finish($slug, '@fstuogp.com'); // Menambahkan "@fstuogp.com" di belakang slug
            // input data user
            $user = User::create([
                'id' => $data_req['id'],
                'name' => $data_req['nama'],
                'email' => $email,
                'password' => Hash::make($password),
                'show_password' => $password,
                'role' => 'dosen',
            ]);
            // simpan data dosen login
            DosenLogin::create([
                'dosen_id' => $data_req['id'],
                'user_id' => $user->id,
            ]);

            $data = DosenLogin::latest()->first();
            DB::commit();
            return new CrudResource('success', 'Data Berhasil Disimpan', $data);
        } catch (\Throwable $th) {
            // jika terdapat kesalahan
            DB::rollback();
            $message = [
                'judul' => 'Gagal',
                'type' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($message, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
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
    public function update($data_req, $id)
    {
        DosenLogin::find($id)->update($data_req);

        $data = DosenLogin::find($id);

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
        $data = DosenLogin::where('user_id', $id)->first();
        // jika data dosen login tidak ada
        if (!$data) {
            return new CrudResource('error', 'Data Tidak Ditemukan', $data);
        }
        DB::beginTransaction();
        try {
            // delete user token
            UserToken::where('user_id', $id)->delete();
            // delete data user
            User::destroy($id);

            // delete data
            $data->delete();

            DB::commit();

            return new CrudResource('success', 'Data Berhasil Dihapus', $data);
        } catch (\Throwable $th) {
            DB::rollback();
            $message = [
                'judul' => 'Gagal',
                'type' => 'error',
                'message' => $th->getMessage(),
            ];
            return response()->json($message, 400);
        }
    }
}
