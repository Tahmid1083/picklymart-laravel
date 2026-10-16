<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Demo Customer',
            'email' => 'customer@picklymart.com',
            'password' => Hash::make('customer123'),
            'phone' => '01811111111',
            'address' => 'House 12, Road 4, Dhanmondi',
            'city' => 'Dhaka',
        ]);
    }
}
