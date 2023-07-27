<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'batch_number' => $this->faker->text(255),
            'expire_date' => $this->faker->date,
            'brand' => $this->faker->text(255),
            'supplier_name' => $this->faker->text(255),
            'campany_name' => $this->faker->text(255),
            'number_of_units' => $this->faker->randomNumber(1),
            'number_of_unit_per_pack' => $this->faker->randomNumber(1),
            'unit_price' => $this->faker->randomNumber(2),
            'price_per_unit' => $this->faker->randomNumber(2),
            'profit_margit' => $this->faker->randomNumber(2),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
