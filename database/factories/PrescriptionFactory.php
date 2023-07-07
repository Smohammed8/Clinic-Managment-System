<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'drug_name' => $this->faker->text(),
            'dose' => $this->faker->text(255),
            'frequency' => $this->faker->text(255),
            'duration' => $this->faker->text(255),
            'other_info' => $this->faker->text(),
            'main_diagnosis_id' => \App\Models\MainDiagnosis::factory(),
        ];
    }
}
