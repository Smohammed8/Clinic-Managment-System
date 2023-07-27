<?php

namespace Database\Factories;

use App\Models\StoreUser;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => \App\Models\Store::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
