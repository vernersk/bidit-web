<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\AuctionUser;
use App\Models\Bid;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [

        ];
    }
}
