<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\AuctionUsers;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionUsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AuctionUsers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $auctions = Auction::all()->pluck('id')->toArray();
        $users = User::all()->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($users),
            'auction_id' => $this->faker->randomElement($auctions),
        ];

    }
}
