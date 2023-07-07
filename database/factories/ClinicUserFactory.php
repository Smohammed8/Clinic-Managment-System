<?php

namespace Database\Factories;

use App\Models\ClinicUser;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClinicUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'encounter_id' => \App\Models\Encounter::factory(),
            'encounter_id' => \App\Models\Encounter::factory(),
        ];
    }
}
