<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $url = "https://back.edom.fstuogp.com/api/ruangan";
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
                Ruangan::create([
                    'id' => $item->id,
                    'kode' => $item->kode,
                    'nama' => $item->nama,
                    'kapasitas' => $item->kapasitas,
                ]);
            }
        }
    }
}
