<?php

namespace Database\Factories;

use App\Models\Maker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maker = Maker::factory()->create();
        return [
                // Adjust the data as necessary
                'name' => $this->faker->name,
                // Use an existing maker or create one
                'maker_id' => $maker->id,
        ];
    }
}
