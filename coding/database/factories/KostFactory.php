<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'noHp' => $this->faker->unique()->phoneNumber(),
            // 'alamat' => $this->faker->address(),
            'rt' => mt_rand(1, 20),
            'rw' => mt_rand(1, 5),
            'no' => mt_rand(1, 40),
            'kelurahan' => $this->faker->randomElement(['Bidara Cina', 'Cipinang Cempedak']),
            'area' => $this->faker->randomElement(['Bonsay', 'Bonasel', 'Bonasut']),
            'gender' => $this->faker->randomElement(['Pria', 'Wanita', 'Campuran']),
            'harga' => mt_rand(700000, 1200000),
            'fasilitas' => $this->faker->sentence(mt_rand(2, 5)),
            'jumKam' => mt_rand(6, 10),
            'jumKos' => mt_rand(0, 6),
            'ringkasan' => $this->faker->paragraph(),
            'deskripsi' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(5, 10))) . '</p>',
            'user_id' => mt_rand(1, 3),
            'durSewa' => mt_rand(0, 12),
            'tipe' => $this->faker->randomElement(['A', 'B', 'C']),
        ];
    }
}
