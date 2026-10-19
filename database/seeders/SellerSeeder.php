<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = [
            ['Walton Plaza', 'floe-avent-storm', 'seller-1.svg', 'Official electronics store', true],
            ['RoboticsBD', 'pro-horlorm', 'seller-2.svg', 'Robotics & maker supplies', true],
            ['Gadget & Gear', 'louis-vuitton', 'seller-3.svg', 'Premium gadgets partner', true],
            ['Aarong Home', 'lavash-look', 'seller-4.svg', 'Home & decor collections', true],
            ['Smart POS BD', 'techshop-bd', 'seller-5.svg', 'POS & printing solutions', true],
        ];

        foreach ($sellers as [$name, $slug, $logo, $tagline, $top]) {
            Seller::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'logo' => 'sellers/' . $logo,
                    'tagline' => $tagline,
                    'is_top' => $top,
                ]
            );
        }
    }
}
