<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    private const REAL_PRODUCT_IMAGES = [
        '56mm-x-38mm-22-14-inch-pos-printer-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '79mm-x-50m-pos-printer-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '80mm-x-80mm-pos-printer-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '80mm-x-80mm-2-34-inch-pos-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '57mm-x-57mm-pos-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '80mm-x-80mm-bpa-free-pos-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '80mm-x-60mm-2-12-inch-thermal-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '2-14-inch-x-50-mobile-printer-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '78mm-x-73m-thermal-pos-paper-roll' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        '56mm-x-38mm-thermal-receipt-roll-bulk-carton' => 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?auto=format&fit=crop&w=900&q=85',
        'arduino-uno-board' => 'https://upload.wikimedia.org/wikipedia/commons/3/38/Arduino_Uno_-_R3.jpg',
        'arduino-mega-2560-board' => 'https://upload.wikimedia.org/wikipedia/commons/8/80/Arduino_MEGA_2560_R3%2C_front_side.jpg',
        'raspberry-pi-4-model-b-4gb' => 'https://upload.wikimedia.org/wikipedia/commons/f/f1/Raspberry_Pi_4_Model_B_-_Side.jpg',
        'raspberry-pi-zero-w' => 'https://upload.wikimedia.org/wikipedia/commons/2/2d/Raspberry_Pi_Zero_2_W.jpg',
        'a400-sata-480gb-rev-30-internal-ssd' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=85',
        'robot-chassis-2wd-4wd' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=900&q=85',
        'lego-robotics-kits-spike-prime-mindstorms' => 'https://upload.wikimedia.org/wikipedia/commons/c/cb/Lego_Mindstorms_EV3_Robot.jpg',
        'as608-optical-fingerprint-reader-sensor-module' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/SparkFun_Weather_Shield_13956-01.jpg',
        'lm2596-dc-dc-buck-converter-module' => 'https://upload.wikimedia.org/wikipedia/commons/6/66/LM2596_buck_converter_module%2C_MP1584_buck_converter_module%2C_and_SDB628_boost_converter_module.jpg',
        'ttp223-capacitive-touch-sensor-module' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/SparkFun_Weather_Shield_13956-01.jpg',
        'water-level-detection-sensor-module' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/SparkFun_Weather_Shield_13956-01.jpg',
        'flame-sensor-fire-detection-module' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=85',
        'ldr-light-sensor-module' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/SparkFun_Weather_Shield_13956-01.jpg',
        '5v-relay-module-1-channel' => 'https://upload.wikimedia.org/wikipedia/commons/6/66/LM2596_buck_converter_module%2C_MP1584_buck_converter_module%2C_and_SDB628_boost_converter_module.jpg',
        'rfid-rc522-reader-module' => 'https://upload.wikimedia.org/wikipedia/commons/3/38/Arduino_Uno_-_R3.jpg',
        'l298n-motor-driver-module' => 'https://upload.wikimedia.org/wikipedia/commons/6/66/LM2596_buck_converter_module%2C_MP1584_buck_converter_module%2C_and_SDB628_boost_converter_module.jpg',
        'hc-sr04-ultrasonic-distance-sensor' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/SparkFun_Weather_Shield_13956-01.jpg',
        'micro-servo-sg90' => 'https://upload.wikimedia.org/wikipedia/commons/c/cb/Lego_Mindstorms_EV3_Robot.jpg',
        'jumper-wires-male-male-40pcs' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=85',
        'glow-soldering-station-60w' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=900&q=85',
        'precision-screwdriver-tool-set' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=900&q=85',
    ];

    protected $fillable = [
        'name', 'slug', 'category_id', 'seller_id', 'brand',
        'short_description', 'description', 'price', 'special_price',
        'stock', 'unit', 'thumbnail',
        'is_featured', 'is_best_selling', 'is_new', 'is_todays_deal',
        'is_inhouse', 'status', 'views',
    ];

    protected $casts = [
        'price' => 'float',
        'special_price' => 'float',
        'is_featured' => 'boolean',
        'is_best_selling' => 'boolean',
        'is_new' => 'boolean',
        'is_todays_deal' => 'boolean',
        'is_inhouse' => 'boolean',
        'status' => 'boolean',
    ];

    /* Effective price considering special price */
    public function getDisplayPriceAttribute(): float
    {
        return $this->special_price && $this->special_price > 0 && $this->special_price < $this->price
            ? (float) $this->special_price
            : (float) $this->price;
    }

    public function getImageUrlAttribute(): string
    {
        if (isset(self::REAL_PRODUCT_IMAGES[$this->slug])) {
            return self::REAL_PRODUCT_IMAGES[$this->slug];
        }

        $thumbnail = $this->thumbnail ?: 'products/placeholder.svg';

        if (filter_var($thumbnail, FILTER_VALIDATE_URL)) {
            return $thumbnail;
        }

        return asset('images/' . ltrim($thumbnail, '/'));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating(): float
    {
        return (float) ($this->reviews()->avg('rating') ?: 0);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
