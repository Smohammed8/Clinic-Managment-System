<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->numberBetween(0, 127),
            'is_active' => $this->faker->numberBetween(0, 127),
            'clinic_id' => \App\Models\Clinic::factory(),
            'encounter_id' => \App\Models\Encounter::factory(),
        ];
    }
}
