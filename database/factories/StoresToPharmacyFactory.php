<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\StoresToPharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoresToPharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoresToPharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pharmacy_id' => \App\Models\Pharmacy::factory(),
            'store_id' => \App\Models\Store::factory(),
        ];
    }
}
