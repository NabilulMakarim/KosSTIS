<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // 'body' => $this->faker->paragraphs(mt_rand(5, 10)),
            // 'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
            //     ->map(function ($p) {
            //         return "<p>$p</p>";
            //     }),
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(5, 10))) . '</p>',
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 2)
        ];
    }
}
