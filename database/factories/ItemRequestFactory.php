<?php

namespace Database\Factories;

use App\Models\ItemRequest;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomNumber(1),
            'pharmacy_id' => \App\Models\Pharmacy::factory(),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
