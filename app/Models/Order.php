<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'user_id', 'customer_name', 'email', 'phone',
        'address', 'city', 'notes', 'total', 'payment_method', 'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateCode(): string
    {
        do {
            $code = 'PLM-' . now()->format('ymd') . '-' . strtoupper(substr(uniqid(), -5));
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
