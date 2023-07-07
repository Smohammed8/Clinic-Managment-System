<?php

namespace Database\Factories;

use App\Models\Clinic;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clinic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'code_clinic' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'lat' => $this->faker->randomNumber(2),
            'long' => $this->faker->randomNumber(2),
            'status' => $this->faker->numberBetween(0, 127),
            'is_active' => $this->faker->numberBetween(0, 127),
            'campus_id' => \App\Models\Campus::factory(),
            'collage_id' => \App\Models\Collage::factory(),
        ];
    }
}
