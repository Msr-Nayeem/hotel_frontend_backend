<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            "cetegory" => "premium",
            "status" => "available",
            "rent_per_day" => 2000,
            "booked_for" => 1
        ]);
    }
}