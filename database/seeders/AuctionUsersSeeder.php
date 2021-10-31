<?php

namespace Database\Seeders;

use App\Models\AuctionUsers;
use Illuminate\Database\Seeder;

class AuctionUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuctionUsers::factory()
            ->count(10)
            ->create();
    }
}
