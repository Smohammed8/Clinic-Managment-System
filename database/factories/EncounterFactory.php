<?php

namespace Database\Factories;

use App\Models\Encounter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EncounterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Encounter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'check_in_time' => $this->faker->dateTime(),
            'status' => $this->faker->numberBetween(0, 127),
            'closed_at' => $this->faker->dateTime(),
            'priority' => $this->faker->numberBetween(0, 127),
            'clinic_id' => \App\Models\Clinic::factory(),
        ];
    }
}
