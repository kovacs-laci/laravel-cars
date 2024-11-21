<?php

namespace Database\Factories;

use App\Models\Maker;
use Illuminate\Database\Eloquent\Factories\Factory;

class MakerFactory extends Factory
{
    protected $model = Maker::class;

    public function definition()
    {
        return [
            // Adjust the data as necessary
            'name' => $this->faker->name,
            'logo' => $this->faker->filePath(),
        ];
    }
}
