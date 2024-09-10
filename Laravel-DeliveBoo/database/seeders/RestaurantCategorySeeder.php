<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\RestaurantCategory;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_rest_categ = new RestaurantCategory();
        $new_rest_categ->restaurant_id = Restaurant::inRandomOrder()->first()->id;
        $new_rest_categ->category_id = Category::inRandomOrder()->first()->id;
        $new_rest_categ->save();
    }
}
