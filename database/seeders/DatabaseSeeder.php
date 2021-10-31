<?php

namespace Database\Seeders;

use Database\Factories\AuctionUsersFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductSeeder::class,
            UserSeeder::class,
            AuctionSeeder::class,
            AuctionUsersSeeder::class,
            BidSeeder::class,
        ]);
    }
}
