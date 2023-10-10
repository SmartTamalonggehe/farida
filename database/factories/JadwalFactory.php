<?php

namespace Database\Factories;

use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // random dosen_id
        $dosen = Dosen::inRandomOrder()->first();
        // random matkul_id
        $matkul = Matkul::inRandomOrder()->first();
        // random ruangan_id
        $ruangan = Ruangan::inRandomOrder()->first();
        return [
            'prodi_id' => $dosen->prodi_id,
            'matkul_id' => $matkul->id,
            'dosen_id' => $dosen->id,
            'ruangan_id' => $ruangan->id,
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']),
            'mulai' => $this->faker->time('H:i'),
            'seles' => $this->faker->time('H:i'),
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            // tahun dari 2022 sampai 2023
            'tahun' => $this->faker->numberBetween(2022, 2023),
        ];
    }
}
