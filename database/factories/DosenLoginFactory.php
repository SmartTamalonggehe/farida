<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DosenLogin>
 */
class DosenLoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // call dosen factory
        $dosen_factory = new DosenFactory();
        // call user factory
        $userFactory = new UserFactory();
        return [
            "dosen_id" => $dosen_factory->create()->id,
            "user_id" => $userFactory->create()->id
        ];
    }
}
