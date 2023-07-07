<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\LabTestRequestGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabTestRequestGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LabTestRequestGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->numberBetween(0, 127),
            'priority' => $this->faker->numberBetween(0, 127),
            'notification' => $this->faker->numberBetween(0, 127),
            'call_status' => $this->faker->numberBetween(0, 127),
            'requested_at' => $this->faker->dateTime(),
            'clinic_user_id' => \App\Models\ClinicUser::factory(),
            'encounter_id' => \App\Models\Encounter::factory(),
        ];
    }
}
