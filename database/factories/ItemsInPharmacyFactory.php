<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ItemsInPharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemsInPharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemsInPharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'count' => 0,
            'item_id' => \App\Models\Item::factory(),
            'pharmacy_id' => \App\Models\Pharmacy::factory(),
        ];
    }
}
