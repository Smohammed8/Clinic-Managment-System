<?php

namespace Database\Factories;

use App\Models\VitalSign;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VitalSignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VitalSign::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'temp' => $this->faker->randomNumber(1),
            'blood_pressure ' => $this->faker->randomNumber(1),
            'pulse_rate' => $this->faker->randomNumber(1),
            'rr' => $this->faker->randomNumber(1),
            'weight' => $this->faker->randomFloat(2, 0, 9999),
            'height' => $this->faker->randomFloat(2, 0, 9999),
            'muac' => $this->faker->randomNumber(1),
            'encounter_id' => \App\Models\Encounter::factory(),
            'clinic_user_id' => \App\Models\ClinicUser::factory(),
            'student_id' => \App\Models\Student::factory(),
        ];
    }
}
