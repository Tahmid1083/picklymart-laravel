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
            'name' => 'Admin',
            'email' => 'admin@picklymart.com',
            'password' => Hash::make('admin123'),
            'user_type' => 'admin',
            'phone' => '01700000000',
            'address' => '6th Floor, 9R8G+C59 Chittagong Shopping Complex',
            'city' => 'Chittagong',
        ]);

        User::create([
            'name' => 'Demo Customer',
            'email' => 'customer@picklymart.com',
            'password' => Hash::make('customer123'),
            'user_type' => 'customer',
            'phone' => '01811111111',
            'address' => 'House 12, Road 4, Dhanmondi',
            'city' => 'Dhaka',
        ]);
    }
}
