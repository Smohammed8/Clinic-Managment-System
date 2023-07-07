<?php

namespace Database\Factories;

use App\Models\LabCatagory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabCatagoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LabCatagory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lab_name' => $this->faker->text(255),
            'lab_desc' => $this->faker->text(),
        ];
    }
}
