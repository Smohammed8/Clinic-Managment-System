<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProductRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomNumber(1),
            'clinic_id' => \App\Models\Clinic::factory(),
            'product_id' => \App\Models\Product::factory(),
            'store_id' => \App\Models\Store::factory(),
        ];
    }
}
