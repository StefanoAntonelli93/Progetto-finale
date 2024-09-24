<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Order;

class Plate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'price',
        'img',
        'allergenes',
        'available',
        'slug',
        'image_url'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_plate')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
