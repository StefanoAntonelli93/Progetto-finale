<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Plate;

class Order extends Model
{
    use HasFactory;

    public function restaurant()
    {
        return $this->belongsToMany(Plate::class, 'order_plate')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function plates()
    {
        return $this->belongsToMany(Plate::class);
    }
    protected $fillable = [
        'customer_name',
        'delivery_address',
        'restaurant_id',
        'price',
        'note',
        'cart', // Se 'cart' è serializzato in JSON o ha un formato adatto
    ];
}
