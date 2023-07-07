<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subjective' => $this->faker->text(),
            'objective' => $this->faker->text(),
            'assessment' => $this->faker->text(),
            'plan' => $this->faker->text(),
            'encounter_id' => \App\Models\Encounter::factory(),
            'clinic_user_id' => \App\Models\ClinicUser::factory(),
            'student_id' => \App\Models\Student::factory(),
        ];
    }
}
