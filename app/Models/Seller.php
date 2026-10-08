<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = ['name', 'slug', 'logo', 'tagline', 'is_top'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeTop($query)
    {
        return $query->where('is_top', true);
    }
}
