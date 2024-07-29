<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateStart = fake()->dateTime();
        $dateEnd = fake()->dateTime();

        if ($dateStart > $dateEnd){
            $tmp = $dateStart;
            $dateStart = $dateEnd;
            $dateEnd = $tmp;
        }

        return [
            'game_id' => Game::factory(),
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'percent'
        ];
    }
}
