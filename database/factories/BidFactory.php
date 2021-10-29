<?php

namespace Database\Factories;

use App\Models\Bid;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bid::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id')->toArray();
        $products = Product::all()->pluck('id')->toArray();
        return [
            'amount' => random_int(1, 1000) + random_int(1,100) / 100,
            'user_id' => $this->faker->randomElement($users),
            'product_id' => $this->faker->randomElement($products),
        ];

    }
}
