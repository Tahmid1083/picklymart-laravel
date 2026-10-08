<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Robotics Kits & Boards', 'robotics-kits-boards', 'robotics.svg', 1, 1],
            ['3D Printing', '3d-printing', '3d-printing.svg', 2, 1],
            ['Drones & Drone Accessories', 'drones-drone-accessories', 'drones.svg', 3, 1],
            ['Electronic Components & Sensors', 'electronic-components-sensors', 'electronics.svg', 4, 1],
            ['Tools & Lab Equipment', 'tools-lab-equipment', 'tools.svg', 5, 1],
            ['Rubik’s Cubes & Speedcubing', 'rubiks-cubes-speedcubing', 'rubik.svg', 6, 1],
            ['Robotics Accessories', 'robotics-accessories', 'accessories.svg', 7, 1],
            ['Computer', 'computer', 'computer.svg', 8, 1],
            ['Home Decor', 'home-decor', 'home-decor.svg', 9, 0],
            ['Pos Roll', 'pos-roll', 'pos-roll.svg', 10, 1],
        ];

        foreach ($categories as [$name, $slug, $icon, $sort, $showcase]) {
            Category::create([
                'name' => $name,
                'slug' => $slug,
                'icon' => $icon,
                'show_in_sidebar' => true,
                'is_showcase' => (bool) $showcase,
                'sort_order' => $sort,
            ]);
        }

        // Child category like the original site
        $posRoll = Category::where('slug', 'pos-roll')->first();
        Category::create([
            'name' => 'Thermal Sticker',
            'slug' => 'thermal-sticker',
            'parent_id' => $posRoll->id,
            'icon' => 'thermal-sticker.svg',
            'show_in_sidebar' => true,
            'sort_order' => 11,
        ]);
    }
}
