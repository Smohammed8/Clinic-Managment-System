<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'admin_id' => $this->faker->randomNumber,
            'status' => $this->faker->boolean,
            'description' => $this->faker->sentence(15),
            'campus_id' => \App\Models\Campus::factory(),
            'user_id' => \App\Models\User::factory(),
            'clinic_id' => \App\Models\Clinic::factory(),
        ];
    }
}
