<?php

namespace Database\Factories;

use App\Models\Body;
use App\Models\Color;
use App\Models\Fuel;
use App\Models\Maker;
use App\Models\Model;
use App\Models\Transmission;
use App\Models\Trim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the vehicle's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $trim = Trim::factory()->create();
        $model = $trim->model;
        $fuel = Fuel::factory()->create();
        $body = Body::factory()->create();
        $transmission = Transmission::factory()->create();
        $color = Color::factory()->create();
        return [
            // Adjust the data as necessary
            'maker_id' => $model->maker_id,
            'model_id' => $model->id,
            'trim_id' => $trim->id,
            'fuel_id' => $fuel->id,
            'body_id' => $body->id,
            'transmission_id' => $transmission->id,
            'color_id' => $color->id,

            /**
             * Explanation:
             * [A-Z]{2}: Matches exactly two uppercase English letters.
             * -: Matches the literal dash character.
             * \d{3}: Matches exactly three digits (000 to 999).
             * ^ and $: Ensure the entire string adheres to the pattern.
             * Valid matches:
             * AA-BB-001, XY-ZZ-123, AB-CD-999
             */
            'registration_plate' => $this->faker->regexify('^[A-Z]{2}-[A-Z]{2}-\d{3}$'),
            /**
             * Explanation:
             * ^ and $: Assert the start and end of the string, ensuring the entire input matches the pattern.
             * [A-HJ-NPR-Z0-9]: Matches any uppercase letter (A–Z), excluding I, O, and Q, or any digit (0–9).
             * {17}: Ensures the VIN is exactly 17 characters long.
             *
             */
            'vin' => $this->faker->regexify('^[A-HJ-NPR-Z0-9]{17}$'),
            'production_year' => $this->faker->year(),
            /**
             * Explanation:
             * ^ ensures the pattern starts at the beginning.
             * ENG specifies the prefix for engine identifiers.
             * [A-Z0-9]{4} matches 4 alphanumeric characters (engine series/type).
             * [0-9]{4} matches exactly 4 numeric digits (unique identifier).
             * [A-Z] matches a single uppercase letter (checksum or plant code).
             * $ ensures the pattern ends.
             */
            'engine_id' => $this->faker->regexify('^ENG[A-Z0-9]{4}[0-9]{4}[A-Z]$'),
            /**
             * Explanation:
             * ^[1-9] ensures the first digit is not 0.
             * [0-9]{2,3} matches 2-3 additional digits (for a total of 3-4 digits).
             * cc$ ensures the string ends with "cm3".
             */
            'capacity' => $this->faker->regexify('^[1-9][0-9]{2,3}cm3$'),
            'power' => $this->faker->numberBetween(1, 10000),
            'valid_until' => $this->faker->date(),
            'notes' => $this->faker->text(),
        ];
    }
}
