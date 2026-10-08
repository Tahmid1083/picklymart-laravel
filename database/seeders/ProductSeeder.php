<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cat = fn (string $slug) => Category::where('slug', $slug)->value('id');

        $products = [
            // ---- POS Rolls ----
            ['56mm x 38mm (2.2 - 1.4 inch) POS Printer Paper Roll', 'pos-roll', 30, null, 'products/pos-roll-56x38.svg', 'Pos Roll', 'deal' => true, 'featured' => true, 'best' => true, 'new' => true],
            ['79mm x 50m POS Printer Paper Roll', 'pos-roll', 60, null, 'products/pos-roll-79x50.svg', 'Pos Roll', 'deal' => true, 'featured' => true, 'best' => true],
            ['80mm x 80mm POS Printer Paper Roll', 'pos-roll', 150, null, 'products/pos-roll-80x80.svg', 'Pos Roll', 'deal' => true, 'featured' => true],
                ['80mm x 80mm (2 3/4 inch) POS Paper Roll', 'pos-roll', 30, null, 'products/pos-roll-80x80.svg', 'Pos Roll', 'featured' => true, 'best' => true, 'new' => true],
            ['57mm x 57mm POS Paper Roll', 'pos-roll', 45, null, 'products/pos-roll-57x57.svg', 'Pos Roll', 'featured' => true],
            ['80mm x 80mm BPA Free POS Paper Roll', 'pos-roll', 50, 45, 'products/pos-roll-bpa.svg', 'Pos Roll', 'featured' => true, 'new' => true],
            ['80mm x 60mm (2 1/2 inch) Thermal Paper Roll', 'pos-roll', 45, null, 'products/pos-roll-80x60.svg', 'Pos Roll', 'new' => true],
            ['2 1/4 inch x 50 Mobile Printer Paper Roll', 'pos-roll', 30, null, 'products/pos-roll-mobile.svg', 'Pos Roll', 'new' => true],
            ['78mm x 73m Thermal POS Paper Roll', 'pos-roll', 1, null, 'products/pos-roll-78mm.svg', 'Pos Roll', 'best' => true],
            ['56mm x 38mm Thermal Receipt Roll (Bulk Carton)', 'pos-roll', 25, null, 'products/pos-roll-56x38.svg', 'Pos Roll'],

            // ---- Boards ----
            ['Arduino UNO Board', 'robotics-kits-boards', 450, 429, 'products/https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXdvxS6nCD4faV0dfFGf8cbqGXjJ-HBcNdw_OzbXRI-g&s=10', 'Arduino', 'best' => true, 'featured' => true],
            ['Arduino Mega 2560 Board', 'robotics-kits-boards', 1250, null, 'products/arduino-mega.svg', 'Arduino', 'featured' => true],
            ['Raspberry Pi 4 Model B - 4GB', 'robotics-kits-boards', 5500, null, 'products/raspberry-pi-4.svg', 'Raspberry Pi', 'featured' => true, 'best' => true],
            ['Raspberry Pi Zero W', 'robotics-kits-boards', 850, null, 'products/raspberry-pi-zero.svg', 'Raspberry Pi', 'featured' => true, 'best' => true],
            ['A400 SATA 480GB Rev 3.0 Internal SSD', 'computer', 5500, null, 'products/ssd-a400.svg', 'Kingston', 'deal' => true, 'featured' => true],

            // ---- Kits & accessories ----
            ['Robot Chassis (2WD / 4WD)', 'robotics-kits-boards', 550, null, 'products/robot-chassis.svg', 'Robotic Kit', 'new' => true],
            ['LEGO Robotics Kits (Spike Prime, Mindstorms)', 'robotics-kits-boards', 850, null, 'products/lego-robot.svg', 'LEGO', 'featured' => true],

            // ---- Sensors & components ----
            ['AS608 Optical Fingerprint Reader Sensor Module', 'electronic-components-sensors', 3500, null, 'products/fingerprint-as608.svg', 'Generic', 'featured' => true],
            ['LM2596 DC-DC Buck Converter Module', 'electronic-components-sensors', 75, null, 'products/lm2596-buck.svg', 'Generic', 'new' => true, 'best' => true],
            ['TTP223 Capacitive Touch Sensor Module', 'electronic-components-sensors', 120, null, 'products/sensor-ttp223.svg', 'Generic', 'new' => true],
            ['Water Level Detection Sensor Module', 'electronic-components-sensors', 75, null, 'products/sensor-water-level.svg', 'Generic', 'new' => true],
            ['Flame Sensor Fire Detection Module', 'electronic-components-sensors', 65, null, 'products/sensor-flame.svg', 'Generic', 'new' => true],
            ['LDR Light Sensor Module', 'electronic-components-sensors', 65, null, 'products/sensor-ldr.svg', 'Generic', 'new' => true],
            ['5V Relay Module (1 Channel)', 'electronic-components-sensors', 85, null, 'products/relay-5v.svg', 'Generic', 'best' => true],
            ['RFID-RC522 Reader Module', 'electronic-components-sensors', 150, null, 'products/rfid-rc522.svg', 'Generic'],
            ['L298N Motor Driver Module', 'robotics-accessories', 65, null, 'products/l298n-driver.svg', 'Generic', 'new' => true],
            ['HC-SR04 Ultrasonic Distance Sensor', 'electronic-components-sensors', 45, null, 'products/sensor-ultrasonic.svg', 'Generic', 'best' => true],
            ['Micro Servo SG90', 'robotics-accessories', 140, null, 'products/servo-sg90.svg', 'TowerPro', 'best' => true],
            ['Jumper Wires (Male-Male, 40pcs)', 'robotics-accessories', 50, null, 'products/jumper-wires.svg', 'Generic', 'new' => true],

            // ---- Tools ----
            ['Glow Soldering Station 60W', 'tools-lab-equipment', 2450, null, 'products/soldering-station.svg', 'Glow', 'featured' => true],
            ['Precision Screwdriver Tool Set', 'tools-lab-equipment', 890, null, 'products/screwdriver-set.svg', 'Bosch', 'featured' => true],
        ];

        foreach ($products as $row) {
            [$name, $catSlug, $price, $special, $thumb, $brand] = $row;
            $featured = $row['featured'] ?? false;
            $best = $row['best'] ?? false;
            $new = $row['new'] ?? false;
            $deal = $row['deal'] ?? false;

            $product = Product::create([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
                'category_id' => $cat($catSlug),
                'brand' => $brand,
                'short_description' => "Premium quality {$name} — genuine product with fast delivery all over Bangladesh.",
                'description' => $this->description($name, $brand),
                'price' => $price,
                'special_price' => $special,
                'stock' => random_int(40, 500),
                'unit' => 'Piece',
                'thumbnail' => $thumb,
                'is_featured' => $featured,
                'is_best_selling' => $best,
                'is_new' => $new,
                'is_todays_deal' => $deal,
                'is_inhouse' => true,
                'status' => true,
                'views' => random_int(20, 900),
            ]);

            ProductImage::create(['product_id' => $product->id, 'image_path' => $thumb]);
            ProductImage::create(['product_id' => $product->id, 'image_path' => 'products/placeholder.svg']);
        }
    }

    protected function description(string $name, string $brand): string
    {
        return <<<HTML
            <p><b>About this product</b></p>
            <ul>
                <li><b>High Quality:</b> {$name} is sourced from trusted suppliers and tested before dispatch.</li>
                <li><b>Low Price Guarantee:</b> Sized for retail shelves and project benches — a budget-friendly choice for makers and businesses.</li>
                <li><b>Customization Options:</b> Need bulk quantities or a specific packaging format for your business? Contact us for corporate and custom order options.</li>
                <li><b>Fast Delivery:</b> With a delivery time of 2–7 working days all over Bangladesh, your order reaches you quickly and safely.</li>
            </ul>
            <p><b>Brand:</b> {$brand} &nbsp;|&nbsp; <b>Warranty:</b> 7 days replacement for damaged items.</p>
        HTML;
    }
}
