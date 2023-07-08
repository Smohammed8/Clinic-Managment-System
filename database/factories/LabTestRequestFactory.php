<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\LabTestRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabTestRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LabTestRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sample_collected_at' => $this->faker->dateTime(),
            'sample_analyzed_at' => $this->faker->dateTime(),
            'status' => $this->faker->numberBetween(0, 127),
            'notification' => $this->faker->numberBetween(0, 127),
            'note' => $this->faker->text(),
            'result' => $this->faker->text(),
            'comment' => $this->faker->text(),
            'analyser_result' => $this->faker->text(255),
            'approved_at' => $this->faker->dateTime(),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'sample_id' => $this->faker->text(255),
            'ordered_on' => $this->faker->dateTime(),
            'lab_test_request_group_id' => \App\Models\LabTestRequestGroup::factory(),
            'sample_collected_by_id' => \App\Models\ClinicUser::factory(),
            'sample_analyzed_by_id' => \App\Models\ClinicUser::factory(),
            'lab_catagory_id' => \App\Models\LabCatagory::factory(),
            'approved_by_id' => \App\Models\ClinicUser::factory(),
        ];
    }
}
