<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DLS>
 */
class DLSFactory extends Factory
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
            'name' => fake()->name(),
            'info' => fake()->text(),
            'cost' => fake()->numberBetween(),
            'date_add' => fake()->dateTime()->format('m/d/Y H:i:s')
        ];
    }
}
