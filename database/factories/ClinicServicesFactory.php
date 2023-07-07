<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ClinicServices;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicServicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClinicServices::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_name' => $this->faker->text(255),
            'service_ description' => $this->faker->text(255),
        ];
    }
}
