<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
