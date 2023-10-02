<?php

namespace Database\Seeders;

use App\Models\Matkul;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $url = "https://back.edom.fstuogp.com/api/matkul";
        $getContent = file_get_contents("$url");
        $decodeContent = json_decode($getContent);
        $lastPage = $decodeContent->data->last_page;

        for ($i = 1; $i <= $lastPage; $i++) {
            $json = file_get_contents("$url?page=$i");
            $jsonDecode = json_decode($json);
            array_push($data, $jsonDecode->data->data);
        }

        foreach ($data as $obj) {
            foreach ($obj as $item) {
                //    remove 6 frist character
                Matkul::create([
                    'id' => $item->id,
                    'prodi_id' => $item->prodi_id,
                    'kode' => $item->kode,
                    'nama' => $item->nama,
                    'sks' => $item->sks,
                    'semester' => $item->semester,
                    'singkat' => $item->singkat,
                    'status' => $item->status,
                ]);
            }
        }
    }
}
