<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'a_date' => $this->faker->dateTime(),
            'reason' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 127),
            'encounter_id' => \App\Models\Encounter::factory(),
            'clinic_user_id' => \App\Models\ClinicUser::factory(),
            'student_id' => \App\Models\Student::factory(),
        ];
    }
}
