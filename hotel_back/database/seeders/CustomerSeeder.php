<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            "name" => "Msr nayeem",
            "email" => "admin@gmail.com",
            "password" =>"123456"
        ]);
    }
}