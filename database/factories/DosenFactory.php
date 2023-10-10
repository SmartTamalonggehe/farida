<?php

namespace Database\Factories;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // random prodi_id
        $prodi_id = Prodi::inRandomOrder()->first()->id;
        return [
            "prodi_id" => $prodi_id,
            "nama" => $this->faker->name(),
            "jabatan" => $this->faker->jobTitle(),
            "tempat_lahir" => $this->faker->city(),
            "tgl_lahir" => $this->faker->date(),
            "jenkel" => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            "agama" => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            "alamat" => $this->faker->address(),
            "no_hp" => $this->faker->phoneNumber(),
            "foto" => "",
        ];
    }
}
