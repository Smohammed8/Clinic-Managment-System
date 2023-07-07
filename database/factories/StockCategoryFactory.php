<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\StockCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
}
