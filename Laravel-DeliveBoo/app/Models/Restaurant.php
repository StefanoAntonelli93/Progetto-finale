<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Plate;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone_number',
        'restaurant_name',
        'img',
        'description',
        'address',
        'p_iva',
    ];
    //creo collegamento 1/1
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function plates()
    {
        return $this->hasMany(Plate::class);
    }
}
