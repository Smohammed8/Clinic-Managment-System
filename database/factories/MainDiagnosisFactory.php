<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\MainDiagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

class MainDiagnosisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainDiagnosis::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'clinic_user_id' => \App\Models\ClinicUser::factory(),
            'student_id' => \App\Models\Student::factory(),
            'encounter_id' => \App\Models\Encounter::factory(),
            'diagnosis_id' => \App\Models\Diagnosis::factory(),
        ];
    }
}
