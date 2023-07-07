<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'quantitiy_recived' => $this->faker->text(255),
            'quantity_despensed' => $this->faker->text(255),
            'bach_no' => $this->faker->text(255),
            'expire_date' => $this->faker->dateTime(),
            'pack' => $this->faker->text(255),
            'quantity_per_pack' => $this->faker->text(255),
            'basic_unit_quantity' => $this->faker->text(255),
            'pack_price' => $this->faker->text(255),
            'stock_category_id' => \App\Models\StockCategory::factory(),
            'stock_unit_id' => \App\Models\StockUnit::factory(),
            'supplier_id' => \App\Models\Supplier::factory(),
        ];
    }
}
