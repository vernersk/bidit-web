<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Auction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $products = Product::all()->pluck('id')->toArray();
        return [
            'expires_at' => Carbon::now()->addDays(rand(1, 55)),
            'product_id' => $this->faker->randomElement($products),
        ];
    }
}
