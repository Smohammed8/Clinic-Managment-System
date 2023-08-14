<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\PharmacyUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PharmacyUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pharmacy_id' => \App\Models\Pharmacy::factory(),
        ];
    }
}
