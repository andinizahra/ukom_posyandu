<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisSurat>
 */
class CatatanImunisasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'catatan_imunisasi' => fake()->name,
            'id_catatan_vaksin' => fake()->name,
            'id_user' => fake()->name,
            'ringkasan' => fake()->name,
            'file' => fake()->name 
        ];
    }
}
