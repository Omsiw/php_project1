<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mod>
 */
class ModFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_id' => Game::factory()->create()->id,
            'author_id' => Author::factory()->create()->id,
            'name' => fake()->name(),
            'info' => fake()->text(),
            'date_add' => fake()->dateTime()->format('m/d/Y H:i:s')
        ];
    }
}
