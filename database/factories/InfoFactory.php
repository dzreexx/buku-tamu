<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Info;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Info>
 */
class InfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->sentence(), // Menggunakan sentence untuk mendapatkan string
            'lokasi' => $this->faker->address(), // Tidak ada perubahan, ini sudah benar
            'tanggal' => $this->faker->date(), // Tidak ada perubahan, ini sudah benar
            'ket' => $this->faker->text(100), // Tidak ada perubahan, ini sudah benar
            'created_at' => now(), // Tidak ada perubahan, ini sudah benar
            'updated_at' => now(), // Tidak ada perubahan, ini sudah benar
        ];
    }
}
