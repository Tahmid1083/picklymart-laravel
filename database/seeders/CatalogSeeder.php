<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        if (
            Category::query()->exists()
            || Seller::query()->exists()
            || Product::query()->exists()
        ) {
            return;
        }

        $this->call([
            CategorySeeder::class,
            SellerSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
