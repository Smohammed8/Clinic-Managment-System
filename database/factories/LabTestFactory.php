<?php

namespace Database\Factories;

use App\Models\LabTest;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabTestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LabTest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'test_name' => $this->faker->text(255),
            'test_desc' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 127),
            'is_available ' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'lab_catagory_id' => \App\Models\LabCatagory::factory(),
        ];
    }
}
