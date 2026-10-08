<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = [
            ['Floe Avent Storm', 'floe-avent-storm', 'seller-1.svg', 'Official electronics store', true],
            ['Pro Horlorm', 'pro-horlorm', 'seller-2.svg', 'Robotics & maker supplies', true],
            ['LOUIS VUITTON', 'louis-vuitton', 'seller-3.svg', 'Premium gadgets partner', true],
            ['LavaSh Look', 'lavash-look', 'seller-4.svg', 'Home & decor collections', true],
            ['TechShop BD', 'techshop-bd', 'seller-5.svg', 'POS & printing solutions', true],
        ];

        foreach ($sellers as [$name, $slug, $logo, $tagline, $top]) {
            Seller::create([
                'name' => $name,
                'slug' => $slug,
                'logo' => 'sellers/' . $logo,
                'tagline' => $tagline,
                'is_top' => $top,
            ]);
        }
    }
}
